<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Journal>
 */
class JournalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $employeeId = User::query()->where('role', 'employee')->inRandomOrder()->first()->id;
        $coordinatorId = User::query()->where('role', 'coordinator')->inRandomOrder()->first()->id;
        $categoryId = Category::query()->inRandomOrder()->first()->id;

        $timing = ['before', 'after'];
        $timingKey = array_rand($timing, 1);

        $status = ['progress', 'complete'];
        $statusKey = array_rand($status, 1);

        $day = [now()->addDay(mt_rand(1, 10))->format('Y-m-d H:i:s'), now()->format('Y-m-d H:i:s')];
        $dayKey = array_rand($day, 1);
        $day = $day[$dayKey];

        return [
            'employee_id' => $employeeId,
            'coordinator_id' => $coordinatorId,
            'timing' => $timing[$timingKey],
            'category_id' => $categoryId,
            'description' => fake()->realText(),
            'target' => fake()->text(),
            'status' => $status[$statusKey],
            'comment' => fake()->text(),
            'created_at' => $day,
            'updated_at' => $day,
        ];
    }
}
