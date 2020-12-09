<?php

namespace App\Http\Controllers;

use App\Course;
use App\Enrollment;
use App\Lecturer;
use App\Level;
use App\Mail\ResultModified;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function blackboard(Lecturer $lecturer)
    {
        if (auth()->user()->role_id !== 2){
            abort(403);
        }
        $courses = auth()->user()->course_code;
        $lecturers = DB::table('lecturers')
            ->join('courses','lecturers.course_code', '=','courses.course_code')
            ->select('lecturers.*','courses.user_id')->get();
        $levels = Level::all();
        return view(' admin.lecturer.blackboard ',compact('courses','levels','lecturers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function results(Enrollment $enrollment, Course $courses)
    {
        if (auth()->user()->role_id !== 2){
            abort(403);
        }
         $results = DB::table('enrollments')
             ->join('courses','enrollments.course_id','=','courses.id')
             ->join('users','enrollments.user_id','=','users.id')
             ->join('levels','enrollments.level_id','=','levels.id')
             ->select('enrollments.*','enrollments.user_id','courses.credit_unit',
                 'courses.course_code','enrollments.course_id','enrollments.id','enrollments.enrolled'
                 ,'users.name','courses.course_name','courses.user_id')->get();

        return view('admin.lecturer.results', compact('results'));
    }

/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function assignedcourses(Course $course)
    {
        //
        $courses = auth()->user()->course;
        return view('admin.lecturer.assigned_courses', compact('courses'));
    }


    /**
     * Store a newly created students notes/assignment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //
        if (auth()->user()->role_id !== 2){
            abort(403);
        }

        $message = Lecturer::create(request()->validate([
            'title'=>'required',
            'description'=>'required',
            'level_id'=>'required',
            'course_code'=>'required',
        ]));
        Session::flash('message','The Student notes for '.$message['title'].' was  successful created');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the students results storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        if (auth()->user()->role_id !== 2){
            abort(403);
        }

        $results = Enrollment::findOrFail($request->result_id);
        $oldresult = $results->grades;
        if ($oldresult <= 0){
            $oldresult = '';
        }

        $results->update($request->all());
        Session::flash('message',' The grade  was  successful updated from '.' ' .$oldresult.'%'.' '.'to' . ' '.$results['grades'].'%' );
        Mail::to(auth()->user()->email)->send(new ResultModified($results));

        return back();
    }

    /**
     * Update the students results storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateNotes(Request $request){
        if (auth()->user()->role_id !== 2){
            abort(403);
        }
        $messages = Lecturer::findorFail($request->lecturer_id);

        $messages->update($request->all());
        Session::flash('message',' Your notes was successful updated ' );
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteNotes(Lecturer $lecturer)
    {
        //
        if (auth()->user()->role_id !== 2){
            abort(403);
        }

        $lecturer->delete();
        Session::flash('message', 'Your notes for '. $lecturer->course_code.' was deleted successful');
        return back();
    }
}
