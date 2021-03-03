<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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


Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');

Route::middleware("auth")->namespace("Dashboard\\")->name("dashboard.")->prefix("dashboard")->group(function (){

    Route::get('/admin', "DashboardController@index")->name("index");

    Route::resource('users','UserController');
    Route::get('user/status/{row}','UserController@changeStatus')->name("user.status");

    Route::resource('apartment','ApartmentController');

    Route::get('apartment/status/{row}','ApartmentController@changeStatus')->name("apartment.status");

    Route::get('show/apartment','ApartmentController@MyApartment')->name('owner');
    Route::get('edit/apartment/{id}','ApartmentController@edit')->name('owner.edit');


});
Route::resource('message','Dashboard\MessageController');
Route::get('/','MainController@index')->name("main");

Route::get('/house/{id}','MainController@show')->name("house");
Route::get('/houses','MainController@showAll')->name("house.all");
Route::get('search/houses','MainController@search')->name("house.search");
