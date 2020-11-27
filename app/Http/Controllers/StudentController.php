<?php

namespace App\Http\Controllers;

use App\Course;
use App\Enrollment;
use App\Level;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the students course based on level.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        $courses = auth()->user()->courses;
        $enrollment = auth()->user()->enrollment;
        return view('admin.students.index', compact('users', 'courses','enrollment'));
    }

    /**
     * Stores students courses based on current level in the enrollment table .
     *
     * @param Course $course
     * @param Enrollment $enrollment
     * @param User $user
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $courses = Course::all();
          foreach($courses  as $course) {
              if (auth()->user()->level_id === $course->level_id) {
                      $enrollment = new Enrollment();
                      $enrollment->course_id = $course->id;
                      $enrollment->user_id = auth()->user()->id;
                      $enrollment->level_id = $course->level_id;
                      $enrollment->semesters = $course->semesters;
                      $enrollment->enrolled = 1;
                      $enrollment->year = date("Y-m-d");
                      $enrollment->save();
                  }
              }

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
     * Update the specified resource in storage.
     *
     * @param User $user
     * @param Enrollment $enrollment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $user,Enrollment $enrollment)
    {

        $user->update(['enrolled'=> request()->has('enrolled')]);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function blackboard()
    {
        return view('admin.students.blackboard');
    }

    /**
     * Dashboard query for students results .
     *
     * @param
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function myresults()
    {
        if (auth()->user()->role_id !== 3){
            abort(403);
        }
        $users = User::all();
        $results = DB::table('enrollments')
            ->join('courses','enrollments.course_id','=','courses.id')
            ->join('users','enrollments.user_id','=','users.id')
            ->join('levels','enrollments.level_id','=','levels.id')
            ->select('enrollments.*','enrollments.user_id','courses.credit_unit',
                'courses.course_code','enrollments.course_id','enrollments.id','enrollments.enrolled'
                ,'users.name','courses.course_name','courses.user_id')->get();


        $maxCounts = DB::table('enrollments')->select(['user_id', DB::raw('max(grades) As enrollment_count')])
            ->groupBy('user_id')->orderBy('enrollment_count','desc')->get();

        $avgCount = DB::table('enrollments')
            ->join('courses','enrollments.course_id','=','courses.id')
            ->join('users','enrollments.user_id','=','users.id')
            ->join('levels','enrollments.level_id','=','levels.id')
            ->select('enrollments.*','enrollments.course_id','enrollments.id','enrollments.grades','user.name','courses.course_name','courses.user_id')
            ->avg('grades');

        $passCounts = DB::table('enrollments')->select(['user_id','grades','id', DB::raw('count(id ) AS enrollment_grades')])
            ->where('grades', '>=', 47)
            ->groupBy('user_id','grades','id')->orderBy('id', 'desc')->get();

         $failCounts = DB::table('enrollments')->select(['user_id','grades','id', DB::raw('count(id ) AS enrollment_grades')])
             ->where('grades', '<=', 46)
             ->groupBy('user_id','grades','id')->orderBy('id', 'desc')->get();

           $counts = DB::table('enrollments')->select(['user_id', DB::raw('count(user_id) As enrollment_count')])
            ->groupBy('user_id')->orderBy('enrollment_count','desc')->get();

        return view('admin.students.results', compact('results','failCounts','passCounts','maxCounts','avgCount','counts','users'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function myproject()
    {
        return view('admin.students.project');
    }
}
