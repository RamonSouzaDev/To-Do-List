<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa se um usuário pode ser criado e possui relacionamento com tarefas.
     * @covers \App\Models\Task::user
     * @covers \App\Models\User::tasks
     * @return void
     */
    public function testUserCreationAndTaskRelation()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $this->assertNotNull($user);
        $this->assertInstanceOf(User::class, $user);

        $task = Task::factory()->create();

        $this->assertNotNull($task);
        $this->assertInstanceOf(Task::class, $task);
        $this->assertEquals($user->id, $task->user_id);
    }
}
