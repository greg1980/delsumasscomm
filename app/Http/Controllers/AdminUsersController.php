<?php

namespace App\Http\Controllers;

use App\Course;
use App\Enrollment;
use App\Level;
use App\Mail\CourseCreated;
use App\User;
use App\Role;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        if (auth()->user()->role_id !== 1){
            abort(403);
        }
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if (auth()->user()->role_id !== 1){
            abort(403);
        }
        $roles = Role::pluck('name','id');
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (auth()->user()->role_id !== 1){
            abort(403);
        }

    $user =    User::create(request()->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'is_active'=>'required',
            'role_id'=> 'required',

        ]));
        Session::flash('message','The user  '.$user['name'].' was  successful created');
        return redirect('admin/users');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function upload(Request $request)
    {
        if (!auth()->user()->role_id ){
            abort(403);
        }

        if($request->hasFile('image')){
            $filename =  $request->image->getClientOriginalName();
            $request->image->storeAs('images', $filename, 'public');
            auth()->user()->update(['avatar'=> $filename]);
        }
        return back();
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id, User $user)
    {
        $user = User::findOrFail($id);
        $name = $user->name;
        $userdetails = 'xxxxx' . substr($name, 4);
        return view('admin.users.profile', compact('user','userdetails'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        if (auth()->id() !== $user->id){
            abort(403);
        }
        $levels = Level::pluck('name','id');
        return view('admin.users.editprofile',compact('user','levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(User $user)
    {
        if (auth()->id() !== $user->id){
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
                'address' => 'required',
                'city' => 'required',
            ]));
        }else{
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
        Session::flash('message','Hey  '.$user['name'].' your profile was  successful updated');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        if (auth()->id() === $user->id){
            abort(403);
        }
        $user->delete();
        Session::flash('message', 'The user name '. $user->name.' was deleted successful');
        return back();
    }


    /**
     * Show list of course assignee to admin.
     *
     * @param
     * @param
     * @return
     */
    public function course() {

        if (auth()->user()->role_id !== 1){
            abort(403);
        }
        $levels = Level::all();
        $users = DB::select('select * from users where role_id = 2', [2]);
        return view('admin.users.course',compact('levels','users'));

     }

    /**
     * Show list of created users course for admin.
     *
     * @param
     * @param
     * @return
     */
    public function courses() {

        if (auth()->user()->role_id !== 1){
            abort(403);
        }
        $courses = DB::table('courses')->orderByDesc('Level_id')->get();
        $users = User::all();
        return view('admin.users.courses',compact('users','courses'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCourse(Request $request, User $user)
    {
        if (auth()->user()->role_id !== 1){
            abort(403);
        }
        $users = User::all();

        $course =    Course::create(request()->validate([
            'course_name'=>'required',
            'level_id'=>'required',
            'course_code'=>'required',
            'credit_unit'=>'required',
            'user_id'=> 'required',
            'semesters'=> 'required'
        ])

        );

        foreach ($users as $user){
            foreach ($user->courses as $course){
                if($course->email_sent !== 1){
                Mail::to($user->email)->queue(new CourseCreated($course, $user));
                $course->email_sent = 1;
                $course->save();
                }
            }
        }

        Session::flash('message','The course was  successful created');
        return back();
    }
    public function editcourses($id){

        if(auth()->user()->role_id !== 1){
            abort(403);
        }
        $courses = Course::findOrFail($id);
        $levels = Level::pluck('name','id');
        $users = DB::select('select * from users where role_id = 2', [2]);
        return view('admin.users.editcourses', compact('courses','users','levels'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Course $courses
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updatecourses(Course $courses, User $user)
    {
        if (auth()->user()->role_id !== 1){
            abort(403);
        }

        $courses->update(request()->validate([
            'course_name'=>'required',
            'level_id'=>'required',
            'course_code'=>'required',
            'semesters'=>'required',
            'credit_unit'=>'required',
            'user_id'=>'required'
        ]));

        Session::flash('message','Hey '.$courses['course_code'].' was  successful updated');

        return back();
    }


}
