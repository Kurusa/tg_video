<?php

namespace App\Commands;

use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;
use TelegramBot\Api\Types\ReplyKeyboardRemove;

class AskUserName extends BaseCommand
{

    function processCommand()
    {
        if ($this->user->status === UserStatusService::SET_USER_NAME) {
            $this->user->bot_user_name = $this->update->getMessage()->getText();
            $this->user->save();

            $this->triggerCommand(ProposeGift::class);
        } else {
            $this->user->status = UserStatusService::SET_USER_NAME;
            $this->user->save();

            $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['whats_your_name'], new ReplyKeyboardRemove());
        }
    }

}

