<?php

use App\Services\Status\UserStatusService;

return [
    UserStatusService::SET_USER_NAME => \App\Commands\AskUserName::class,
    UserStatusService::ORIGINAL_ENTRY => \App\Commands\CreateRecord\OriginalEntry::class,
    UserStatusService::AMOUNT => \App\Commands\CreateRecord\Amount::class,
    UserStatusService::FORMAT => \App\Commands\CreateRecord\Format::class,
    UserStatusService::IS_IT_ALL => \App\Commands\CreateRecord\IsItAll::class,
    UserStatusService::CALCULATION => \App\Commands\CreateRecord\Calculation::class,
    UserStatusService::PHONE_NUMBER => \App\Commands\CreateRecord\PhoneNumber::class,
    UserStatusService::EMAIL => \App\Commands\CreateRecord\Email::class,
    UserStatusService::COMMENT => \App\Commands\CreateRecord\Comment::class,
    UserStatusService::TIMING => \App\Commands\CreateRecord\Timing::class,
];