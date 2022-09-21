<?php

namespace Database\Factories;

use App\Models\User;
use App\Enums\TaskPriority;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->unique()->sentence(),
            'description' => $this->faker->text(),
            'priority' => $this->faker->randomElement(TaskPriority::cases())->value,
        ];
    }
}
