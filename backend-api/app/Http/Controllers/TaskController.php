<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * @return Task[]
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    /**
     * @param Request $request
     * @param Task $task
     * @return JsonResponse
     */
    public function update(Request $request, Task $task): JsonResponse
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

}
