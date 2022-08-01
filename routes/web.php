<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\FileUploadController;
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

Route::middleware(['auth'])->group(function () {

    Route::controller(FileManagerController::class)->group(function(){
        Route::get('/', 'index')->name('dashboard');
        Route::get('/create', 'create')->name('folder.create');
        Route::post('/create', 'store')->name('folder.store');
        Route::get('/delete', 'delete')->name('folder.delete');
    });

    Route::controller(FileUploadController::class)->group(function(){
        Route::get('/upload', 'uploadPage')->name('folder.upload');
        Route::get('/addlink', 'addlinkPage')->name('folder.addlink');
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

