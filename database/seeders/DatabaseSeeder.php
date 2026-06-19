<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $demo = User::factory()->create([
            'name' => 'Demo Student',
            'email' => 'demo@kiu.edu.ge',
            'password' => Hash::make('password'),
        ]);

        $demo->profile()->update([
            'student_id' => 'ST2024001',
            'faculty' => 'Computer Science',
            'phone' => '+995 555 000 001',
        ]);

        $teammate = User::factory()->create([
            'name' => 'Team Member',
            'email' => 'member@kiu.edu.ge',
            'password' => Hash::make('password'),
        ]);

        $teammate->profile()->update([
            'student_id' => 'ST2024002',
            'faculty' => 'Computer Science',
        ]);

        Task::create([
            'user_id' => $demo->id,
            'title' => 'Database Systems Assignment',
            'description' => 'Complete ER diagram and normalization exercises for chapter 5.',
            'subject' => 'Database Systems',
            'status' => 'pending',
            'deadline' => now()->addDays(5)->toDateString(),
        ]);

        Task::create([
            'user_id' => $demo->id,
            'title' => 'Laravel Final Project Report',
            'description' => 'Write thesis with MVC diagram, ER diagram, and screenshots.',
            'subject' => 'Web Programming',
            'status' => 'pending',
            'deadline' => now()->addDays(14)->toDateString(),
        ]);

        Task::create([
            'user_id' => $demo->id,
            'title' => 'Read Chapter 3',
            'description' => 'Software engineering fundamentals — completed.',
            'subject' => 'Software Engineering',
            'status' => 'done',
            'deadline' => now()->subDays(2)->toDateString(),
        ]);

        $project = Project::create([
            'user_id' => $demo->id,
            'title' => 'Group Research Presentation',
            'description' => 'Prepare slides and demo for the final group presentation.',
            'subject' => 'Capstone',
            'status' => 'pending',
            'deadline' => now()->addDays(21)->toDateString(),
        ]);

        $project->members()->attach($demo->id, ['role' => 'owner']);
        $project->members()->attach($teammate->id, ['role' => 'member']);
    }
}
