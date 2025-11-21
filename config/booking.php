<?php

return [
    'timezone' => env('APP_TIMEZONE', 'Europe/Prague'),
    'checkin_time' => env('BOOKING_CHECKIN_TIME', '14:00'),
    'checkout_time' => env('BOOKING_CHECKOUT_TIME', '10:00'),
    'min_stay_default' => env('BOOKING_MIN_STAY_DEFAULT', 1),
    'min_lead_days' => env('BOOKING_MIN_LEAD_DAYS', 1),
];
