<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\ProfessorsController;
use App\Http\Controllers\Admin\ManagersController;
use App\Http\Controllers\Admin\CalendarController;



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

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Normal Users Routes List
Route::middleware(['auth', 'user-access:0'])->group(function () {

});

//Admin Routes List
Route::middleware(['auth', 'user-access:App\Models\Admin'])->group(function () {
    Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

    Route::resource('admin/professors', ProfessorsController::class)
        ->except(['show'])
        ->names([
            'index' => 'admin.professors.index',
            'create' => 'admin.professors.create',
            'store' => 'admin.professors.store',
            'edit' => 'admin.professors.edit',
            'update' => 'admin.professors.update',
            'destroy' => 'admin.professors.destroy',
        ]);

    Route::resource('admin/managers', ManagersController::class)
        ->except(['show'])
        ->names([
        'index' => 'admin.managers.index',
        'create' => 'admin.managers.create',
        'store' => 'admin.managers.store',
        'edit' => 'admin.managers.edit',
        'update' => 'admin.managers.update',
        'destroy' => 'admin.managers.destroy',
    ]);

    Route::resource('admin/calendars', CalendarController::class)
        ->except(['show'])
        ->names([
        'index' => 'admin.calendars.index',
        'create' => 'admin.calendars.create',
        'store' => 'admin.calendars.store',
        'edit' => 'admin.calendars.edit',
        'update' => 'admin.calendars.update',
        'destroy' => 'admin.calendars.destroy',
    ]);
});

//Manager Routes List
Route::middleware(['auth', 'user-access:App\Models\Manager'])->group(function () {
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});


/* PDF ROUTES */
Route::get('/pdf', [App\Http\Controllers\PdfController::class, 'index'])->name('pdf');
Route::post('/pdf', [App\Http\Controllers\PdfController::class, 'extractData'])->name('extract');
