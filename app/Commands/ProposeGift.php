<?php

namespace App\Commands;

use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class ProposeGift extends BaseCommand
{

    function processCommand()
    {
        $buttons = [
            [$this->text['very'], $this->text['want_gift']],
        ];

        $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->user->bot_user_name . $this->text['now_we_friends'], new ReplyKeyboardMarkup($buttons, false, true));
    }

}

