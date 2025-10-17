<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BoardController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PasswordController;

// admin
Route::get('/', [LoginController::class, 'loginForm']);
Route::get('/login', [LoginController::class, 'loginForm'])->name('admin.login');
Route::post('/v1/login', [LoginController::class, 'login']);
Route::get('/v1/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::middleware(['admin'])->group(function () {
  // banner
  Route::controller(BannerController::class)->group(function () {
    // index
    Route::get('/banners', 'index')->name('admin.banners');
    // delete
    Route::delete('/v1/banner/{banner}', 'delete')->name('admin.banner.delete');
    // change status
    Route::put('/v1/banner/{banner}/status', 'modifyViewStatus');
    // write
    Route::view('/banner/write', 'admin.banner_write')->name('admin.banner.write');
    // store
    Route::post('/v1/banner', 'store');
    // show
    Route::get('/banner/{banner}', 'show')->name('admin.banner.detail');
    // modify
    Route::post('/v1/banner/{banner}', 'modify');
  });

  Route::controller(BoardController::class)->group(function () {
    // delete
    Route::delete('/v1/boards/delete', 'delete');
    // restore
    Route::put('/v1/boards/restore', 'restore');
    // 삭제상태
    Route::put('/v1/boards/change-status', 'changeDeleteStatus');
    // list
    Route::get('/boards', 'index')->name('admin.apply');
    // category detail list
    Route::get('/boards/{type}', 'list');
    // delete list
    Route::get('/boards/delete/list', 'deleteList')->name('admin.apply.delete');
    // category detail board detail
    Route::get('/board/{board}', 'boardDetail')->name('admin.apply.detail');
  });

  Route::controller(NoticeController::class)->group(function () {
    // index
    Route::get('/notice', 'list')->name('admin.notice');
    // store page
    Route::view('/notice/write', 'admin.news_write')->name('admin.notice.write');
    // store
    Route::post('/v1/notice', 'store');
    // delete
    Route::delete('/v1/notice/{notice}/delete', 'delete');
  });

  // 2025.10.15 강동위 추가 - 관리자 비밀번호 변경을 위한 Route추가
  Route::get('/password', [PasswordController::class, 'edit'])->name('admin.password.edit');
  Route::put('/password', [PasswordController::class, 'update'])->name('admin.password.update');
});
