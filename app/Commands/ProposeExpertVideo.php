<?php

namespace App\Commands;

use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class ProposeExpertVideo extends BaseCommand
{

    function processCommand()
    {
        $buttons = [
            [$this->text['really_want'], $this->text['interesting_but_later']],
        ];

        $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['watch_expert_video'], new ReplyKeyboardMarkup($buttons, false, true));
    }

}

