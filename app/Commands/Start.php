<?php

namespace App\Commands;

use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class Start extends BaseCommand
{

    function processCommand()
    {
        if ($this->user->status === UserStatusService::NEW) {
            $buttons = [
                [$this->text['wake_up_producer']],
            ];
            $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['first_video_link'], new ReplyKeyboardMarkup($buttons, false, true));
        } elseif ($this->user->status === UserStatusService::DONE) {
            $this->triggerCommand(MainMenu::class);
        }
    }

}

