<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\NoteController;

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

Route::get('/',[UserController::class,'home'])->name('home');

//學生登入後頁面
Route::middleware(['auth:sanctum,web', 'verified'])->get('/students/home',[StudentController::class,'home'])
    ->name('students.home');
//課程頁面
Route::get('/classes/1',[CourseController::class,'index'])->name('classes.index')->middleware('auth');
//顯示公告資訊
Route::get('/notices/1',[NoticeController::class,'show'])->name('notices.show')->middleware('auth');
//顯示所有筆記
Route::get('/mynotes',[NoteController::class,'mynote'])->name('mynotes')->middleware('auth');


Route::get('/logout',[UserController::class,'logout'])->name('logout');

