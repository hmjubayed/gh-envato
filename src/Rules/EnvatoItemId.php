<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use GuzzleHttp\Client;

class EnvatoItemId implements Rule
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
        try {
            $client = new Client();
            $client->request(
                "GET",
                "https://api.envato.com/v3/market/catalog/item?id={$value}",
                [
                    "headers" => [
                        "Authorization" => "Bearer " . env('ENVATO_PARSONAL_TOKEN'),
                        'Accept'     => 'application/json',
                    ],
                ]
            );
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Envato Item id Invalid!';
    }


}
