<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
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
//all listings
Route::get('/', [ListingController::class , 'index'] );

//create form
Route::get('/listings/create',[ListingController::class ,'create'] )->middleware('auth');

// store listing date
Route::post('/listings',[ListingController::class ,'store'])->middleware('auth');

// Show edit listings
Route::get('/listings/{listing}/edit ', [ListingController::class,'edit'])->middleware('auth');
//Update listing
Route::put('/listings/{listing}',[ListingController::class,'update'])->middleware('auth');
//Delete listing
Route::delete('/listings/{listing}',[ListingController::class,'destroy'])->middleware('auth');
//Manage listings
Route::get('/listings/manage',[ListingController::class,'manage'])->middleware('auth');
// single listings
Route::get('/listings/{listing}',[ListingController::class ,'show'] );
// show register
Route::get('/register',[UserController::class,'create'])->middleware('guest');
// create a new user
Route::post('/users',[UserController::class,'store']);
// Log User out
Route::post('/logout',[UserController::class,'logout'])->middleware('auth');
//show login file
Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');
//login in user
Route::post('/users/authenticate',[UserController::class,'authenticate']);



