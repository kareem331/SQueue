<?php

use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Register
Route::post('get-register',[UserController::class,'Register']);
Route::post('user-login',[UserController::class,'Login']);
Route::get('user-profile',[UserController::class,'UserProfile']);
####################################################################
//Category Api
Route::post('/get-insert', [CategoryController::class,'insert']);
Route::get('/get-categories', [CategoryController::class,'getCategories']);
#####################################################
//Place Api
Route::post('/insert-place',[PlaceController::class,'insertPlace']);
Route::get('/get-places/{id}',[PlaceController::class,'getPlaces']);
######################################################
//Branch Api
Route::post('/insert-branch',[BranchController::class,'insertBranch']);
Route::get('/get-branches/{id}',[BranchController::class,'getBranches']);
#########################################################
//Favorites Api
Route::post('add-favorite',[FavoriteController::class,'AddFavorite']);
Route::get('/get-favorites/{id}',[FavoriteController::class,'getFavorite']);
############################################################################
//Reservation Api
Route::post('add-reservation',[ ReservationController::class,'Reservation']);
Route::get('/get-reservations',[ReservationController::class,'getReservations'])->middleware('auth:api');
Route::post('update-reservations',[ReservationController::class,'updateCurrentReservation']);
