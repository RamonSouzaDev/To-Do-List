<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Exports\TaskExport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Helpers\ExcelExportHelper;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class TaskController extends Controller
{
    /**
     * @return Task[]
     */
    public function index(Request $request): JsonResponse
    {
        $query = Task::with('user');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%$search%");
        }

        $tasks = $query->paginate(10);
        return response()->json($tasks, 200);
    }

    /**
     * @param CreateTaskRequest $request
     * @return JsonResponse
     */
    public function store(CreateTaskRequest $request): JsonResponse
    {
        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    /**
     * @param UpdateTaskRequest $request
     * @param Task $task
     * @return JsonResponse
     */
    public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $task->update($request->all());
        return response()->json($task, 200);
    }

    /**
     * @param Task $task
     * @return Response
     */
    public function destroy(Task $task): Response
    {
        $task->delete();
        return response(null, 204);
    }

    /**
     * @param Task $task
     * @return JsonResponse
     */
    public function markAsCompleted(Task $task): JsonResponse
    {
        $task->update(['completed' => true]);
        return response()->json($task, 200);
    }

    /**
     * @param Task $task
     * @return JsonResponse
     */
    public function markAsIncompleted(Task $task): JsonResponse
    {
        $task->update(['completed' => false]);
        return response()->json($task, 200);
    }

    /**
     * @return void
     */
    public function markAllAsCompleted(): void
    {
        Task::where('completed', false)->update(['completed' => true]);
    }

    /**
     * @return void
     */
    public function markAllAsIncompleted(): void
    {
        Task::where('completed', true)->update(['completed' => false]);
    }

    /**
     * Exporta tarefas para um arquivo Excel.
     *
     * @param  Request $request
     * @return BinaryFileResponse
     */
    public function exportExcel(): BinaryFileResponse
    {
        $tasks = Task::all();

        return ExcelExportHelper::exportToExcel($tasks, TaskExport::class, 'tarefas.xlsx');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteMultiple(Request $request): JsonResponse
    {
        $tasks = $request->all();

        if (!is_array($tasks) || empty($tasks)) {
            return response()->json(['message' => 'Nenhuma tarefa foi informada'], 400);
        }

        $taskIds = array_column($tasks, 'id');

        foreach ($tasks as $task) {
            Task::whereIn('id', $taskIds)->delete();
        }

        return response()->json(['message' => 'Tarefas excluídas com sucesso'], 200);
    }
}
