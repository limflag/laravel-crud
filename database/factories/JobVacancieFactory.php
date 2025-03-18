<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\JobVacancie;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobVacancie>
 */
class JobVacancieFactory extends Factory
{
    protected $model = JobVacancie::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(),
            'type' => $this->faker->randomElement(['CLT', 'CNPJ', 'Freelancer']),
            'paused' => $this->faker->boolean(20),
        ];
    }
}
