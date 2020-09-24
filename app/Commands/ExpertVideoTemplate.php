<?php

namespace App\Commands;

use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class ExpertVideoTemplate extends BaseCommand
{

    function processCommand()
    {
        $buttons = [
            [$this->text['want_the_same'], $this->text['want_to_calculate']],
        ];

        $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['its_example'] . "\n" . $this->text['expert_example_video_link'], new ReplyKeyboardMarkup($buttons, false, true));
    }

}

