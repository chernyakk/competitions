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
//use App\Http\Controllers\GuestController as GuestController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/guest', 'GuestController@listContest')->name('guestListContest');

Route::get('/guest/contest/{id}', 'GuestController@viewContest')->name('guestContest');

Route::get('/guest/cards/{id}', 'GuestController@cardsContest')->name('guestCardsContest');

Route::get('/guest/contest/{id}/final', 'GuestController@finalOfCompetition')->name('finalOfCompetition');

Route::get('/guest/contest/{id}/final/results', 'GuestController@finalResults')->name('guestFinalResults');

Route::get('/home', 'HomeController@index')->name('home');

Route::match(['get', 'post'], '/contest', 'HomeController@listContest')->name('listContest');

Route::match(['get', 'post'], '/contest/create', 'HomeController@createContest')->name('createContest');

Route::match(['get', 'post'], '/contest/{id}', 'HomeController@viewContest')->name('viewContest');

Route::match(['get', 'post'], '/contest/edit/{id}', 'HomeController@editContest')->name('editContest');

Route::match(['get', 'post'], '/contest/{contestId}/sportsman/edit/{id}', 'HomeController@editSportsman')->name('editSportsman');

Route::match(['get', 'post'], '/cards/contest/{id}', 'HomeController@cardsContest')->name('cardsContest');

Route::match(['get', 'post'], '/cards/contest/{id}/allcards', 'HomeController@getAllCards')->name('getAllCards');

Route::match(['get', 'post'], '/cards/edit/contest/{id}/sportsman/{sportsmanId}', 'HomeController@editCard')->name('editCard');

Route::match(['get', 'post'], '/contest/{id}/final', 'HomeController@finalOfContest')->name('finalOfContest');

Route::match(['get', 'post'], '/contest/{id}/final/semifinal', 'HomeController@semifinal')->name('semifinal');

Route::match(['get', 'post'], '/contest/{id}/final/finalCouples', 'HomeController@finalCouples')->name('finalCouples');

Route::match(['get', 'post'], '/contest/{id}/final/couples', 'HomeController@couplesOfFinal')->name('couplesOfFinal');

Route::match(['get', 'post'], '/contest/{id}/final/results', 'HomeController@finalResults')->name('finalResults');

Route::match(['get', 'post'], '/contest/{id}/final/edit/{id1}/vs/{id2}', 'HomeController@finalEdit')->name('finalEdit');

Route::match(['get', 'post'], '/changer/{contestId}', 'HomeController@changer')->name('changer');

Route::match(['get', 'post'], '/configuration', 'HomeController@configuration')->name('configuration');

Route::match(['get', 'post'], '/contest/delete/{id}', 'HomeController@deleteContest')->name('deleteContest');
