<?php

namespace App\Utils;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

/**
 * Utility class to handle logics for sms notifications for GMP SMS API
*/
class SmsUtility
{
    /**
     * Receive a json formatted data with sms parameters to be sent
     * @param string $data json formatted string
     * @return Response|null
     */
    private static function send(string $data): Response | null
    {
        $hash = hash_hmac('sha256', $data, env('GMP_SMS_API_KEY'),true);

        return Http::withHeaders([
            'X-Auth-Request-Hash' => base64_encode($hash),
            'X-Auth-Request-Id' => env('GMP_SMS_USER_EMAIL'),
            'X-Auth-Request-Type' => 'api'
        ])->post(env('GMP_URL'),['data' => $data,'datetime' => now()]);
    }

    /**
     * receive sms input from user and prepare json format to be sent to GMP API
     *
     * @param array $input array input in the format of
     * ['recipients' => ['0655270331','255716678117','0712096434','0679229536'],
     * 'message' => 'Message intended to be sent'
     * ]
     * @return PromiseInterface|Response|null
     */

    public static function setSMSPayload(array $input): PromiseInterface|Response|null
    {
        $recipients = self::setRecipients($input['recipients']); //list  of people to send sms to always pass an array

        $message = $input['message'];
        $senderId = env('GMP_SMS_SENDER_ID'); //Sender id set from .env file
        $mobileServiceId = env('GMP_SMS_MOBILE_SERVICE_ID'); // Mobile service id from .env file
        $payload = self::setPayload($recipients, $message, $mobileServiceId, $senderId);
        return self::send($payload);
    }

    /**
     * Always receive recipients as an array and set it to a string with comma separated for sending sms
     * @param array $recipientsInput  array of mobile numbers ['0655270331','0679229536'] can be an array of one number
     * @return string
     */
    private static function setRecipients(array $recipientsInput): string
    {
        $recipients = "";
        foreach ($recipientsInput as $index => $str){
            if($index == 0)
                $recipients = $recipients.$str;
            else
                $recipients = $recipients.','.$str;
        }
        return $recipients;
    }

    /**
     * @param string $recipients string of mobile number separated with comma
     * @param mixed $message string os message to be sent
     * @param mixed $mobileServiceId string of GMP API mobile service id
     * @param mixed $senderId string of GMP API sender id
     * @return string|bool
     */
    private static function setPayload(string $recipients, mixed $message, mixed $mobileServiceId, mixed $senderId): string|bool
    {
        $payload = [
            "recipients" => $recipients,
            "message" => $message,
            "datetime" => now(),
            "mobile_service_id" => $mobileServiceId,
            "sender_id" => $senderId
        ];

        return json_encode($payload);
    }
}
