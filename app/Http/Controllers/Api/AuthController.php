<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\ActivityLogService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
        private readonly ActivityLogService $activityLogService,
    ) {
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->userService->createUser($request->validated());

        $token = $user->createToken('api-token')->plainTextToken;
        $this->activityLogService->log($user, 'auth.register_api');

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password) || !$user->active) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        $this->activityLogService->log($user, 'auth.login_api');

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user?->currentAccessToken()?->delete();

        if ($user) {
            $this->activityLogService->log($user, 'auth.logout_api');
        }

        return response()->json(['message' => 'Logged out']);
    }
}

