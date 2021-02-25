<?php

use App\Http\Controllers\CollectNoteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NoteScoreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TextbookController;

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TaController;
use App\Models\User;
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
Route::get('/classes/{id}',[CourseController::class,'index'])->name('classes.index')->middleware('auth');


////顯示公告資訊
//Route::get('/notices/{id}',[NoticeController::class,'show'])
//    ->name('notices.show')->middleware('auth');


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

//顯示課堂筆記(學生)
Route::get('/notes/classes/{id}', [NoteController::class,'cshow'])->name('notes.classes.cshow')->where('id', '[0-9]+');

//收藏/取消收藏
Route::post('favor',[CollectNoteController::class,'store'])->name('favor.store');

//筆記留言
Route::post('/comments',[CommentController::class,'store'])->name('comments.store');

//筆記評分
Route::post('score',[NoteScoreController::class,'store'])->name('score.store');

#教授
    Route::prefix('teacher')->group(function (){

    //首頁
        Route::get('',[
            TeacherController::class,'index'
        ])  -> name('teacher.index');

    //課程
        Route::get('{course_id}/index',[
            TeacherController::class,'course'
        ])  ->name('teacher.course');

    //修課學生
        Route::get('{course_id}/students/',[
            TeacherController::class,'student'
        ])->name('teacher.student');
    });

#TA
    Route::prefix('TA')-> group(function (){

        //index
        Route::get('index',[
            TaController::class,'index'
        ])-> name('TA.index');

        //create
        Route::get('{course_id}/create',[
            TaController::class,'create'
        ]) -> name('TA.create');
    });

#公告
    Route::prefix('notice') ->group(function (){
    //新增公告
        Route::get('{course_id}/create',[
            NoticeController::class,'create'
        ]) -> name('notice.create');

    //儲存公告
        Route::post('{course_id}/store',[
            NoticeController::class,'store'
        ]) -> name('notice.store');

    //顯示所有公告
        Route::match(['get','post'],'{course_id}',[
            NoticeController::class,'index'
        ]) -> name('notice.index');

        //檢視公告
        Route::get('{course_id}/{notice_id}',[
            NoticeController::class,'show'
        ])-> name('notice.show');

        //編輯公告
        Route::get('{course_id}/{notice_id}/edit',[
            NoticeController::class,'edit'
        ])->name('notice.edit');

        //刪除公告
        Route::delete('{course_id}/{notice_id}',[
            NoticeController::class,'destroy'
        ]) -> name('notice.delete');

        //更新公告
        Route::patch('{course_id}/{notice_id}',[
            NoticeController::class,'update'
        ])-> name('notice.update');

    });


//    --------------------------------------------
    Route::get('test',function (){
        return 1;
    }) ->name('test');

    Route::get('users/import',function()
    {   $user=new User();
        $user->account="sean";
        $user->name="seanpu";
        $user->password=\Illuminate\Support\Facades\Hash::make("1234");
        $user->type="學生";
        $user->save();
    });




