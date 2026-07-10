<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\OnboardingTemplate;
use App\Models\OnboardingTask;
use App\Models\EmployeeOnboarding;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class OnboardingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Admin (if not exists)
        $admin = User::firstOrCreate(
            ['email' => 'admin@hris.com'],
            [
                'name' => 'HR Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'department' => 'HR'
            ]
        );
        $admin->update(['role' => 'admin', 'department' => 'HR']);

        // 2. Create some Templates
        $itTemplate = OnboardingTemplate::create([
            'name' => 'IT Engineer Onboarding',
            'department' => 'IT',
            'description' => 'Standard onboarding for new IT Engineers'
        ]);

        $salesTemplate = OnboardingTemplate::create([
            'name' => 'Sales Representative Onboarding',
            'department' => 'Sales',
            'description' => 'Onboarding for new Sales team members'
        ]);

        // 3. Create Tasks for IT Template
        $tasksData = [
            ['title' => 'Tanda Tangan Kontrak', 'description' => 'Tanda tangan kontrak kerja di portal HR', 'duration_days' => 1],
            ['title' => 'Ambil Laptop & Akses Kunci', 'description' => 'Ambil perangkat kerja di departemen IT', 'duration_days' => 1],
            ['title' => 'Setup Email & Slack', 'description' => 'Login dan setup profil di Email dan Slack', 'duration_days' => 2],
            ['title' => 'Sesi Pengenalan Tim IT', 'description' => 'Meeting 1-on-1 dengan manajer dan tim', 'duration_days' => 3],
            ['title' => 'Baca SOP Keamanan Siber', 'description' => 'Pahami pedoman keamanan perusahaan', 'duration_days' => 5],
        ];

        foreach ($tasksData as $task) {
            $itTemplate->tasks()->create($task);
        }

        // 4. Create New Employee
        $newEmployee1 = User::create([
            'name' => 'Fajar Nugraha',
            'email' => 'fajar@hris.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'department' => 'IT'
        ]);

        $newEmployee2 = User::create([
            'name' => 'Dewi Lestari',
            'email' => 'dewi@hris.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'department' => 'Sales'
        ]);

        // 5. Assign Tasks to New Employee (Simulate controller logic)
        $now = Carbon::now();
        foreach ($itTemplate->tasks as $index => $task) {
            EmployeeOnboarding::create([
                'user_id' => $newEmployee1->id,
                'onboarding_task_id' => $task->id,
                'mentor_id' => $admin->id,
                'status' => $index < 2 ? 'completed' : ($index == 2 ? 'in_progress' : 'pending'),
                'due_date' => $now->copy()->addDays($task->duration_days),
                'completed_at' => $index < 2 ? $now->copy()->subDays(1) : null
            ]);
        }
    }
}
