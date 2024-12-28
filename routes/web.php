<?php

use App\Http\Controllers\PremiseController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::view('/registration', 'users.registration')->name('registration');
Route::post('/registration', [UserController::class, 'registrationPost']);

Route::view('/login', 'users.authorisation')->name('login');
Route::post('/login', [UserController::class, 'authorisationPost']);

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/catalog', [PremiseController::class, 'getPremises'])->name('catalog');
Route::post('/catalog', [PremiseController::class, 'createPremise'])->name('createPremise');
Route::get('/catalog/regions/{districtId}', [\App\Http\Controllers\LocationController::class, 'getRegions'], );
Route::get('/catalog/cities/{regionId}', [\App\Http\Controllers\LocationController::class, 'getCities'], );
