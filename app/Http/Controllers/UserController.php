<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        if(Auth::check()) {

            switch (Auth::user()->type) {
                case '學生':
                    return redirect('students');
                    break;

                case '老師':
                    return redirect('/teacher');
                    break;

            }
        }
        return view('auth/login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect()->route('home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }

    public function import(Admin $admin)
    {
        $s_department[0] ="資管系";
        $s_department[1] ="流管系";
        for ($i = 0 ; $i < 2 ; $i ++){
            $deparment = new \App\Models\Department();

            $deparment -> name= $s_department[$i];
            $deparment->save();
        }

        for ($i = 0 ; $i < 10 ; $i ++){
            $user=new User();
            $user->account="student" . $i;
            $user->name="student_name" . $i;
            $user->password=\Illuminate\Support\Facades\Hash::make("1234");
            $user->type="學生";
            $user->save();

            $student = new Student();
            $student -> user_id = $user -> id;
            $student -> department_id = 2 ;
            $student -> classroom = '503';
            $student -> save();
        }


        for ($i = 0 ; $i < 10 ; $i ++){
            //建立user
            $user=new User();
            $user->account="teacher" . $i;
            $user->name="teacher_name" . $i;
            $user->password=\Illuminate\Support\Facades\Hash::make("1234");
            $user->type="老師";
            $user->save();

            //建立teacher
            $teacher =new \App\Models\Teacher();
            $teacher -> user_id = $user -> id ;
            $teacher -> department_id = 2 ;
            $teacher -> save();
        }

        for ($i = 0 ; $i < 10 ; $i ++){
            //建立course

            $course =new \App\Models\Course();

            $course -> teacher_id = 1;
            $course -> department_id = 2;
            $course -> name = 'course'. $i;
            $course -> grade = 2 ;
            $course -> classroom = 503;
            $course -> year = 110 ;
            $course -> semester = 1;
            $course -> save();

        }

        return back();
    }
}
