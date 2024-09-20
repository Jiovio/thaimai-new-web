<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return 'Application is working!';
});


Route::get('/', function () {
    return view('welcome');
});
