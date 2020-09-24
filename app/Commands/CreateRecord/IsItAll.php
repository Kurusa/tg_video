<?php

namespace App\Commands\CreateRecord;

use App\Commands\BaseCommand;
use App\Models\Record;
use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class IsItAll extends BaseCommand
{

    function processCommand()
    {
        if ($this->user->status === UserStatusService::IS_IT_ALL) {
            Record::where('user_id', $this->user->id)->update([
                'status' => 'DONE'
            ]);
            if ($this->update->getMessage()->getText() == $this->text['its_all']) {
                $this->triggerCommand(Calculation::class);
            } else {
                $this->triggerCommand(Format::class);
            }
        } else {
            $this->user->status = UserStatusService::IS_IT_ALL;
            $this->user->save();

            $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['is_it_all'], new ReplyKeyboardMarkup([
                [$this->text['its_all'], $this->text['need_more']]
            ], false, true));
        }
    }

}