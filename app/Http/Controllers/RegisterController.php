<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        $data = $request->validated();
        if (User::firstOrCreate([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ])) {
            return response()->json([], Response::HTTP_OK);
        }
        return response()->json([], Response::HTTP_FORBIDDEN);
    }
}
