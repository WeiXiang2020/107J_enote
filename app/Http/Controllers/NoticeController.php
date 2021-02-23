<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Notice;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$course_id)
    {
        //!!!!!!!!缺身分驗證，確定使用者登入

        if (Auth::user()->type == '老師'){
            $courses = User::find(Auth::id())
                -> teacher() -> first()
                -> courses() -> get();
        }

        $selected = Course::find($course_id);

        $notices = Course::find($course_id)->notices()->get();

        return view ('notices.index',[
            'selected' => $selected ,
            'courses' => $courses ,
            'notices' => $notices

        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($course_id)
    {
        $course = Course::where(
            'id' , $course_id
        )->get()->first();

        return view('notices.create', [
            'course' => $course,
            'course_id' => $course_id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$course_id)
    {
        if($request -> title != '' &&
            $request -> notice_content != ''
        ) {
            $user = Auth::user();

            $notice = new Notice();
            if ($user->type == '老師') {
                $notice->teacher_id = Teacher::where(
                    'user_id', $user->id
                )->get()->first()->id;
            } else {
                $notice->ta_id = $user->id;
            }

            $notice->course_id = $course_id;
            $notice->title = $request->title;
            $notice->content = $request->notice_content;

            $notice->save();
        }

        if ($request -> sub == 'finish'){
            return redirect() -> route('notice.index',$course_id);
        }
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function show($id,$notice_id)
    {
        $notice=Notice::find($notice_id);

        return view('notices.show',['notice'=>$notice]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function edit(Notice $notice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notice $notice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice,$notice_id)
    {
        Notice::find($notice_id)->delete();

        return back();
    }
}
