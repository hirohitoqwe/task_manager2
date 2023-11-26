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
        return response()->json(Team::where('id', '=', $id)->first(), Response::HTTP_OK);
    }

    public function getTasks(int $id)
    {
        return response()->json(Task::where('team_id', '=', $id)->get(), Response::HTTP_OK);
    }

    public function create(TeamRequest $request)
    {
        $validated = $request->validated();
        try{
            Team::create([
                'name' => $validated['name'],
                'code' => $this->service->createCode($validated['name'])
            ]);
            return response()->json([], Response::HTTP_CREATED);
        }catch (\Exception $exception){
            return response()->json([], Response::HTTP_INTERNAL_SERVER_ERROR);
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
