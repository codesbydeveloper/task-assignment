<p>Hello {{ $admin->name }},</p>

<p>Here is your daily system report for {{ $report->report_date->toDateString() }}.</p>

<pre style="font-size: 12px; background: #f9fafb; padding: 10px; border-radius: 4px;">
{{ json_encode($report->data, JSON_PRETTY_PRINT) }}
</pre>

<p>Regards,<br>{{ config('app.name') }}</p>

