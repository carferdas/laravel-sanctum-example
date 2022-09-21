<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return TaskResource::collection(
            Task::query()
                ->with('user:id,name,email')
                ->paginate(10)
        );
    }

    public function store(StoreTaskRequest $request): TaskResource
    {
        $task = Task::create([
            'user_id' => auth()->id(),
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'priority' => $request->get('priority'),
        ]);

        return TaskResource::make($task);
    }

    public function show(Task $task): TaskResource
    {
        return TaskResource::make($task);
    }


    public function update(UpdateTaskRequest $request, Task $task): TaskResource
    {
        $task->update($request->validated());

        return TaskResource::make($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response(null, 204);
    }
}
