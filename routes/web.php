<?php

use App\Http\Controllers\TodoListController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [TodoListController::class, 'index'])->name('/');
Route::post('/store', [TodoListController::class, 'store'])->name('store');
Route::patch('/update/{id}', [TodoListController::class, 'update'])->name('update');
Route::delete('/delete/{id}', [TodoListController::class, 'destroy'])->name('delete');
