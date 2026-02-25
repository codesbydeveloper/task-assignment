@php($data = $notification->data ?? [])

<p>Hello {{ $notification->user->name }},</p>

<p>{{ $data['message'] ?? 'You have a new notification.' }}</p>

<p>Thanks,<br>{{ config('app.name') }}</p>

