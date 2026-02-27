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

    public function index(Request $request)
    {
        Gate::authorize('viewAny', User::class);

        $users = User::query()
            ->when($request->query('role'), fn ($q, $role) => $q->where('role', $role))
            ->paginate(15);

        return response()->json($users);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        Gate::authorize('update', $user);

        return response()->json($this->userService->updateProfile($user, $request->validated()));
    }

    public function activate(User $user)
    {
        Gate::authorize('activate', $user);

        return response()->json($this->userService->activateUser($user));
    }

    public function deactivate(User $user)
    {
        Gate::authorize('deactivate', $user);

        return response()->json($this->userService->deactivateUser($user));
    }

    public function showProfile(Request $request)
    {
        return response()->json($request->user());
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = $this->userService->updateProfile($request->user(), $request->validated());

        return response()->json($user);
    }
}

