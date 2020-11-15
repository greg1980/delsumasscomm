<?php

namespace App\Http\Controllers;

use App\Course;
use App\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view(' admin.lecturer.index ');
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
             ->select('enrollments.*','enrollments.user_id','courses.credit_unit','courses.course_code','enrollments.course_id','enrollments.id','enrollments.enrolled','users.name','courses.course_name','courses.user_id')->get();
        return view('admin.lecturer.results', compact('results'));
    }

/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function assignedcourses()
    {
        //
        return view('admin.lecturer.assigned_courses');
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
     * Update the specified resource in storage.
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

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
