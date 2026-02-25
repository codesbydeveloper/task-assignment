<?php

namespace App\Jobs;

use App\Services\EmailService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public int $timeout = 60;

    public function __construct(
        public string $to,
        public string $subject,
        public string $view,
        public array $data = []
    ) {
        $this->onQueue('emails');
    }

    public function handle(EmailService $emailService): void
    {
        $emailService->sendEmail($this->to, $this->subject, $this->view, $this->data);
    }

    public function failed(?Throwable $exception): void
    {
        Log::error('SendEmailJob failed', [
            'to' => $this->to,
            'subject' => $this->subject,
            'exception' => $exception?->getMessage(),
        ]);
    }
}

