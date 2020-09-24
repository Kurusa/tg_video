<?php

namespace App\Commands\CreateRecord;

use App\Commands\BaseCommand;
use App\Models\Record;
use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class Timing extends BaseCommand
{

    function processCommand()
    {
        if ($this->user->status === UserStatusService::TIMING) {
            Record::where('user_id', $this->user->id)->where('status', 'NEW')->update([
                'timing' => $this->update->getMessage()->getText(),
            ]);
            $this->triggerCommand(Amount::class);
        } else {
            $this->user->status = UserStatusService::TIMING;
            $this->user->save();

            $buttons = [
                ['10 минут', '15 минут', '20 минут', '25 минут'],
                ['30 минут', '35 минут', '40 минут']
            ];

            $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['timing'], new ReplyKeyboardMarkup($buttons, false, true));
        }
    }

}