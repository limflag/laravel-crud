<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\JobVacancie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobVacancieTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_job_vacancie()
    {
        $job = JobVacancie::create([
            'title' => 'Desenvolvedor Laravel',
            'description' => 'Vaga para desenvolvedor Laravel pleno.',
            'type' => 'CLT',
            'paused' => false,
        ]);

        $this->assertDatabaseHas('job_vacancies', ['title' => 'Desenvolvedor Laravel']);
    }

    #[Test]
    public function it_can_update_a_job_vacancie()
    {
        $job = JobVacancie::factory()->create();
        $job->update(['title' => 'Novo Título']);

        $this->assertDatabaseHas('job_vacancies', ['title' => 'Novo Título']);
    }

    #[Test]
    public function it_can_delete_a_job_vacancie()
    {
        $job = JobVacancie::factory()->create();
        $job->delete();

        $this->assertDatabaseMissing('job_vacancies', ['id' => $job->id]);
    }
}
