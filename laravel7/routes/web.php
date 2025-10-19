<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() { 
    
    return response(
        'api',
        200,
        [
            'Content-Type' => 'text/plain',
            'Charset' => 'UTF-8'
        ]
    );

});
