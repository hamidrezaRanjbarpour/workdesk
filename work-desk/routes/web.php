<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;

require __DIR__ . '/auth.php';
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
    return redirect()->route('companies.index');
});
//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

Route::get('companies/all', [CompanyController::class, 'showAll']);
Route::resource('companies', CompanyController::class);
//Route::get('companies/', []);

Route::prefix('working_hours')->group(function (){
    Route::get('create', [\App\Http\Controllers\WorkingHoursController::class, 'create'])->name('working_hours.create');
    Route::post('store', [\App\Http\Controllers\WorkingHoursController::class, 'store'])->name('working_hours.store');
    Route::post('update/{work_hour}', [\App\Http\Controllers\WorkingHoursController::class, 'update'])->name('working_hours.update');
    Route::delete('delete/{work_hour}', [\App\Http\Controllers\WorkingHoursController::class, 'destroy'])->name('working_hours.delete');
    Route::get('{company:id}', [\App\Http\Controllers\WorkingHoursController::class, 'index'])->name('working_hours.index');
});

Route::get('login-dev', function (){
    auth()->loginUsingId(1);
    return csrf_token();
});

Route::get('side', function (){
    return view('sidebar');
});
