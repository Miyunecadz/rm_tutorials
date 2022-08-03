<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\MarkUpController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FileManagerController::class, 'index'])->name('dashboard');
Route::get('/download', [FileManagerController::class, 'downloadFile'])->name('file.downloadFile');

Route::middleware(['auth'])->group(function () {

    Route::controller(FileManagerController::class)->group(function(){
        Route::get('/create', 'create')->name('folder.create');
        Route::post('/create', 'store')->name('folder.store');
        Route::get('/delete', 'delete')->name('folder.delete');
        Route::get('/file/open', 'openFile')->name('file.open');
        Route::get('/get-video', 'getVideo')->name('get.video');
    });

    Route::controller(MarkUpController::class)->prefix('/markups')->group(function(){
        Route::get('/', 'create')->name('markups.create');
        Route::post('/', 'store')->name('markups.store');
        Route::get('/{markup}', 'open')->name('markups.open');
        Route::get('/{markup}/edit', 'edit')->name('markups.edit');
        Route::put('/{markup}', 'update')->name('markups.update');
        Route::get('/{markup}/delete', 'delete')->name('markups.delete');
    });

    Route::controller(FileUploadController::class)->group(function(){
        Route::get('/upload', 'uploadPage')->name('file.upload');
        Route::post('/uploadLargeFiles', 'uploadLargeFiles')->name('file.uploadLargeFiles');
        Route::get('/delete', 'delete')->name('file.delete');
    });

    Route::controller(LinkController::class)->prefix('link')->group(function(){
        Route::get('/', 'create')->name('link.create');
        Route::post('/', 'store')->name('link.store');
        Route::get('/{link}/edit', 'edit')->name('links.edit');
        Route::put('/{link}', 'update')->name('links.update');
        Route::get('/{link}', 'delete')->name('link.delete');
    });


    Route::controller(AuthenticationController::class)->group(function(){
        Route::post('/logout', 'logout')->name('logout');
    });

    Route::controller(UserController::class)->group(function(){
        Route::get('/profile', 'index')->name('user.profile');
        Route::post('/profile', 'updateProfile')->name('user.update-profile');
        Route::get('/profile/change-password', 'editPassword')->name('user.edit-password');
        Route::post('/profile/change-password', 'updatePassword')->name('user.update-password');
    });
});

Route::middleware(['guest'])->group(function () {
    Route::controller(AuthenticationController::class)->group(function(){
        Route::get('/login','index')->name('login');
        Route::post('/login', 'authenticate')->name('authenticate');
    });
});

