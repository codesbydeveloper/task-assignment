<?php

namespace App\Services;

use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendEmail(string $to, string $subject, string $view, array $data = []): void
    {
        Mail::send($view, $data, function ($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });

    }

    public function queueEmail(string $to, string $subject, string $view, array $data = []): void
    {
        SendEmailJob::dispatch($to, $subject, $view, $data)->onQueue('emails');
    }
}

