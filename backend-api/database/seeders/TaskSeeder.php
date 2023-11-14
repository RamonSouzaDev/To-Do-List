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
        $user = User::factory()->create([
            'name' => 'Sistema',
        ]);

        Auth::login($user);

        Task::factory()->count(5)->create([
            'completed' => false,
        ]);
        Task::factory()->count(15)->create([
            'completed' => true,
        ]);
    }
}
