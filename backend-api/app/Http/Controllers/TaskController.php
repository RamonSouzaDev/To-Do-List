<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    /**
     * @return Task[]
     */
    public function index(): JsonResponse
    {
        $tasks = Task::with('user')->paginate(10);
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

}
