<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function index(Request $request): JsonResponse
    {
        Gate::authorize('viewAny', User::class);

        $users = User::query()
            ->when($request->query('role'), fn ($q, $role) => $q->where('role', $role))
            ->paginate(15);

        return response()->json($users);
    }

    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        $user = User::findOrFail($id);

        Gate::authorize('update', $user);

        $user = $this->userService->updateProfile($user, $request->validated());

        return response()->json($user);
    }

    public function activate(Request $request, int $id): JsonResponse
    {
        $user = User::findOrFail($id);

        Gate::authorize('activate', $user);

        $user = $this->userService->activateUser($user);

        return response()->json($user);
    }

    public function deactivate(Request $request, int $id): JsonResponse
    {
        $user = User::findOrFail($id);

        Gate::authorize('deactivate', $user);

        $user = $this->userService->deactivateUser($user);

        return response()->json($user);
    }

    public function showProfile(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }

    public function updateProfile(UpdateProfileRequest $request): JsonResponse
    {
        $user = $this->userService->updateProfile($request->user(), $request->validated());

        return response()->json($user);
    }
}

