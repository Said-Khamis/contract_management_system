<?php

namespace App\Listeners;

use App\Utils\SmsUtility;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendSMSRegistrationNotification
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
    public function handle(Registered $event): void
    {
        $smsPayload = [
            "recipients" => [$event->user->phone_number],
            "message" => "Hello " . ucfirst($event->user->first_name) . ",\nPlease check your email and follow the instructions to verify your registration.",
        ];
        SmsUtility::setSMSPayload($smsPayload);
    }
}
