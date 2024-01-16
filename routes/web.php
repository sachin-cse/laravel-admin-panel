<?php

use App\Models\User;

use App\Models\Activitylog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TestimonialController;


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
        
        $total_users = User::all()->count();
        $activity_log = new Activitylog();
        $data = [
            'current_logged_id' => Auth::user()->id,
            'user_name' => Auth::user()->name,
            'user_type' => Auth::user()->usertype,
            'ip_address' => request()->ip(),
            'device_access' => request()->userAgent()

        ];

        if(!Activitylog::where(['current_logged_id' => Auth::user()->id])->exists()){
            $activity_log->create($data);
        }
        return view('admin.dashboard', ['total_users' => $total_users]);
    });
});

// route group function
Route::group([
    'prefix' => 'admin',
    'middleware' => ['admin', 'auth:sanctum']
], function(){
    Route::get('/register-roles', [DashboardController::class, 'register_roles'])->name('users.roles');
    Route::get('/about-us', [DashboardController::class, 'about_usview'])->name('aboutus.view');

    Route::post('/store', [DashboardController::class, 'store_aboutus'])->name('aboutus.store');

    Route::get('/aboutus/{id}', [DashboardController::class, 'fetch_aboutus'])->name('about.data');
    Route::post('/update-user/aboutus/{id}', [DashboardController::class, 'update_aboutus'])->name('aboutus.update');
    Route::delete('/delete/aboutus/{id}', [DashboardController::class, 'delete_aboutus'])->name('aboutus.delete');

    Route::get('/home', [HomeController::class, 'index']);

    Route::get('/fetch-data/{id}', [HomeController::class, 'fetch_data'])->name('fetch.data');
    Route::post('/update-user/{id}', [HomeController::class, 'update_user']);
    Route::delete('delete-user/{id}', [HomeController::class, 'destroy']);
    Route::get('/services', [HomeController::class, 'services'])->name('admin.services');
    Route::post('/services/create', [HomeController::class, 'services_create'])->name('admin.services.create');
    Route::get('/services/edit/{id}', [HomeController::class, 'services_edit'])->name('admin.services.edit');
    Route::post('/services/update/{id}', [HomeController::class, 'services_update'])->name('admin.services.update');
    Route::delete('/services/delete/{id}', [HomeController::class, 'services_delete'])->name('admin.services.delete');
    Route::get('/services/banner', [HomeController::class, 'banner'])->name('admin.services.banner');
    Route::post('/services/banner/store', [HomeController::class, 'banner_store'])->name('admin.store.banner');
    Route::get('/services/banner/edit/{id}', [HomeController::class, 'banner_edit'])->name('admin.edit.banner');
    Route::post('/services/banner/update/{id}', [HomeController::class, 'banner_update'])->name('admin.update.banner');
    Route::delete('/services/banner/delete/{id}', [HomeController::class, 'banner_delete'])->name('admin.delete.banner');
    Route::get('/services/communication', [HomeController::class, 'communication'])->name('admin.serivices.communication');
    Route::post('/services/sendemail', [HomeController::class, 'sendEmail'])->name('admin.send.email');
    Route::delete('/services/bulkDelete', [HomeController::class, 'bulkDelete'])->name('admin.services.bulkDelete');
    Route::get('/activity/log', [HomeController::class, 'activityLog'])->name('admin.activity.log');

    Route::get('/search', [HomeController::class, 'search'])->name('search');

    Route::get('/autocomplete/search', [HomeController::class, 'autocomplete'])->name('autocomplete.search');
    Route::get('/activity-log/download/{format}/{id}', [ActivityLogController::class, 'downloadFormat'])->name('download.Format');
    Route::get('/testimonial', [TestimonialController::class, 'index'])->name('admin.testimonial');
    Route::post('/testimonial/store', [TestimonialController::class, 'testimonial_store'])->name('admin.testimonial.store');
    Route::get('/testimonial/edit/{id}', [TestimonialController::class, 'testimonial_edit'])->name('admin.testimonial.edit');
    Route::put('/testimonial/update/{id}', [TestimonialController::class, 'testimonial_update'])->name('admin.testimonial.update');
    Route::delete('/testimonial/delete/{id}', [TestimonialController::class, 'deleteTestimonial'])->name('admin.testimonial.delete');
    Route::delete('/testimonial/bulkDelete', [TestimonialController::class, 'bulkDelete'])->name('admin.testimonial.bulkDelete');
});

