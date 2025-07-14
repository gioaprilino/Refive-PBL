<?php

return [
    /*
    |--------------------------------------------------------------------------
    | HRD Notification Email
    |--------------------------------------------------------------------------
    |
    | This email address will receive all important HR-related notifications,
    | such as contract expiration warnings. Make sure this corresponds to
    | an existing user in your `users` table.
    |
    */
    'notification_email' => env('HRD_NOTIFICATION_EMAIL', 'hrd@example.com'),
];
