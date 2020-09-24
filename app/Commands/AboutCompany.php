<?php

namespace App\Commands;

class AboutCompany extends BaseCommand
{

    function processCommand()
    {
        $this->getBot()->sendMessage($this->user->chat_id, $this->text['about_company_text']);
    }

}