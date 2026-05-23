<?php

namespace Tests\Feature;

use App\Models\Materi;
use App\Models\User;
use Database\Seeders\MateriSeeder;
use Database\Seeders\QuizSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MateriPageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Run seeders to set up necessary Materi and Quiz data
        $this->seed(MateriSeeder::class);
        $this->seed(QuizSeeder::class);
    }

    public function test_authenticated_student_can_visit_study_map(): void
    {
        $user = User::factory()->create(['role' => 'student']);
        $this->actingAs($user);

        $response = $this->get(route('materi.index'));
        $response->assertOk();
    }

    public function test_stages_can_be_visited_successfully(): void
    {
        $user = User::factory()->create(['role' => 'student']);
        $this->actingAs($user);

        // Tahap 1 Reading page
        $response = $this->get(route('materi.belajar', ['step' => 1]));
        $response->assertOk();

        // Tahap 1 Video page
        $response = $this->get(route('materi.tahap1.video'));
        $response->assertOk();

        // Tahap 2 Quiz (Soal 1) page
        $response = $this->get(route('materi.belajar', ['step' => 2, 'soal_ke' => 1]));
        $response->assertOk();

        // Tahap 3 Baca page (without soal_ke parameter)
        $response = $this->get(route('materi.belajar', ['step' => 3]));
        $response->assertOk();

        // Tahap 3 Kamera page (with soal_ke parameter)
        $response = $this->get(route('materi.belajar', ['step' => 3, 'soal_ke' => 1]));
        $response->assertOk();

        // Tahap 4 Reading page
        $response = $this->get(route('materi.belajar', ['step' => 4]));
        $response->assertOk();

        // Tahap 5 Understanding page
        $response = $this->get(route('materi.belajar', ['step' => 5]));
        $response->assertOk();

        // Tahap 6 Coloring page
        $response = $this->get(route('materi.belajar', ['step' => 6]));
        $response->assertOk();
    }

    public function test_student_can_save_progress_via_post_request(): void
    {
        $user = User::factory()->create(['role' => 'student']);
        $this->actingAs($user);

        $materi = Materi::orderBy('order', 'asc')->first();

        $response = $this->postJson(route('materi.save_progress'), [
            'materi_id' => $materi->id,
            'tahap' => 4,
            'score' => 0,
        ]);

        $response->assertOk();
        $response->assertJsonFragment([
            'message' => 'Nilai berhasil disimpan ke database!',
        ]);

        $this->assertDatabaseHas('user_progresses', [
            'user_id' => $user->id,
            'materi_id' => $materi->id,
            'tahap' => 4,
            'score' => 0,
            'is_completed' => true,
        ]);
    }
}
