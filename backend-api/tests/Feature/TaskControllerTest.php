<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa a criação e listagem de tarefas.
     *
     * @return void
     */
    public function testCreateAndListTasks()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $response = $this->post('/api/tasks', [
            'title' => 'Nova Tarefa',
            'completed' => false,
        ]);

        $response->assertStatus(201);

        $response = $this->get('/api/tasks');

        $response->assertStatus(200);
        $response->assertSee('Nova Tarefa');
    }

    /**
     * Testa a atualização de uma tarefa.
     *
     * @return void
     */
    public function testUpdateTask()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');  

        $task = Task::factory()->create();

        $response = $this->put("/api/tasks/{$task->id}", [
            'title' => 'Tarefa Atualizada',
            'completed' => true,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Tarefa Atualizada',
            'completed' => true,
        ]);
    }

    /**
     * Testa a exclusão de uma tarefa.
     *
     * @return void
     */
    public function testDeleteTask()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $task = Task::factory()->create();

        $response = $this->delete("/api/tasks/{$task->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    /**
     * Testa a marcação de uma tarefa como concluída.
     *
     * @return void
     */
    public function testMarkTaskAsCompleted()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $task = Task::factory()->create(['completed' => false]);

        $response = $this->put("/api/tasks/{$task->id}/complete");

        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'completed' => true]);
    }

    /**
     * Testa a marcação de uma tarefa como incompleta.
     *
     * @return void
     */
    public function testMarkTaskAsIncompleted()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $task = Task::factory()->create(['completed' => true]);

        $response = $this->put("/api/tasks/{$task->id}/incompleted");

        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'completed' => false]);
    }

}
