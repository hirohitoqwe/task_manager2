<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Label;
use App\Models\Task;
use Illuminate\Http\Response;

class AssignController extends Controller
{
    public function assignLabelToTask(int $labelId, int $taskID): \Illuminate\Http\JsonResponse
    {
        Task::find($taskID)->labels()->attach(Label::find($labelId));
        return response()->json([], Response::HTTP_OK);
    }
}
