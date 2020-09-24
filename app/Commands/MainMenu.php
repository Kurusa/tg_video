<?php

namespace App\Commands;

use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class MainMenu extends BaseCommand
{

    function processCommand()
    {
        $this->user->status = UserStatusService::DONE;
        $this->user->save();

        $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['main_menu'], new ReplyKeyboardMarkup([
            [$this->text['library'], $this->text['calculation']],
            [$this->text['about_company'], $this->text['contacts']]
        ], false, true));
    }

}