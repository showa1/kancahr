<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OnboardingTemplate;
use App\Models\EmployeeOnboarding;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class OnboardingController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return $this->adminIndex();
        }

        return $this->employeeIndex($user);
    }

    private function adminIndex()
    {
        // Get all employees (new hires usually, but let's just get all for demo)
        $employees = User::where('role', 'employee')->with(['onboardings.task'])->get();
        
        $templates = OnboardingTemplate::with('tasks')->get();

        // Calculate progress for each employee
        foreach ($employees as $employee) {
            $totalTasks = $employee->onboardings->count();
            $completedTasks = $employee->onboardings->where('status', 'completed')->count();
            $employee->onboarding_progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
        }

        return view('onboarding.admin', compact('employees', 'templates'));
    }

    private function employeeIndex(User $user)
    {
        $onboardings = $user->onboardings()->with(['task', 'mentor'])->get();
        
        $totalTasks = $onboardings->count();
        $completedTasks = $onboardings->where('status', 'completed')->count();
        $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        return view('onboarding.employee', compact('onboardings', 'progress'));
    }

    public function storeEmployee(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'department' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'employee',
            'department' => $request->department,
        ]);

        // Find matching template
        $template = OnboardingTemplate::where('department', $request->department)->with('tasks')->first();
        
        if ($template) {
            $now = Carbon::now();
            foreach ($template->tasks as $task) {
                EmployeeOnboarding::create([
                    'user_id' => $user->id,
                    'onboarding_task_id' => $task->id,
                    'mentor_id' => Auth::id(), // Assign current admin as default mentor
                    'status' => 'pending',
                    'due_date' => $now->copy()->addDays($task->duration_days),
                ]);
            }
        }

        return back()->with('success', 'Karyawan baru berhasil ditambahkan dan tugas orientasi telah diberikan.');
    }

    public function storeTemplate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required|string',
            'description' => 'nullable|string',
            'tasks' => 'required|array|min:1',
            'tasks.*.title' => 'required|string|max:255',
            'tasks.*.duration_days' => 'required|integer|min:1',
            'tasks.*.description' => 'nullable|string',
        ]);

        $template = OnboardingTemplate::create([
            'name' => $request->name,
            'department' => $request->department,
            'description' => $request->description,
        ]);

        foreach ($request->tasks as $taskData) {
            $template->tasks()->create([
                'title' => $taskData['title'],
                'duration_days' => $taskData['duration_days'],
                'description' => $taskData['description'],
            ]);
        }

        return back()->with('success', 'Template orientasi baru berhasil dibuat.');
    }

    public function updateStatus(Request $request, $id)
    {
        $onboarding = EmployeeOnboarding::findOrFail($id);
        
        // Ensure the user owns this onboarding task
        if ($onboarding->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $onboarding->update([
            'status' => $request->status,
            'completed_at' => $request->status === 'completed' ? now() : null
        ]);

        return response()->json(['success' => true]);
    }
}
