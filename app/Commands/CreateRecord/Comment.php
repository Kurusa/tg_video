<?php

namespace App\Commands\CreateRecord;

use Illuminate\Database\Capsule\Manager as DB;
use App\Commands\BaseCommand;
use App\Commands\MainMenu;
use App\Models\Record;
use App\Models\RecordContact;
use App\Services\Status\UserStatusService;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;
use TelegramBot\Api\Types\ReplyKeyboardRemove;

class Comment extends BaseCommand
{

    function processCommand()
    {
        if ($this->user->status === UserStatusService::COMMENT) {
            RecordContact::where('user_id', $this->user->id)->where('status', 'NEW')->update([
                'comment' => $this->update->getMessage()->getText(),
                'status' => 'DONE',
            ]);
            Record::where('user_id', $this->user->id)->update([
                'status' => 'DONE'
            ]);

            $record = DB::table('record_contact')
                ->select(DB::raw('*'))
                ->join('record', 'record.record_id', '=', 'record_contact.id')
                ->where('record_contact.user_id', $this->user->id)
                ->get();

            $message = 'Новый заказ от <a href="tg://user?id=' . $this->user->chat_id . '">' . $this->user->bot_user_name . '</a>' . "\n" . "\n";
            foreach ($record as $value) {
                $message .= 'Формат: ' . $value->format . "\n";
                $message .= 'Количество: ' . $value->amount . "\n";
                $message .= 'Хронометраж: ' . $value->timig . "\n";
                $message .= 'Исходная запись: ' . $value->original_entry . "\n";

                $message .= ' ------------ ';
                $message .= "\n";
            }

            $message .= 'Отправка расчета на: ' . $record[0]->calculation_type . "\n";
            $message .= 'Контакт: ' . $record[0]->contact . "\n";
            $message .= 'Коментарий: ' . $record[0]->comment;

            $admin_list = explode(',', env('ADMIN_ID_LIST'));
            foreach ($admin_list as $admin) {
                $this->getBot()->sendMessage($admin, $message, 'html');
            }

            $this->user->status = UserStatusService::DONE;
            $this->user->save();
            $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['goodbye'], new ReplyKeyboardMarkup([
                [$this->text['library'], $this->text['calculation']],
                [$this->text['about_company'], $this->text['contacts']]
            ], false, true));
        } else {
            $this->user->status = UserStatusService::COMMENT;
            $this->user->save();

            $this->getBot()->sendMessageWithKeyboard($this->user->chat_id, $this->text['any_wants'], new ReplyKeyboardRemove());
        }
    }

}