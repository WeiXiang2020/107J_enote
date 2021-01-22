<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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
    return view('auth/login');
});

//學生登入後頁面
//Route::middleware(['auth:sanctum', 'verified'])
//    ->get('/students/home',[StudentController::class,'home'])->name('students.home');
Route::get('/students/home',[StudentController::class,'home'])->name('students.home');
//課程頁面
Route::get('/classes/1',[\App\Http\Controllers\CourseController::class,'index'])->name('classes.index');
//顯示公告資訊
Route::get('/notices/1',[\App\Http\Controllers\NoticeController::class,'show'])->name('notices.show');

