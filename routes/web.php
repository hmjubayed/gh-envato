<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => [
        'web',
        'auth',
    ],
    'as' => 'gh-envato.',
    'prefix' => 'backend/gh-envato',
], function (){

    Route::get('/', function(){
        return dd("gh-envato route ok");
    });
});