<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\NoteController;

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TaController;
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
Route::middleware(['auth:sanctum,web', 'verified'])->get('/students',[StudentController::class,'index'])
    ->name('students.index');
//課程頁面
Route::get('/classes/1',[CourseController::class,'index'])->name('classes.index')->middleware('auth');
//顯示公告資訊
Route::get('/notices/1',[NoticeController::class,'show'])->name('notices.show')->middleware('auth');
//顯示所有筆記
Route::get('/mynotes',[NoteController::class,'mynote'])->name('notes.mynotes')->middleware('auth');
//搜尋筆記
Route::get('/notes/search',[NoteController::class,'search'])->name('notes.search')->middleware('auth');

//新增空白筆記
Route::get('notes/create',[NoteController::class,'create'])->name('notes.create');
Route::post('/notes',[NoteController::class,'store'])->name('notes.store');
Route::post('image',[NoteController::class,'image'])->name('notes.image')->where('id', '[0-9]+');

Route::get('/logout',[UserController::class,'logout'])->name('logout');

//顯示&編輯筆記
Route::get('notes/{id}',[NoteController::class,'show'])->name('notes.show')->where('id', '[0-9]+');
Route::patch('notes',[NoteController::class,'update'])->name('notes.update');

//刪除筆記
Route::delete('notes/{id}',[NoteController::class,'destroy'])->name('notes.destroy')->where('id', '[0-9]+');

//分享/取消分享筆記
Route::patch('share',[NoteController::class,'share'])->name('notes.share')->where('id', '[0-9]+');

//教授首頁
Route::get('/teacher',[
    TeacherController::class,'index'
])  -> name('teacher.index');

//ta首頁
Route::get('/ta', function () {
    return view('ta.index');
});
