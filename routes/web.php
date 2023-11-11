<?php

use App\Http\Controllers\Admin\DashboardController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


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
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::get('/register-roles', [DashboardController::class, 'register_roles'])->name('users.roles');
    Route::get('/about-us', [DashboardController::class, 'about_usview'])->name('aboutus.view');

    // Route::get('/about-us', function() {
    //     return view('admin.aboutus');
    // });

    Route::post('/store', [DashboardController::class, 'store_aboutus'])->name('aboutus.store');

    Route::get('/admin/aboutus/{id}', [DashboardController::class, 'fetch_aboutus'])->name('about.data');
    Route::post('/update-user/aboutus/{id}', [DashboardController::class, 'update_aboutus'])->name('aboutus.update');
    Route::delete('/delete/aboutus/{id}', [DashboardController::class, 'delete_aboutus'])->name('aboutus.delete');

    Route::get('/home', [HomeController::class, 'index']);

    Route::get('/fetch-data/{id}', [HomeController::class, 'fetch_data'])->name('fetch.data');
    Route::post('/update-user/{id}', [HomeController::class, 'update_user']);
    Route::delete('delete-user/{id}', [HomeController::class, 'destroy']);
    Route::get('/admin/services', [HomeController::class, 'services'])->name('admin.services');
    Route::post('/admin/services/create', [HomeController::class, 'services_create'])->name('admin.services.create');
    Route::get('/admin/services/edit/{id}', [HomeController::class, 'services_edit'])->name('admin.services.edit');
    Route::post('/admin/services/update/{id}', [HomeController::class, 'services_update'])->name('admin.services.update');
    Route::delete('/admin/services/delete/{id}', [HomeController::class, 'services_delete'])->name('admin.services.delete');
    Route::get('/admin/services/banner', [HomeController::class, 'banner'])->name('admin.services.banner');
    Route::post('admin/services/banner/store', [HomeController::class, 'banner_store'])->name('admin.store.banner');
    Route::get('admin/services/banner/edit/{id}', [HomeController::class, 'banner_edit'])->name('admin.edit.banner');
    Route::post('/admin/services/banner/update/{id}', [HomeController::class, 'banner_update'])->name('admin.update.banner');
    Route::delete('/admin/services/banner/delete/{id}', [HomeController::class, 'banner_delete'])->name('admin.delete.banner');
});

