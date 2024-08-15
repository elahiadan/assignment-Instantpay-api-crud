<?php

namespace Database\Factories;

use App\Models\Board;
use App\Models\Task;
use App\Models\User;
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
    public function definition(): array
    {
        return [
            Task::NAME => fake()->name(),
            Task::DESCRIPTION => fake()->text(),
            Task::BOARD_ID => Board::all()->random()->id,
            Task::USER_ID => User::all()->random()->id,
        ];
    }
}
