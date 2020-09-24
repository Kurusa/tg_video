<?php
return [
    'wake_up_producer' => \App\Commands\LetsStart::class,
    'later' => \App\Commands\Sad::class,

    'lets_go' => \App\Commands\AskUserName::class,
    'okay' => \App\Commands\AskUserName::class,
    'thanks' => \App\Commands\AskUserName::class,

    'very' => \App\Commands\TakeGift::class,
    'want_gift' => \App\Commands\TakeGift::class,

    'whats_next' => \App\Commands\ProposeExpertVideo::class,
    'cool' => \App\Commands\ProposeExpertVideo::class,

    'interesting_but_later' => \App\Commands\ExpertVideoSad::class,
    'really_want' => \App\Commands\ExpertVideoTemplate::class,
    'show' => \App\Commands\ExpertVideoTemplate::class,
    'lets_watch' => \App\Commands\ExpertVideoTemplate::class,

    'want_the_same' => \App\Commands\CreateRecord\OriginalEntry::class,
    'want_to_calculate' => \App\Commands\CreateRecord\OriginalEntry::class,

    'about_company' => \App\Commands\AboutCompany::class,
    'contacts' => \App\Commands\Contact::class,
    'calculation' => \App\Commands\CreateRecord\OriginalEntry::class,
];