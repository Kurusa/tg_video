<?php

namespace App\Commands\CreateRecord;

use App\Commands\BaseCommand;
use App\Models\Record;
use App\Models\RecordContact;
use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;
use TelegramBot\Api\Types\ReplyKeyboardRemove;

class PhoneNumber extends BaseCommand
{

    function processCommand()
    {
        if ($this->user->status === UserStatusService::PHONE_NUMBER) {
            RecordContact::where('user_id', $this->user->id)->where('status', 'NEW')->update([
                'contact' => $this->update->getMessage()->getText(),
            ]);
            $this->triggerCommand(Comment::class);
        } else {
            $this->user->status = UserStatusService::PHONE_NUMBER;
            $this->user->save();

            $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['write_phone_number'], new ReplyKeyboardRemove());
        }
    }

}