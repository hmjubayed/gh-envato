<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use GuzzleHttp\Client;

class GithubRepo implements Rule
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

        try {
            $client->request(
                "GET",
                "https://api.github.com/repos/{$value}",
                [
                    "headers" => [
                        "Authorization" => "token " . env('GITHUB_PARSONAL_TOKEN'),
                        "Accept" =>  "application/vnd.github.london-preview+json"
                    ]

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
        return 'Github repo not found!';
    }
}
