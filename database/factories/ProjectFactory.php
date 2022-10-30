<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // protected $images = ['naykel-400-001.png', 'naykel-400-002.png', 'naykel-400-003.png', 'naykel-400-004.png', 'naykel-400-005.png'];

        return [
            'title' => $this->faker->text(random_int(25, 80)),
            'description' => $this->faker->sentence(random_int(15, 50)),
            'status' => $this->faker->randomElement(['published', 'draft']),
            // 'image' => $this->faker->randomElement($this->images),
            'project_value' => random_int(1000, 50000),
            'sort_order' => random_int(0, 5),
            'created_at' => Carbon::today()->subDays(rand(-365, -5)),
            'published_at' => Carbon::today()->subDays(rand(-365, -5)),
        ];
    }
}
