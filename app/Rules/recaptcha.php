<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class recaptcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $client = new Client();
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' => [
                    'secret' => env('RECAPTCHA_Key'),
                    'remoteip' => request()->getClientIp(),
                    'response' => $value
                ]
            ]
        );
        $body = json_decode((string)$response->getBody());

        
        Log::info($body->success . ' / ' . $body->challenge_ts . ' / ' . $body->hostname);

        return $body->success;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'recaptcha 驗證失敗';
    }
}
