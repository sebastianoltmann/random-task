<?php

use App\V1\Modules\Houses\Notifications\Domain\Strategies\EmailNotifierStrategy;

return [
    'notifications' => [
        'strategies' => [
            EmailNotifierStrategy::class,
            //            SmsNotifierStrategy::class,
        ],
    ],

    'thermostats' => [
        'notifications' => [
            // If temperature is smaller than this value, the notification will be sent
            'mix_temperature' => 15,
        ],
    ],
];
