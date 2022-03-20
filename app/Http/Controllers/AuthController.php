<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{
    public function login(LoginRequest $request)
    {
        $user = User::whereEmail($request->input("email"))->first();
        if ($user && Hash::check($request->input("password"), $user->password)) {
            $token = $user->createToken("Login")->plainTextToken;
            return $this->dataResponse([
                "access_token" => $token,
                "user" => [
                    "name" => $user->name,
                    "avatar" => null,
                ]
            ]);
        }

        return $this->errorResponse("Invalid credentials provided.");
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create(array_merge(
                $request->only(["name", "email"]),
                ["password" => Hash::make($request->input("password"))]
            )
        );

        return $this->successResponse("Registration successful.");
    }

    public function logout(Request $request)
    {

    }

    public function user(Request $request)
    {
        $user = $request->user();

        return $this->dataResponse([
            "name" => $user->name,
            "avatar" => null,
        ]);
    }
}
