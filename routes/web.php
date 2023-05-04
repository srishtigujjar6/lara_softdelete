<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoftDeleteController;
use App\Http\Controllers\CategoryProductController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('store_data',[SoftDeleteController::class,'storeData']);
Route::get('delete_data',[SoftDeleteController::class,'deleteData']);
Route::get('list_data_with_trashed',[SoftDeleteController::class,'listAllDataWithTrashed']);
Route::get('list_data',[SoftDeleteController::class,'listAllData']);
Route::get('restore_all_data',[SoftDeleteController::class,'restoreAllData']);

Route::get('cp_store_data',[CategoryProductController::class,'storeData']);
Route::get('cp_attach_data',[CategoryProductController::class,'attachData']);
Route::get('cp_delete_data',[CategoryProductController::class,'deleteData']);
