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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::match(['get', 'post'], '/contest', 'HomeController@listContest')->name('listContest');

Route::match(['get', 'post'], '/contest/create', 'HomeController@createContest')->name('createContest');

Route::match(['get', 'post'], '/contest/{id}', 'HomeController@viewContest')->name('viewContest');

Route::match(['get', 'post'], '/contest/edit/{id}', 'HomeController@editContest')->name('editContest');

Route::match(['get', 'post'], '/contest/{contestId}/sportsman/edit/{id}', 'HomeController@editSportsman')->name('editSportsman');

Route::match(['get', 'post'], '/cards/contest/{id}', 'HomeController@cardsContest')->name('cardsContest');

Route::match(['get', 'post'], '/cards/contest/{id}/allcards', 'HomeController@printAllCards')->name('printAllCards');

Route::match(['get', 'post'], '/cards/edit/contest/{id}/sportsman/{sportsmanId}', 'HomeController@editCard')->name('editCard');

Route::match(['get', 'post'], '/changer/{contestId}', 'HomeController@changer')->name('changer');

Route::match(['get', 'post'], '/configuration', 'HomeController@configuration')->name('configuration');

Route::match(['get', 'post'], '/contest/delete/{id}', 'HomeController@deleteContest')->name('deleteContest');
