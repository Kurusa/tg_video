<?php

namespace App\Commands;

use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class LetsStart extends BaseCommand
{

    function processCommand()
    {
        $buttons = [
            [$this->text['lets_go'], $this->text['later']],
        ];

        $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['hello'], new ReplyKeyboardMarkup($buttons, false, true));
    }

}

