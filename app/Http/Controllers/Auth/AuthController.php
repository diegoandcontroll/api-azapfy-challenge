<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Services\AuthService;
use App\Trait\HttpResponses;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    use HttpResponses;
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function signin(SignInRequest $request)
    {
        $credentials = $request->validated();
        $response = $this->authService->signin($credentials);

        return $this->successResponse($response);
    }

    public function signup(SignUpRequest $request)
    {
        $validatedData = $request->validated();
        $user = $this->authService->signup($validatedData);

        return $this->createResponse($user);
    }

    public function logout(Request $request)
    {
        if (!$request->user()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } else {
            $request->user()->tokens()->delete();

            return response()->noContent();
        }
    }
}
