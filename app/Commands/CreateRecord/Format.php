<?php

namespace App\Commands\CreateRecord;

use App\Commands\BaseCommand;
use App\Models\Record;
use App\Models\RecordContact;
use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class Format extends BaseCommand
{

    function processCommand()
    {
        if ($this->user->status === UserStatusService::FORMAT) {
            $possible_record = Record::where('user_id', $this->user->id)->where('status', 'NEW')->get();
            if ($possible_record->count()) {
                Record::where('user_id', $this->user->id)->where('status', 'NEW')->update([
                    'format' => array_flip($this->text['video_format_list'])[$this->update->getMessage()->getText()]
                ]);
            } else {
                $record_comment = RecordContact::where('status', 'NEW')->where('user_id', $this->user->id)->first();
                Record::create([
                    'record_id' => $record_comment->id,
                    'user_id' => $this->user->id,
                    'status' => 'NEW',
                    'format' => array_flip($this->text['video_format_list'])[$this->update->getMessage()->getText()]
                ]);
            }

            if ($this->update->getMessage()->getText() == 'Видео урок 16:9') {
                $this->triggerCommand(Timing::class);
            } else {
                $this->triggerCommand(Amount::class);
            }
        } else {
            $this->user->status = UserStatusService::FORMAT;
            $this->user->save();

            $buttons = [];
            foreach ($this->text['video_format_list'] as $key => $value) {
                $buttons[] = [$value];
            }

            $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['video_format'], new ReplyKeyboardMarkup($buttons, false, true));
        }
    }

}