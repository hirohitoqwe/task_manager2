<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use \Illuminate\Http\Response;

class TaskController extends Controller
{
    public function index()
    {
        return response()->json(Task::with('labels')->where('user_id', auth()->user()->id)->get(),
            Response::HTTP_OK);
    }

    public function getById(int $id)
    {
        $task = Task::with('labels')->find($id);
        if (!$task) {
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return response()->json($task, Response::HTTP_OK);
    }

    public function create(TaskRequest $request)
    {
        $validated = $request->validated();
        $created = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'user_id' => $validated['user_id'] ?? null,
            'team_id' => $validated['team_id'] ?? null
        ]);

        return response()->json($created, Response::HTTP_CREATED);
    }

    public function delete(int $id)
    {
        Task::destroy($id);
        return response()->json([], Response::HTTP_OK);
    }
}
