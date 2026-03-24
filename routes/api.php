<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get("/led-state", function () {
    $sensors = DB::table('sensors')->first();
    return response()->json([
        'led' => $sensors->led,
        'servo' => (int)$sensors->servo,
        // 'buzzer' => $sensors->buzzer,
    ]);
});

Route::post("/led", function (Request $request) {
    DB::table("sensors")->update([
        "led" => $request->getContent(),
    ]);
    return "success";
});

Route::post("/servo", function (Request $request) {
    DB::table("sensors")->update([
        "servo" => $request->getContent(),
    ]);
    return "success";
});

Route::post("/buzzer", function (Request $request) {
    DB::table("sensors")->update([
        "buzzer" => $request->getContent(),
    ]);
    return "success";
});