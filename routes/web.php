<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('form/{id}', 'HomeController@formshow')->name('home.formshow');
    Route::post('/submission', 'HomeController@submission')->name('home.submission');


    Route::group(['middleware' => ['guest']], function () {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
    });

    Route::group(['middleware' => ['auth']], function () {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
        Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::get('user/list', [UserController::class, 'list'])->name('user.list');

        Route::post('/change-password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('update-password');
        Route::get('contact/', [ContactController::class, 'index'])->name('contact.index');
        Route::get('contact/create', [ContactController::class, 'create'])->name('contact.create');
        Route::post('contact/store', [ContactController::class, 'store'])->name('contact.store');
        Route::post('contact/update', [ContactController::class, 'update'])->name('contact.update');
        Route::get('contact/showform/{id}', [ContactController::class, 'showform'])->name('contact.showform');
        Route::get('contact/edit/{id}', [ContactController::class, 'edit'])->name('contact.edit');
        Route::get('contact/delete/{id}', [ContactController::class, 'delete'])->name('contact.delete');
    });
});
