<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Course;
use App\Enrollment;
use App\Lecturer;
use App\User;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of the students course based on level.
     *
     * @return Factory|View
     */
    public function index()
    {
        $users = User::all();
        $courses = auth()->user()->courses;
        $registerCourses = DB::table('courses')->orderByDesc('Level_id')->get();
        /* loading enrollment to manipulate the button in the view  */
        $enrolled = DB::table('enrollments')->select(['user_id', 'enrolled', 'level_id', 'semesters', DB::raw('count(user_id) As enrollment_count')])
            ->groupBy('user_id', 'enrolled', 'level_id', 'semesters')->orderBy('enrollment_count', 'desc')->get();
        /* creating a variable and then a loop to see if a user already has an enrollment for the year and assigns it to the variable  */
        $registered = [];
        foreach ($enrolled as $enroll) {
            if (auth()->user()->id === $enroll->user_id && auth()->user()->level_id === $enroll->level_id && auth()->user()->semesters === $enroll->semesters) {
                $registered = $enroll->enrolled;
            }
        }
        return view('admin.students.index', compact('users', 'courses', 'registered', 'registerCourses'));
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeElective(Request $request): RedirectResponse
    {

        $request->validate([
            'course_id' => 'required'
        ]);

        $courses_ids = $request->get('course_id');
        foreach ($courses_ids as $courses_id) {
            $course = Course::find($courses_id);
            $enrollment = new Enrollment();
            $enrollment->course_id = $course->id;
            $enrollment->user_id = auth()->user()->id;
            $enrollment->level_id = $course->level_id;
            $enrollment->semesters = $course->semesters;
            $enrollment->enrolled = 1;
            $enrollment->year = date("Y-m-d");
            $enrollment->save();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|Response|View
     */
    public function show(int $id)
    {
        /* loading the notes for the logged in user  */
        $notes = Lecturer::findorFail($id);
        return view(' admin.students.note ', compact('notes'));
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
     * Update the specified resource in storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function update(User $user): RedirectResponse
    {

        $user->update(['enrolled' => request()->has('enrolled')]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Loads the assignments for the students.
     *
     * @param
     * @return Application|Factory|Response|View
     */
    public function blackboard()
    {
        /* loading the notes for the students blackboard  */
        $notes = DB::table('lecturers')
            ->join('courses', 'lecturers.course_code', '=', 'courses.course_code')
            ->select('lecturers.*', 'lecturers.title', 'lecturers.description', 'lecturers.dead_line')->paginate(8);

        return view('admin.students.blackboard', compact('notes'));
    }

    /**
     * @param $createdAt
     * @param $dead_line
     * @return bool
     * @throws Exception
     */
    public static function deadLineDate($createdAt, $dead_line): bool
    {
        $date = new DateTime($createdAt); // when you create this lecturer
        $date->modify("+$dead_line"); // we put the deadline 2 days
        return new DateTime() > $date;
    }

    /**
     * @throws Exception
     */
    public static function numberOfDays($createdAt, $dead_line)
    {
        $date = new DateTime($createdAt);
        $currentTime = Carbon::now();
        $deadLine = new DateTime($dead_line);
        $interval = $currentTime->diff($deadLine);
        return $interval->format('%a');
    }

    /**
     * Dashboard query for students results .
     *
     * @param
     * @return Application|Factory|View
     */
    public function myresults()
    {
        /* checking the logged in user role  */
        if (auth()->user()->role_id !== 3) {
            abort(403);
        }
        $users = User::all();
        /* returning the logged in user results in the view  */
        $results = DB::table('enrollments')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->join('users', 'enrollments.user_id', '=', 'users.id')
            ->join('levels', 'enrollments.level_id', '=', 'levels.id')
            ->select('enrollments.*', 'enrollments.user_id', 'courses.credit_unit',
                'courses.course_code', 'enrollments.course_id', 'enrollments.id', 'enrollments.enrolled'
                , 'users.name', 'courses.course_name', 'courses.user_id')->get();

        /* returning the maximum scores obtained in the exams per user  */
        $maxCounts = DB::table('enrollments')->select(['user_id', DB::raw('max(grades) As enrollment_count')])
            ->groupBy('user_id')->orderBy('enrollment_count', 'desc')->get();

        /* returning all the results per user which will be then manipulated to get the average score of the student  */
        $avgCounts = DB::table('enrollments')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->join('users', 'enrollments.user_id', '=', 'users.id')
            ->join('levels', 'enrollments.level_id', '=', 'levels.id')
            ->select('enrollments.*', 'enrollments.course_id', 'enrollments.id', 'enrollments.grades', 'users.id', 'courses.course_name', 'courses.user_id')
            ->get();

        /* returning the number of subjects passed  */
        $passCounts = DB::table('enrollments')->select(['user_id', 'grades', 'id', DB::raw('count(id ) AS enrollment_grades')])
            ->where('grades', '>=', 47)
            ->groupBy('user_id', 'grades', 'id')->orderBy('id', 'desc')->get();

        /* returning the number of subjects failed  */
        $failCounts = DB::table('enrollments')->select(['user_id', 'grades', 'id', DB::raw('count(id ) AS enrollment_grades')])
            ->where('grades', '<=', 46)
            ->groupBy('user_id', 'grades', 'id')->orderBy('id', 'desc')->get();

        /* returning the number of subjects enrolled  */
        $counts = DB::table('enrollments')->select(['user_id', DB::raw('count(user_id) As enrollment_count')])
            ->groupBy('user_id')->orderBy('enrollment_count', 'desc')->get();


        return view('admin.students.results', compact('results', 'failCounts', 'passCounts', 'maxCounts', 'avgCounts', 'counts', 'users'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param
     * @return Application|Factory|View
     */
    public function myproject()
    {
        return view('admin.students.project');
    }

    /**
     * upload completed assignment to the lectures and also sends a copy as email
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function uploadAssignment(Request $request): RedirectResponse
    {

        if (!auth()->user()->role_id) {
            abort(403);
        }


        if ($request->hasFile('pdf')) {
            $filename = time() . '.' . $request->pdf->getClientOriginalName();
            $request->pdf->storeAs('pdfs', $filename, 'public');
            auth()->user()->update(['file_name' => $filename]);
        }

    /**
     * need to work on the loop here so as ro get the exact course  the user is viewing *
     */
    $course = DB::table('lecturers')->where('course_code', $request->course_code)->first();

                $assignment = new Assignment();
                $assignment->lecturer_id = $course->author_id;
                $assignment->course_name = $course->title;
                $assignment->course_code = $course->course_code;
                $assignment->file_name = $filename;
                $assignment->level_id = auth()->user()->level_id;
                $assignment->user_id = auth()->user()->id;
                $assignment->save();


        Session::flash('message','Your assignment '.$filename.' was  successful created');

        return back();
    }

    /**
     *
     */
    public function uploadProject()
    {

    }
}
