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

Route::match(['get', 'post'], '/configuration', 'HomeController@configuration')->name('configuration');
