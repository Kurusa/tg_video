<?php

namespace App\Commands;

use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class ExpertVideoSad extends BaseCommand
{

    function processCommand()
    {
        $buttons = [
            [$this->text['show'], $this->text['lets_watch']],
        ];

        $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['interesting_but_later_sad'], new ReplyKeyboardMarkup($buttons, false, true));
    }

}

