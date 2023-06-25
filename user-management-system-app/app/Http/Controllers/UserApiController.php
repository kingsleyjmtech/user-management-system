<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class UserApiController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $user = User::create([
            'username' => $request->username,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user, 201);
    }

    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('my-app-token')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token,
            ];

            return response($response, 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 422);
        }
    }

    public function show()
    {
        $user = Auth::user();

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
    }

    public function update(UpdateUserRequest $request)
    {
        $user = $request->user();

        $user->update($request->validated());

        return response()->json($user);
    }
}
