<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\message;
use App\Models\Student;
use App\Models\Ta;
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
        return view('ta/index',[
            //現在使用者的所有課堂
            'courses' => User::find(Auth::id()) -> teacher()
                -> first() -> courses() -> get()
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

    public function message($student_id){

        $messages = Student::find($student_id) -> messages() -> get();

        return view('ta.message',[
            'messages' => $messages,
            'user' => Auth::user(),
        ]);
    }

    public function message_store(Request $request,$student_id){

//        判斷訊息是否為空值
        if ($request -> message != null){
            $message = new message();

            $message -> teacher_id = User::find(Auth::id()) -> teacher() -> first() -> id;
            $message -> student_id = $student_id;
            $message -> content = $request -> message;

            $message -> save();
        }

        return back();
    }
}
