<?php

namespace App\Jobs;

use App\Models\Sms;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $phone_number;
    private $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($phone_number, $message)
    {
        $this->phone_number = $phone_number;
        $this->message = $message;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $base_url_non_masking = 'http://66.45.237.70/';

        $usernamePassword = 'username=01634857236&password=56T8GMYA';

        $message = $this->message;

        $phone = $this->phone_number;

        $checked_digit = substr($phone, 0, 3);
        if ($checked_digit == '+88') {
            $phone = ltrim($phone, '+');
        }
        $checked_zero = substr($phone, 0, 1);
        if ( $checked_zero == 0 ) {
            $phone = '88' . $phone;
        }
        $checked_lastest = substr($phone, 0, 3);
        if ( $checked_lastest !== '880') {
            $phone = ltrim($phone, '88');
            $phone = '880' . $phone;
        }

        $url = $base_url_non_masking . "api.php?" . $usernamePassword . "&number=". $phone . "&message=". $message;

        $client = new Client();
        try {
            $client->get($url);
            logger('SMS info');
            logger($url);
        } catch (GuzzleException $exception) {
            $exception->getMessage();
        }
    }
}
