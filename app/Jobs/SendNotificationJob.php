<?php

namespace App\Jobs;

use App\Models\NotificationCustom;
use App\Services\EmailService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     */
    public int $tries = 3;

    /**
     * The number of seconds the job can run before timing out.
     */
    public int $timeout = 60;

    public function __construct(public int $notificationId)
    {
        $this->onQueue('notifications');
    }

    public function handle(EmailService $emailService): void
    {
        $notification = NotificationCustom::findOrFail($this->notificationId);

        if ($notification->channel === 'email' && $notification->user) {
            $emailService->sendEmail(
                $notification->user->email,
                $notification->data['subject'] ?? 'Notification',
                'emails.notification',
                ['notification' => $notification]
            );
        }

        $notification->update([
            'status' => 'sent',
            'sent_at' => now(),
        ]);
    }

    public function failed(?Throwable $exception): void
    {
        Log::error('SendNotificationJob failed', [
            'notification_id' => $this->notificationId,
            'exception' => $exception?->getMessage(),
        ]);

        NotificationCustom::whereKey($this->notificationId)->update([
            'status' => 'failed',
        ]);
    }
}

