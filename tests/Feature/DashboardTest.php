<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_the_login_page(): void
    {
        $response = $this->get(route('dashboard'));
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_users_can_visit_the_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'student']);
        $this->actingAs($user);

        $response = $this->get(route('dashboard'));
        $response->assertOk();
    }

    public function test_teachers_can_visit_the_teacher_dashboard(): void
    {
        $teacher = User::factory()->create(['role' => 'teacher']);
        $this->actingAs($teacher);

        $response = $this->get(route('teacher.dashboard'));
        $response->assertOk();
        $response->assertSee('Panel Guru');
    }

    public function test_students_cannot_visit_the_teacher_dashboard(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        $this->actingAs($student);

        $response = $this->get(route('teacher.dashboard'));
        // Middleware EnsureUserIsTeacher redirects student back to student dashboard / home
        $response->assertRedirect('/dashboard');
    }
}
