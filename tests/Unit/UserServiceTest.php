<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user_sets_defaults(): void
    {
        /** @var UserService $service */
        $service = $this->app->make(UserService::class);

        $user = $service->createUser([
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('user', $user->role);
        $this->assertTrue($user->active);
    }
}

