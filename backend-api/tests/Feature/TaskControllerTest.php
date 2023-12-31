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
     * @covers TaskController@store
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
     * @covers TaskController@update
     */
    public function testUpdateTask()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');  

        $task = Task::factory()->create();

        $response = $this->patch("/api/tasks/{$task->id}", [  // Use PATCH em vez de PUT
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
     * @covers TaskController@destroy
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
     * @covers TaskController@markAsCompleted
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
     * @covers TaskController@markAsIncompleted
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

    /**
     * Testa a busca de tarefas por título.
     *
     * @return void
     * @covers TaskController@index
     */
    public function testSearchTaskByTitle()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $task = Task::factory()->create(['title' => 'Tarefa 1']);

        $response = $this->getJson('/api/tasks?search=Tarefa');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'title' => 'Tarefa 1',
            'user_id' => $user->id,
        ]);
    }

    /**
     * Testa a a marcação de todas as tarefas como concluído.
     *
     * @return void
     * @covers TaskController@markAllAsCompleted
     */
    public function testMarkAllTaskAsCompleted()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        Task::factory(20)->create(['completed' => false]);

        $response = $this->post('/api/tasks/mark-all-as-completed');

        $response->assertStatus(200);

        $this->assertDatabaseHas('tasks', ['completed' => true]);

        $completedTasks = Task::where('completed', true)->get();

        $this->assertCount(20, $completedTasks);
    }

    /**
     * Testa a a marcação de todas as tarefas como concluído.
     *
     * @return void
     * @covers TaskController@markAllAsCompleted
     */
    public function testMarkAllTaskAsIncompleted()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        Task::factory(20)->create(['completed' => true]);

        $response = $this->post('/api/tasks/mark-all-as-incompleted');

        $response->assertStatus(200);

        $this->assertDatabaseHas('tasks', ['completed' => false]);

        $incompletedTasks = Task::where('completed', false)->get();

        $this->assertCount(20, $incompletedTasks);
    }

    /**
     * Testa a exportação de tarefas para um arquivo Excel.
     *
     * @return void
     * @covers TaskController@exportExcel
     */
    public function testExportExcel()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        Task::factory(20)->create(['completed' => true]);

        $response = $this->post('/api/tasks/export-excel');

        $response->assertStatus(200);

        $response->assertDownload();
    }

    /**
     * Testa a exclusão de várias tarefas.
     *
     * @return void
     * @covers TaskController@deleteMultipleTask
     */
    public function testDeleteMultipleTask()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        
        $tasks = Task::factory(20)->create();

        $taskIds = $tasks->pluck('id')->toArray();

        $response = $this->post("/api/tasks/delete-multiple", ['tasks' => $taskIds]);

        foreach ($taskIds as $taskId) {
            $this->assertDatabaseMissing('tasks', [['id' => $taskId]]);
        }

        $response->assertStatus(200);
    }

    /**
     * Testa a exclusão de várias tarefas sem informar tarefas.
     *
     * @return void
     * @covers TaskController@deleteMultipleTask
     */
    public function testDeleteMultipleTaskWithoutTasks()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $response = $this->post("/api/tasks/delete-multiple", []);

        $response->assertStatus(400)->assertJson(['message' => 'Nenhuma tarefa foi informada']);
    }
}
