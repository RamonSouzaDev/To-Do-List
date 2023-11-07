<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'user_id' => function () {
                return \App\Models\User::factory();
            },
            'title' => $this->faker->sentence,
            'completed' => $this->faker->boolean,
        ];
    }
}

