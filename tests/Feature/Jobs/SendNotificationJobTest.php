<?php

namespace Tests\Feature\Jobs;

use App\Jobs\SendNotificationJob;
use App\Models\NotificationCustom;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class SendNotificationJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_notification_job_is_dispatched(): void
    {
        Queue::fake();

        $user = User::factory()->create();

        $notification = NotificationCustom::create([
            'user_id' => $user->id,
            'channel' => 'email',
            'data' => ['message' => 'Test'],
        ]);

        SendNotificationJob::dispatch($notification->id);

        Queue::assertPushed(SendNotificationJob::class);
    }
}

