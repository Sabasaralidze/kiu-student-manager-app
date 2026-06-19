<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_one_student_profile(): void
    {
        $user = User::factory()->create();

        $this->assertNotNull($user->profile);
        $this->assertDatabaseHas('student_profiles', ['user_id' => $user->id]);
    }

    public function test_user_can_update_student_profile_fields(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->patch(route('profile.update'), [
            'name' => $user->name,
            'email' => $user->email,
            'student_id' => 'ST999',
            'faculty' => 'Informatics',
            'phone' => '+995 555 999 999',
        ]);

        $response->assertRedirect(route('profile.edit'));
        $this->assertDatabaseHas('student_profiles', [
            'user_id' => $user->id,
            'student_id' => 'ST999',
            'faculty' => 'Informatics',
            'phone' => '+995 555 999 999',
        ]);
    }
}
