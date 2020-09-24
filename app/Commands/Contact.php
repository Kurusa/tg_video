<?php

namespace App\Commands;

class Contact extends BaseCommand
{

    function processCommand()
    {
        $this->getBot()->sendMessage($this->user->chat_id, $this->text['contacts_text']);
    }

}