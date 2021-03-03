<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\message;
use App\Models\Student;
use App\Models\Ta;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        if(Auth::user() -> type == "老師"){
            //抓取該老師所有的課程
            $courses = User::find(Auth::id()) -> teacher()
                -> first() -> courses() -> get();
            }else{
            //只抓取該學生有TA的課堂
            $courses = User::find(Auth::id()) -> student()
                -> first() -> tas() -> get();
        }

//        return $courses;

        return view('ta/index',[
            'courses' => $courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
//        顯示所有的該系所的學生
        $students = Course::find($id) -> department() -> first()-> students() -> get();

//      return $students  ;

        return view ('TA.create',[
            'students' => $students,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$course_id,$student_id)
    {
        $TA = new Ta();

        $TA -> course_id = $course_id;
        $TA -> student_id = $student_id;
        $TA -> save();

        return redirect() -> route('TA.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ta  $ta
     * @return \Illuminate\Http\Response
     */
    public function show(Ta $ta,$course_id,$id)
    {
        $student = Student::find($id);

        return view ('TA.show',[
            'student' => $student
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ta  $ta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ta  $ta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ta $ta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ta  $ta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ta $ta)
    {
        //
    }


//    ---------own create --------------//

    public function message($type_id){

        //判斷使用者
        if(Auth::user() -> type == "老師"){
            $messages = Student::find($type_id) -> messages() -> get();
        }else{
            $messages = Teacher::find($type_id) -> messages() -> get();
        }



        return view('ta.message',[
            'messages' => $messages,
            'user' => Auth::user(),
        ]);
    }

    public function message_store(Request $request,$type_id){

//        判斷訊息是否為空值
        if ($request -> message != null){
            $message = new message();

            if(Auth::user() -> type == "老師"){
                $message -> teacher_id = User::find(Auth::id()) -> teacher() -> first() -> id;
                $message -> student_id = $type_id;
                $message -> content = $request -> message;
                $message -> sender = "老師";
            }else{
                $message -> teacher_id = $type_id;
                $message -> student_id = User::find(Auth::id()) -> student() -> first() -> id;
                $message -> content = $request -> message;
                $message -> sender = "老師";
            }
        }
        $message -> save();
        return back();
    }
}
