<?php

namespace App\Commands\CreateRecord;

use App\Commands\BaseCommand;
use App\Models\Record;
use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class Amount extends BaseCommand
{

    function processCommand()
    {
        if ($this->user->status === UserStatusService::AMOUNT) {
            Record::where('user_id', $this->user->id)->where('status', 'NEW')->update([
                'amount' => $this->update->getMessage()->getText(),
            ]);
            $this->triggerCommand(IsItAll::class);
        } else {
            $this->user->status = UserStatusService::AMOUNT;
            $this->user->save();

            $buttons = [
                ['1', '2', '3', '4', '5'],
                ['6', '7', '8', '9', '10']
            ];

            $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['how_much_video'], new ReplyKeyboardMarkup($buttons, false, true));
        }
    }

}