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
        $tasks = Task::all();
        return response()->json($tasks, Response::HTTP_OK);
    }

    public function getById(int $id)
    {
        $task = Task::find($id);
        return response()->json($task, Response::HTTP_OK);
    }

    public function create(TaskRequest $request)
    {
        Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return response()->json([], Response::HTTP_CREATED);
    }

    public function delete(int $id)
    {
        Task::destroy($id);
        return response()->json([], Response::HTTP_OK);
    }
}
