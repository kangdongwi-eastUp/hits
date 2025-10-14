<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ApplicationController;
use App\Http\Controllers\User\NoticeController;
use App\Http\Controllers\User\BannerController;

// user
Route::get('/',[BannerController::class,'index'])->name('user.index');

// application write
Route::get('/application',[ApplicationController::class,'write'])->name('user.application.write');

// application preview
Route::get('/application/{board}',[ApplicationController::class,'previewShow'])->name('user.application.detail');

// application apply complete
Route::view('/application-apply/complete','user.complete')->name('user.application.complete');

// 소식
Route::get('/notice',[NoticeController::class,'index'])->name('user.notice');

// 단가표
Route::view('/table','user.table');

// 사업자 정보
Route::view('/info','user.info');
