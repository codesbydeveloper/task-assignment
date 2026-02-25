<?php

return [
    'ip_whitelist' => array_filter(array_map('trim', explode(',', env('ADMIN_IP_WHITELIST', '127.0.0.1,::1')))),
];

