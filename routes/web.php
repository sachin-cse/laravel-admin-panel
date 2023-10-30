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
    Route::get('/about-us', [DashboardController::class, 'about_usview'])->name('users.roles');

    // Route::get('/about-us', function() {
    //     return view('admin.aboutus');
    // });

    Route::post('/store', [DashboardController::class, 'store_aboutus'])->name('aboutus.store');
});

Route::get('/home', [HomeController::class, 'index']);

Route::get('/fetch-data/{id}', [HomeController::class, 'fetch_data'])->name('fetch.data');
Route::post('/update-user/{id}', [HomeController::class, 'update_user']);
Route::delete('delete-user/{id}', [HomeController::class, 'destroy']);
