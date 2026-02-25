<p>System health check failed.</p>

@if (!empty($context))
    <p>Details:</p>
    <pre style="font-size: 12px; background: #f9fafb; padding: 10px; border-radius: 4px;">
{{ json_encode($context, JSON_PRETTY_PRINT) }}
    </pre>
@endif

<p>Please review the logs in the admin panel for more information.</p>

