<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestController;

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
    return view('/auth/login');
});

Route::get('/about', function () {
    return view('about');
}); 
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $users = DB::table('users')->get();
    return view('dashboard', compact('users'));
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/department/all', [DepartmentController::class, 'index'])->name('department');
    Route::post('/department/save', [DepartmentController::class, 'save'])->name('savedepartment');
    Route::get('/department/edit/{id}', [DepartmentController::class, 'edit']);
    Route::post('/department/update/{id}', [DepartmentController::class, 'update']);
    Route::get('/department/softdelete/{id}', [DepartmentController::class, 'softdelete']);
    Route::get('/department/restore/{id}', [DepartmentController::class, 'restore']);
    Route::get('/department/delete/{id}', [DepartmentController::class, 'delete']);
    Route::get('/department/pdf', [DepartmentController::class, 'pdf'])->name('pdf');
    Route::get('/department/createPDF', [DepartmentController::class, 'createPDF']);
    
    Route::get('/service/all', [ServiceController::class, 'index'])->name('services');
    Route::post('/service/save', [ServiceController::class, 'save'])->name('saveservice');
    Route::get('/service/edit/{id}', [ServiceController::class, 'edit']);
    Route::post('/service/update/{id}', [ServiceController::class, 'update']);
    Route::get('/service/delete/{id}', [ServiceController::class, 'delete']);
    
    
    Route::get('/test', [TestController::class, 'index'])->name('test');
});
