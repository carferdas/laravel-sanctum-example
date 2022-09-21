<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginUserRequest;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request): JsonResponse
    {
        if (! Auth::attempt($request->validated())) {
            return $this->error('401', 'The provided credentials do not match our records.');
        }

        /** @var User $user */
        $user = auth()->user();

        return $this->success([
            'user' => $user,
            'token' => $user->createToken(
                "API Token of {$user->getAttribute('name')}"
            )->plainTextToken,
        ]);
    }

    public function register(StoreUserRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken("API Token of {$user->name}")->plainTextToken,
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->success(null, 'You have successfully been logout and yours tokens has been deleted.');
    }
}
