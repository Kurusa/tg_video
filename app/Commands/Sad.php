<?php

namespace App\Commands;

use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class Sad extends BaseCommand
{

    function processCommand()
    {
        $buttons = [
            [$this->text['okay'], $this->text['thanks']],
        ];

        $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['sad'], new ReplyKeyboardMarkup($buttons, false, true));
    }

}

