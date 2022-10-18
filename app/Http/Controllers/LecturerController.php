<?php

namespace App\Http\Controllers;

use App\Course;
use App\Enrollment;
use App\Lecturer;
use App\Level;
use App\Mail\ResultModified;
use App\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LecturerController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function results()
    {
        if (auth()->user()->role_id !== 2) {
            abort(403);
        }
        $results = DB::table('enrollments')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->join('users', 'enrollments.user_id', '=', 'users.id')
            ->join('levels', 'enrollments.level_id', '=', 'levels.id')
            ->select('enrollments.*', 'enrollments.user_id', 'courses.credit_unit',
                'courses.course_code', 'enrollments.course_id', 'enrollments.id', 'enrollments.enrolled'
                , 'users.name', 'courses.course_name', 'courses.user_id')->get();

        /* returning the maximum scores obtained in the exams per user  */

        $maxCounts = DB::table('enrollments')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->join('users', 'enrollments.user_id', '=', 'users.id')
            ->select('enrollments.*', 'enrollments.user_id', 'enrollments.course_id','users.name', 'courses.course_name', 'courses.user_id')
            ->where([['courses.user_id','=',auth()->user()->id]])->max('grades');


        /* returning all the results per user which will then be manipulated to get the average score of the student  */
        $avgCounts = DB::table('enrollments')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->join('users', 'enrollments.user_id', '=', 'users.id')
            ->select('enrollments.*', 'enrollments.user_id', 'enrollments.course_id','users.name', 'courses.course_name', 'courses.user_id')
            ->where([['courses.user_id','=',auth()->user()->id]])->sum('grades');


        /* returning the number of subjects passed  */
        $passCounts = DB::table('enrollments')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->select(['courses.id', 'grades', 'courses.user_id', DB::raw('count(courses.id ) AS enrollment_grades')])
            ->where('grades', '>=', 47)
            ->groupBy('user_id', 'grades', 'id', 'courses.user_id')->get();

        /* returning the number of subjects failed  */
        $failCounts = DB::table('enrollments')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->select(['courses.id', 'grades', 'courses.user_id', DB::raw('count(courses.id ) AS enrollment_grades')])
            ->where('grades', '<=', 46)
            ->groupBy('user_id', 'grades', 'id')->orderBy('id', 'desc')->get();

        /* returning the number of subjects enrolled  */
        $counts = DB::table('enrollments')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->join('users', 'enrollments.user_id', '=', 'users.id')
            ->select('enrollments.*', 'enrollments.user_id', 'enrollments.course_id','users.name', 'courses.course_name', 'courses.user_id')
            ->where([['courses.user_id','=',auth()->user()->id]])->count('enrollments.user_id');


        return view('admin.lecturer.results', compact('results', 'maxCounts', 'avgCounts', 'passCounts', 'failCounts', 'counts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Course $course
     * @return Application|Factory|Response|View
     */
    public function assignedcourses(Course $course)
    {
        //
        $courses = auth()->user()->course;
        return view('admin.lecturer.assigned_courses', compact('courses'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the students results storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        if (auth()->user()->role_id !== 2) {
            abort(403);
        }

        $results = Enrollment::findOrFail($request->result_id);
        $oldresult = $results->grades;
        if ($oldresult <= 0) {
            $oldresult = '';
        }

        $results->update($request->all());
        Session::flash('message', ' The grade  was  successful updated from ' . ' ' . $oldresult . '%' . ' ' . 'to' . ' ' . $results['grades'] . '%');
        Mail::to(auth()->user()->email)->send(new ResultModified($results));

        return back();
    }

    /**
     * Display a listing of the note resource.
     *
     * @return Application|Factory|Response|View
     */
    public function blackboard(Lecturer $lecturer)
    {
        if (auth()->user()->role_id !== 2) {
            abort(403);
        }
        $courses = auth()->user()->course_code;
        $lecturers = DB::table('lecturers')
            ->join('courses', 'lecturers.course_code', '=', 'courses.course_code')
            ->select('lecturers.*', 'courses.user_id')->get();
        $levels = Level::all();
        return view(' admin.lecturer.blackboard ', compact('courses', 'levels', 'lecturers'));
    }

    /**
     * Store a newly created students notes/assignment.
     *
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        //
        if (auth()->user()->role_id !== 2) {
            abort(403);
        }

        $message = Lecturer::create(request()->validate([
            'title' => 'required',
            'description' => 'required',
            'level_id' => 'required',
            'course_code' => 'required',
            'dead_line' => 'required'
        ]));
        Session::flash('message', 'The Student notes for ' . $message['title'] . ' was  successful created');
        return back();
    }

    /**
     * Update the students results storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateNotes(Request $request): RedirectResponse
    {
        if (auth()->user()->role_id !== 2) {
            abort(403);
        }
        $messages = Lecturer::findorFail($request->lecturer_id);

        $messages->update($request->all());
        Session::flash('message', ' Your notes was successful updated ');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Lecturer $lecturer
     * @return RedirectResponse
     * @throws Exception
     */
    public function deleteNotes(Lecturer $lecturer): RedirectResponse
    {
        //
        if (auth()->user()->role_id !== 2) {
            abort(403);
        }

        $lecturer->delete();
        Session::flash('message', 'Your notes for ' . $lecturer->course_code . ' was deleted successful');
        return back();
    }
}
