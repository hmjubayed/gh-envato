<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Rules\GithubUsername;
use App\Rules\EnvatoPurchaseKey;
use App\Models\EnvatoProduct;

class EnvatoProductController extends Controller
{
    public function showVerifyForm()
    {
        return view('envato-products.verify-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', new GithubUsername],
            'code' => ['required', 'string', new EnvatoPurchaseKey]
        ]);

        $client = new Client();

        $item = $client->request(
            "GET",
            "https://api.envato.com/v3/market/buyer/purchase?code={$request->input('code')}",
            [
                "headers" => [
                    "Authorization" => "Bearer " . env('ENVATO_PARSONAL_TOKEN'),
                    'Accept'     => 'application/json',
                ],
            ]
        );

        $item = json_decode($item->getBody(), true);

        $data = EnvatoProduct::where('envato_id', $item['item']['id'])->first();


        if($data == null){
            return back()->withInput()->withErrors(['username' => 'This Item not found in our list']);
        }

        $client->request(
            "PUT",
            "https://api.github.com/repos/{$data->github_repo}/collaborators/{$request->username}",
            [
                "headers" => [
                    "Authorization" => "token " . env('GITHUB_PARSONAL_TOKEN'),
                    "Accept" =>  "application/vnd.github.london-preview+json"
                ]

            ]
        );
        return view('backend::envato-verify-product.done');
    }
}
