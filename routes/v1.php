<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ApplicationController;


// 신청서 접수
Route::post('/application',[ApplicationController::class,'store']);
// 신청서 저장 및 카카오 알림톡
Route::post('/application/{board}',[ApplicationController::class,'storeBoard']);
