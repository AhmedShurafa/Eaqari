<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\ApartmentController;
use App\Http\Controllers\Dashboard\OwnerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

//Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/about', 'MainController@about')->name('about');

Route::namespace("Dashboard\\")->name("dashboard.")
         ->prefix("dashboard")->group(function (){

    Route::get('/admin', "DashboardController@index")->name("index");

        Route::middleware('auth:web')->group(function(){
            Route::resource('owners','OwnerController');
        });


    Route::resource('users','UserController');

    Route::get('apartment/type/{id}','ApartmentController@typeApartment')->name('apartment.type');

    Route::resource('apartment','ApartmentController');

    Route::get('apartment/famous/{row}','ApartmentController@changeFamous')->name("apartment.famous");

    Route::Delete('apartment/stauts/{row}','ApartmentController@stauts')->name("apartment.stauts");

    Route::get('trash','DashboardController@getAllTrashed')->name('trashed');

    Route::get('restore/owner/{id}','DashboardController@restoreOwner')->name('restore.owner');

    Route::get('restore/apartment/{id}','DashboardController@restoreApartment')->name('restore.apartment');

    Route::get('restore/message/{id}','DashboardController@restoreMessage')->name('restore.message');

    Route::get('restore/Transaction/{id}','DashboardController@restoreTransaction')->name('restore.Transaction');

    Route::resource('transaction','TransactionController');

    //Owner
    Route::get('owner/apartment/{id}','ApartmentController@MyApartment')->name('owner');

    Route::get('edit/apartment/{id}','ApartmentController@edit')->name('owner.edit');

    Route::get('trashed/apartment','ApartmentController@trashed')->name('owner.trashed');

    Route::get('restore/apartment/{id}','ApartmentController@restoreApartmentStatus')->name('restore.apartment');


});

Route::resource('message','Dashboard\MessageController');

Route::get('/','MainController@index')->name("main");

Route::get('/house/{id}','MainController@show')->name("house");
Route::get('/houses','MainController@showAll')->name("house.all");
Route::get('search/houses','MainController@search')->name("house.search");

Route::get('/famous','MainController@famous')->name("famous");



// Test
Route::get('login',[LoginController::class, 'login'])->name('login');
Route::post('login',[LoginController::class, 'handleLogin'])->name('user.handleLogin');
Route::post('logout',[LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class,'showRegistrationForm'])->name('showregister');
Route::post('register', [RegisterController::class,'register'])->name('register');


Route::post('logoutOwner',function (){
    Auth::guard('owner')->logout();
    return redirect('/');
})->name('logoutOwner');

Route::post('logoutCustomer',function (){
    Auth::guard('customer')->logout();
    return redirect('/');
})->name('logoutCustomer');
