<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\DatasetViewController;
use App\Http\Controllers\Frontend\HomeViewController;
use App\Http\Controllers\Frontend\InfografikViewController;
use App\Http\Controllers\Frontend\VisualisasiViewController;
use App\Http\Controllers\Frontend\PDViewController;
use App\Http\Controllers\Manajemen\AjaxController;
use App\Http\Controllers\Manajemen\DashboardController;
use App\Http\Controllers\Manajemen\DatasetController;
use App\Http\Controllers\Manajemen\InfografikController;
use App\Http\Controllers\Manajemen\PermissionController;
use App\Http\Controllers\Manajemen\RoleController;
use App\Http\Controllers\Manajemen\SliderController;
use App\Http\Controllers\Manajemen\TestimoniController;
use App\Http\Controllers\Manajemen\UnduhanController;
use App\Http\Controllers\Manajemen\UserController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/', [HomeViewController::class, 'index'])->name('frontend.home');

Route::get('dataset', [DatasetViewController::class, 'index'])->middleware('stripEmptyParams')->name('frontend.dataset.index');
Route::get('dataset/{slug}', [DatasetViewController::class, 'detail'])->name('frontend.dataset.detail');

Route::get('perangkat-daerah', [PDViewController::class, 'index'])->name('frontend.opd');

Route::get('visualisasi', [VisualisasiViewController::class, 'index'])->name('frontend.visualisasi.index');

Route::get('infografik', [InfografikViewController::class, 'index'])->name('frontend.infografik.index');
Route::get('infografik/{slug}', [InfografikViewController::class, 'detail'])->name('frontend.infografik.detail');

// public ajax reseponse
Route::post('ajax/kirim-testimoni', [HomeViewController::class, 'storeTestimoni'])->name('ajax.testimoni.store');
Route::get('ajax/tags/cari/{search}', [AjaxController::class, 'tagsSearch'])->name('ajax.tags.search');

// Authentication Routes...
Route::get('menanjak', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('menanjak', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'preventBackHistory'], 'prefix' => 'dashboard'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // -------------- Admin Menu
    Route::resource('permissions', PermissionController::class);

    Route::resource('roles', RoleController::class);
    Route::post('roles/datatable/api', [RoleController::class, 'datatableAPI'])->name('roles.datatable.api');

    Route::resource('users', UserController::class);
    Route::post('users/datatable/api', [UserController::class, 'datatableAPI'])->name('users.datatable.api');

    Route::resource('dataset', DatasetController::class);

    Route::resource('slider', SliderController::class);
    Route::post('slider/datatable/api', [SliderController::class, 'datatableAPI'])->name('slider.datatable.api');

    Route::resource('infografik', InfografikController::class);
    Route::post('infografik/datatable/api', [InfografikController::class, 'datatableAPI'])->name('infografik.datatable.api');

    Route::resource('testimoni', TestimoniController::class);
    Route::post('testimoni/datatable/api', [TestimoniController::class, 'datatableAPI'])->name('testimoni.datatable.api');
    Route::get('testimoni/status/show/update/{id}', [TestimoniController::class, 'updateStatus'])->name('testimoni.status.show.update');

    Route::resource('unduhan', UnduhanController::class);
    Route::post('unduhan/datatable/api', [UnduhanController::class, 'datatableAPI'])->name('unduhan.datatable.api');
});

Route::get('artisan-clear', function() {
    Artisan::call('config:clear'); 
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return 'Configuration clear command success!';
});

Route::get('migrate-fresh-seed', function() {
    Artisan::call('migrate:fresh');
    Artisan::call('db:seed');
    return 'Migrate fresh and seed command success!';
});