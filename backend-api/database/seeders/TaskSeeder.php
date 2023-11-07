<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $user = User::factory()->create();

        Auth::login($user);

        Task::factory()->count(20)->create([
            'completed' => false,
        ]);
    }
}
