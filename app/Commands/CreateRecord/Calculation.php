<?php

namespace App\Commands\CreateRecord;

use App\Commands\BaseCommand;
use App\Models\Record;
use App\Models\RecordContact;
use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;

class Calculation extends BaseCommand
{

    function processCommand()
    {
        if ($this->user->status === UserStatusService::CALCULATION) {
            RecordContact::where('user_id', $this->user->id)->where('status', 'NEW')->update([
                'calculation_type' => array_flip($this->text['calculation_format_list'])[$this->update->getMessage()->getText()]
            ]);
            switch ($this->update->getMessage()->getText()) {
                case $this->text['calculation_format_list']['call']:
                case $this->text['calculation_format_list']['telegram']:
                case $this->text['calculation_format_list']['whatsapp']:
                    $this->triggerCommand(PhoneNumber::class);
                    break;
                case $this->text['calculation_format_list']['email']:
                    $this->triggerCommand(Email::class);
                    break;
            }
        } else {
            $this->user->status = UserStatusService::CALCULATION;
            $this->user->save();

            $buttons = [];
            foreach ($this->text['calculation_format_list'] as $key => $value) {
                $buttons[] = [$value];
            }

            $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['where_to_send_calculation'], new ReplyKeyboardMarkup($buttons, false, true));
        }
    }

}