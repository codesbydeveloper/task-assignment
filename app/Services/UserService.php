<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function __construct(
        private readonly ActivityLogService $activityLogService,
    ) {}

    public function createUser(array $data)
    {
        return DB::transaction(function () use ($data) {
            $user = User::create($data + [
                'role'   => 'user',
                'active' => true,
            ]);

            $this->activityLogService->log($user, 'user.created', [
                'role' => $user->role,
            ]);

            return $user;
        });
    }

    public function updateProfile(User $user, array $data)
    {
        $user->fill(array_intersect_key($data, array_flip(['name', 'email'])));

        if (!empty($data['password'])) {
            $user->password = $data['password'];
        }
        $user->save();
        $this->activityLogService->log($user, 'user.profile_updated');
        return $user;
    }

    public function activateUser(User $user)
    {
        $user->active = true;
        $user->save();

        $this->activityLogService->log($user, 'user.activated');

        return $user;
    }

    public function deactivateUser(User $user)
    {
        $user->active = false;
        $user->save();

        $this->activityLogService->log($user, 'user.deactivated');

        return $user;
    }
}
