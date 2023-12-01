<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeaveRequest;
use App\Http\Requests\TeamRequest;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use App\Services\TeamService;
use Illuminate\Http\Response;

class TeamController extends Controller
{

    public function __construct(private readonly TeamService $service)
    {
    }

    public function getById(int $id)
    {
        $team = Team::find($id);
        $tasks = Task::where('team_id', '=', $team->id)->with('labels')->get();
        return response()->json(['team' => $team, 'tasks' => $tasks], Response::HTTP_OK);
    }

    public function create(TeamRequest $request)
    {
        $validated = $request->validated();
        try {
            $team = Team::create([
                'name' => $validated['name'],
                'code' => $this->service->createCode($validated['name'])
            ]);
            $team->users()->attach(auth()->user()->getAuthIdentifier());
            return response()->json([], Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            return response()->json(['exception' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function invite(string $code)
    {
        try {
            $user = User::find(1);
            $user->teams()->attach(Team::where('code', '=', $code)->first());
            return response()->json([], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return response()->json(['Failed', Response::HTTP_BAD_REQUEST]);
        }
    }

    public function leave(LeaveRequest $request)
    {
        $validated = $request->validated();
        $user = User::find(1);
        $team = Team::find($validated['team_id']);
        $team->users()->detach($user->id);
        return response()->json([], Response::HTTP_OK);
    }
}
