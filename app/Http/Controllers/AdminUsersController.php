<?php

namespace App\Http\Controllers;
use App\Course;
use App\Level;
use App\Mail\CourseCreated;
use App\User;
use App\Role;
use App\Photo;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {

        if (auth()->user()->role_id !== 1) {
            abort(403);
        }
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        if (auth()->user()->role_id !== 1) {
            abort(403);
        }
        $roles = Role::pluck('name', 'id');
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $user
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        if (auth()->user()->role_id !== 1) {
            abort(403);
        }

        $user = User::create(request()->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role_id' => 'required',

        ]));
        Session::flash('message', 'The user  ' . $user['name'] . ' was  successful created');
        return redirect('admin/users');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */

    public function upload(Request $request): RedirectResponse
    {
        if (!auth()->user()->role_id) {
            abort(403);
        }

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->getClientOriginalName();
            $request->image->storeAs('images', $filename, 'public');
            auth()->user()->update(['avatar' => $filename]);
        }
        return back();
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function show(int $id)
    {
        $user = User::findOrFail($id);
        $name = $user->name;
        $userdetails = 'xxxxx' . substr($name, 4);
        return view('admin.users.profile', compact('user', 'userdetails'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Factory|View
     */
    public function edit(User $user)
    {
        if (auth()->id() !== $user->id) {
            abort(403);
        }
        $levels = Level::pluck('name', 'id');
        return view('admin.users.editprofile', compact('user', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function update(User $user): RedirectResponse
    {
        if (auth()->id() !== $user->id) {
            abort(403);
        }
        if (auth()->user()->role->id === 3) {
            $user->update(request()->validate([
                'title' => 'required',
                'gender' => 'required',
                'dateofbirth' => 'required',
                'mobile' => ['required', 'size:11'],
                'housenumber' => 'required',
                'level_id' => 'required',
                'yearofadmission' => 'required',
                'yearofgrad' => 'required',
                'matnumber' => 'required',
                'semesters' => 'required',
                'address' => 'required',
                'city' => 'required',
            ]));
        } else {
            $user->update(request()->validate([
                'title' => 'required',
                'gender' => 'required',
                'dateofbirth' => 'required',
                'mobile' => ['required', 'size:11'],
                'housenumber' => 'required',
                'address' => 'required',
                'city' => 'required',
            ]));
        }
        Session::flash('message', 'Hey  ' . $user['name'] . ' your profile was  successful updated');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     * @throws Exception
     */
    public function deleteUser(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            abort(403);
        }
        $user->delete();
        Session::flash('message', 'The user name ' . $user->name . ' was deleted successful');
        return back();
    }


    /**
     * Show list of course assignee to admin.
     *
     * @return Application|Factory|View
     */
    public function course()
    {

        if (auth()->user()->role_id !== 1) {
            abort(403);
        }
        $levels = Level::all();
        $users = DB::select('select * from users where role_id = 2');
        return view('admin.users.course', compact('levels', 'users'));

    }

    /**
     * Show list of created users course for admin.
     *
     * @return Application|Factory|View
     */
    public function courses()
    {

        if (auth()->user()->role_id !== 1) {
            abort(403);
        }
        $courses = DB::table('courses')->orderByDesc('Level_id')->get();
        $users = User::all();
        return view('admin.users.courses', compact('users', 'courses'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse
     */
    public function storeCourse(): RedirectResponse
    {
        if (auth()->user()->role_id !== 1) {
            abort(403);
        }
        $users = User::all();

        $course = Course::create(request()->validate([
            'course_name' => 'required',
            'level_id' => 'required',
            'course_code' => 'required',
            'credit_unit' => 'required',
            'user_id' => 'required',
            'semesters' => 'required',
            'choices' => 'required'
        ])

        );

        foreach ($users as $user) {
            foreach ($user->courses as $course) {
                if ($course->email_sent !== 1) {
                    Mail::to($user->email)->send(new CourseCreated($course, $user));
                    //Notification::send($user, new NotesCreated($course, $user));
                    $course->email_sent = 1;
                    $course->save();
                }
            }
        }
        Session::flash('message', 'The course  ' . $course['course_name'] . ' was  successful created');
        return back();
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function editcourses($id)
    {

        if (auth()->user()->role_id !== 1) {
            abort(403);
        }
        $courses = Course::findOrFail($id);
        $levels = Level::pluck('name', 'id');
        $users = DB::select('select * from users where role_id = 2');
        return view('admin.users.editcourses', compact('courses', 'users', 'levels'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Course $courses
     * @return RedirectResponse
     */
    public function updatecourses(Course $courses): RedirectResponse
    {
        if (auth()->user()->role_id !== 1) {
            abort(403);
        }

        $courses->update(request()->validate([
            'course_name' => 'required',
            'level_id' => 'required',
            'course_code' => 'required',
            'semesters' => 'required',
            'credit_unit' => 'required',
            'user_id' => 'required',
            'choices' => 'required'
        ]));

        Session::flash('message', 'Hey ' . $courses['course_code'] . ' was  successful updated');

        return back();
    }


}
