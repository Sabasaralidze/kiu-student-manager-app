<?php

namespace Tests\Feature\Api;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_tasks_api(): void
    {
        $this->getJson('/api/tasks')->assertUnauthorized();
    }

    public function test_authenticated_user_receives_tasks_as_json(): void
    {
        $user = User::factory()->create();
        Task::create([
            'user_id' => $user->id,
            'title' => 'API Task',
            'description' => 'Returned as JSON',
            'subject' => 'Web Programming',
            'status' => 'pending',
            'deadline' => now()->addWeek()->toDateString(),
        ]);

        $response = $this->actingAs($user)->getJson('/api/tasks');

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'title',
                        'description',
                        'subject',
                        'status',
                        'deadline',
                        'attachments',
                    ],
                ],
            ])
            ->assertJsonPath('data.0.title', 'API Task');
    }

    public function test_user_cannot_view_another_users_task_via_api(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $task = Task::create([
            'user_id' => $owner->id,
            'title' => 'Private',
            'description' => 'Hidden',
            'subject' => 'Math',
            'status' => 'pending',
            'deadline' => now()->addDay()->toDateString(),
        ]);

        $this->actingAs($other)
            ->getJson('/api/tasks/'.$task->id)
            ->assertForbidden();
    }
}
