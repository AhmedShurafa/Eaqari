<?php

use App\Http\Controllers\Dashboard\ApartmentController;
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


    Route::get('apartment/type/{id}','ApartmentController@typeApartment')->name('apartment.type');


    Route::resource('apartment','ApartmentController');

    Route::get('apartment/famous/{row}','ApartmentController@changeFamous')->name("apartment.famous");


    Route::get('apartment/status/admin/{row}','ApartmentController@changeStatus')->name("apartment.admin.status");
    Route::get('apartment/status/owner/{row}','ApartmentController@Status')->name("apartment.owner.status");


    Route::get('show/apartment','ApartmentController@MyApartment')->name('owner');
    Route::get('edit/apartment/{id}','ApartmentController@edit')->name('owner.edit');

    Route::get('trash','DashboardController@getAllTrashed')->name('trashed');

    Route::get('restore/owner/{id}','DashboardController@restoreOwner')->name('restore.owner');

    Route::get('restore/apartment/{id}','DashboardController@restoreApartment')->name('restore.apartment');

    Route::get('restore/message/{id}','DashboardController@restoreMessage')->name('restore.message');

});

Route::resource('message','Dashboard\MessageController');

Route::get('/','MainController@index')->name("main");

Route::get('/house/{id}','MainController@show')->name("house");
Route::get('/houses','MainController@showAll')->name("house.all");
Route::get('search/houses','MainController@search')->name("house.search");
