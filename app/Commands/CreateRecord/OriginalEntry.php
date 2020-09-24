<?php

namespace App\Commands\CreateRecord;

use App\Commands\BaseCommand;
use App\Models\Record;
use App\Models\RecordContact;
use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class OriginalEntry extends BaseCommand
{

    function processCommand()
    {
        if ($this->user->status === UserStatusService::ORIGINAL_ENTRY) {
            if ($this->update->getMessage()->getText() == $this->text['no']) {
                $record_contact = RecordContact::create([
                    'user_id' => $this->user->id,
                    'original_entry' => 0,
                    'status' => 'NEW'
                ]);
            } else {
                $record_contact = RecordContact::create([
                    'user_id' => $this->user->id,
                    'original_entry' => 1,
                    'status' => 'NEW'
                ]);
            }

            Record::create([
                'record_id' => $record_contact->id,
                'user_id' => $this->user->id,
                'status' => 'NEW'
            ]);

            $this->triggerCommand(Format::class);
        } else {
            $this->user->status = UserStatusService::ORIGINAL_ENTRY;
            $this->user->save();

            $buttons = [
                [$this->text['have'], $this->text['no']]
            ];
            $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['have_initial_video'], new ReplyKeyboardMarkup($buttons, false, true));
        }
    }

}