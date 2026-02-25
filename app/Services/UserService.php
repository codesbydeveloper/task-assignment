<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function __construct(
        private readonly ActivityLogService $activityLogService,
    ) {
    }

    public function createUser(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => $data['role'] ?? 'user',
                'active' => $data['active'] ?? true,
            ]);

            Log::info('User created', ['user_id' => $user->id]);
            $this->activityLogService->log($user, 'user.created', [
                'role' => $user->role,
            ]);

            return $user;
        });
    }

    public function updateProfile(User $user, array $data): User
    {
        $user->fill(collect($data)->only(['name', 'email'])->toArray());

        if (!empty($data['password'])) {
            $user->password = $data['password'];
        }

        $user->save();

        Log::info('User profile updated', ['user_id' => $user->id]);
        $this->activityLogService->log($user, 'user.profile_updated');

        return $user;
    }

    public function activateUser(User $user): User
    {
        $user->active = true;
        $user->save();

        Log::info('User activated', ['user_id' => $user->id]);
        $this->activityLogService->log($user, 'user.activated');

        return $user;
    }

    public function deactivateUser(User $user): User
    {
        $user->active = false;
        $user->save();

        Log::info('User deactivated', ['user_id' => $user->id]);
        $this->activityLogService->log($user, 'user.deactivated');

        return $user;
    }
}

