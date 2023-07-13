<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\ProfessorsController;


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
});

//Manager Routes List
Route::middleware(['auth', 'user-access:App\Models\Manager'])->group(function () {
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});


/* PDF ROUTES */
Route::get('/pdf', [App\Http\Controllers\PdfController::class, 'index'])->name('pdf');
Route::post('/pdf', [App\Http\Controllers\PdfController::class, 'extractData'])->name('extract');
