<?php

namespace App\Listeners;

use App\Utils\SmsUtility;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EmailVerified
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Verified $event): void
    {
//        $smsPayload = [
//            "recipients" => [$event->user->phone_number],
//            "message" => "Hello " . ucfirst($event->user->first_name) . ",\nYour email has been verified.",
//        ];
//        SmsUtility::setSMSPayload($smsPayload);
    }
}
