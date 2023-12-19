<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function signin(array $credentials): array
    {
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
                'password' => ['The provided credentials are incorrect.']
            ])->status(401);
        }

        $user = Auth::user();
        $tokenName = 'Authtoken:' . $user->id;
        $token = $user->createToken($tokenName)->plainTextToken;

        return [
            'access_token' => $token,
            'user' => $user,
        ];
    }

    public function signup(array $userData): User
    {
        return $this->userRepository->createUser($userData);
    }

}
