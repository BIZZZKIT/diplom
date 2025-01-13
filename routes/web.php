<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PremiseController;
use App\Http\Controllers\ReportsController;
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

Route::get('/', [MainPageController::class, 'getDataForMainPage'])->name('welcome');


Route::view('/registration', 'users.registration')->name('registration');
Route::post('/registration', [UserController::class, 'registrationPost']);

Route::view('/login', 'users.authorisation')->name('login');
Route::post('/login', [UserController::class, 'authorisationPost']);


Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::post('/catalog', [PremiseController::class, 'createPremise'])->name('createPremise');
    Route::post('/catalog/savePremise/{premiseId}', [\App\Http\Controllers\SavedPremisesController::class, 'createSavedPremises'])->name('savePremise');
    Route::get('/savedPremises', [\App\Http\Controllers\SavedPremisesController::class, 'getSavedPremise'])->name('savedPremises');
    Route::delete('/savedPremises/delete/{premiseId}', [\App\Http\Controllers\SavedPremisesController::class, 'deleteSavedPremise'])->name('deleteSavedPremise');
    Route::get('yourPremises', [PremiseController::class, 'getYoursPremises'])->name('yourPremises');
    Route::delete('yourPremises/{premiseId}', [PremiseController::class, 'deleteYourPremise'])->name('deleteYourPremise');
    Route::put('/yourPremises/edit/{premiseId}', [PremiseController::class, 'editYourPremise'])->name('editYourPremise');
    Route::post('/catalog/report/{premiseId}', [ReportsController::class, 'createReport'])->name('createReport');
    Route::get('/reports', [ReportsController::class, 'getYoursReports'])->name('yoursReports');
    Route::post('/contacts', [\App\Http\Controllers\ReviewsController::class, 'createReview'])->name('createReview');
});
Route::get('/catalog', [PremiseController::class, 'getPremises'])->name('catalog');
Route::get('/catalog/filter', [PremiseController::class, 'filterPremises'])->name('catalog.filter');

Route::get('/catalog/regions/{districtId}', [LocationController::class, 'getRegions']);
Route::get('/catalog/cities/{regionId}', [LocationController::class, 'getCities']);
Route::get('/catalog/premiseItem/{premiseId}', [\App\Http\Controllers\PremiseController::class, 'getPremiseItem'])->name('premiseItem');


Route::view('/about', 'about')->name('about');
Route::view('/contacts', 'contacts')->name('contact');

Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', [AdminController::class, 'getAllReports'])->name('admin');
    Route::put('/admin/deleteFromCatalog/{premiseId}', [AdminController::class, 'deletePremiseFromCatalog'])->name('deletePremiseFromCatalog');
    Route::post('/admin/ban/{userId}', [AdminController::class, 'getBanUser'])->name('banUser');
    Route::post('/admin/createNews', [NewsController::class, 'createNews'])->name('createNews');
    Route::post('/admin/deniedReport/{reportId}', [AdminController::class, 'changeStatusDenied'])->name('changeStatusDenied');
    Route::get('/admin/reviews', [AdminController::class, 'getReviewsAll'])->name('reviews');
    Route::delete('/admin/deleteReview/{reviewId}', [AdminController::class, 'deleteReview'])->name('deleteReview');
});
