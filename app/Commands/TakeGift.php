<?php

namespace App\Commands;

use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class TakeGift extends BaseCommand
{

    function processCommand()
    {
        $buttons = [
            [$this->text['cool'], $this->text['whats_next']],
        ];

        $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['take_gift'], new ReplyKeyboardMarkup($buttons, false, true));
    }

}

