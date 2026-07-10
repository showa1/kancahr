<?php
namespace App\Http\Controllers\Transaksi;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use App\Models\EmploymentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataKaryawanController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['department', 'position', 'employmentStatus'])
            ->orderBy('full_name')
            ->paginate(15);
        $totalActive   = Employee::where('is_active', true)->count();
        $totalInactive = Employee::where('is_active', false)->count();
        $totalDepts    = Department::count();

        return view('transaksi.karyawan.index', compact(
            'employees', 'totalActive', 'totalInactive', 'totalDepts'
        ));
    }

    public function create()
    {
        $departments       = Department::orderBy('name')->get();
        $positions         = Position::orderBy('name')->get();
        $employmentStatuses = EmploymentStatus::orderBy('name')->get();

        return view('transaksi.karyawan.create', compact(
            'departments', 'positions', 'employmentStatuses'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik'              => 'required|string|unique:employees,nik|max:30',
            'full_name'        => 'required|string|max:100',
            'identity_type'    => 'required|in:ktp,sim,passport',
            'identity_number'  => 'nullable|string|max:30',
            'gender'           => 'required|in:L,P',
            'birth_date'       => 'nullable|date',
            'email'            => 'nullable|email|max:100',
            'phone'            => 'nullable|string|max:20',
            'department_id'    => 'nullable|exists:departments,id',
            'position_id'      => 'nullable|exists:positions,id',
            'employment_status_id' => 'nullable|exists:employment_statuses,id',
            'join_date'        => 'nullable|date',
            'basic_salary'     => 'nullable|numeric|min:0',
            'photo'            => 'nullable|image|max:2048',
            'contract_file'    => 'nullable|file|max:5120',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('employees/photos', 'public');
        }
        if ($request->hasFile('contract_file')) {
            $validated['contract_file'] = $request->file('contract_file')->store('employees/contracts', 'public');
        }

        $employee = Employee::create(array_merge($validated, $request->except([
            '_token', 'photo', 'contract_file'
        ])));

        return redirect()->route('transaksi.karyawan.index')
            ->with('success', "Karyawan {$employee->full_name} berhasil ditambahkan.");
    }
}
