<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LabelRequest;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LabelController extends Controller
{
    public function create(LabelRequest $request)
    {
        $validated = $request->validated();
        Label::create([
            'name' => $validated['name'],
            'color' => $validated['color'] ?? null
        ]);
        return response()->json([], Response::HTTP_CREATED);
    }
}
