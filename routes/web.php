<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $sensors = DB::table('sensors')->first();
    $led = $sensors->led;
    $servo = $sensors->servo;
    return view('welcome', compact("led","servo"));
});


