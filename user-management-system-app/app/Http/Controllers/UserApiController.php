<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
}
