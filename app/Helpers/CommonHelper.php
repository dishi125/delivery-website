<?php

namespace App\Helpers;
use Twilio\Rest\Client;
use Illuminate\Http\Request;

Class CommonHelper
{
    public static function sendOtp($phone_no,$ct='+1')
    {
        $otp = mt_rand(1000, 9999);

        if (env('APP_ENV') == 'local' || env('APP_ENV') == 'production') {
            return 5555;
        }
        $account_sid = env('ACCOUNT_SID');
        $auth_token = env('ACCOUNT_TOKEN');

        $twilio_number = env('MOBILE_NO');
        $phone_no=$ct.$phone_no;
//        dd($phone_no,$twilio_number);
        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            $phone_no,
            array(
                'from' => $twilio_number,
                'body' => $otp
            )
        );

        return $otp;
    }
    public static function SuccessfullPayemnt($phone_no,$details)
    {
        $account_sid = env('ACCOUNT_SID');
        $auth_token = env('ACCOUNT_TOKEN');

        $twilio_number = env('MOBILE_NO');
        $phone_no='+1'.$phone_no;

        $client = new Client($account_sid, $auth_token);

        $client->messages->create(
            $phone_no,
            array(
                'from' => $twilio_number,
                'body' => [
                   $details
                ],
            )
        );
    }

    public static function uploadImage($image, $path)
    {
        $filename = rand(1111111111, 9999999999) . time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path($path), $filename);

        return $filename;
    }

    public static function UTCToLocalDateTime($date_time,$time_zone = null) {
        if(! $time_zone) {
            $time_zone = env('TIME_ZONE');
        }
        return \Carbon\Carbon::parse($date_time, "UTC")->setTimezone($time_zone);
    }
}
