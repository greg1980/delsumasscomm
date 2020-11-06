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
     * Display a listing of the resource.
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
     * Store a newly created resource in storage.
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
        //
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
     * Remove the specified resource from storage.
     *
     * @param
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function myresults()
    {
        return view('admin.students.results');
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
