<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['auth'])->group(function () {
    // Lotteries
    Route::get('lotteries', 'LotteryController@index')->name('lottery.index');
    Route::post('lotteries', 'LotteryController@store')->name('lottery.store');
    Route::get('lottery/create', 'LotteryController@create')->name('lottery.create');
    Route::get('lottery/{lottery}/edit', 'LotteryController@edit')->name('lottery.edit');
    Route::get('lottery/{lottery}', 'LotteryController@show')->name('lottery.show');

    // Participants
    Route::post('lottery/{lottery}/participants', 'ParticipantController@store')->name('participants.store');
    Route::get('lottery/{lottery}/participants/draw', 'ParticipantController@draw')->name('participants.draw');
});
