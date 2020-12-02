<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * Front Pages Routes
 */
Route::get('/Research', 'ResearchController@index')->name('research');
Route::get('/About', 'ResearchController@about')->name('about');
Route::get('/Alumni', 'AlumniController@index')->name('alumni');
Route::get('/Contact', 'AlumniController@index')->name('contact');
Route::get('/undergraduate', 'undergraduateController@index')->name('undergraduate');
Route::get('/postgraduate', 'postgraduateController@index')->name('postgraduate');
Route::get('/amasscos', 'undergraduateController@amasscos')->name('amasscos');
Route::get('/events', 'alumniController@index')->name('events');
Route::get('/news', 'alumniController@news')->name('news');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/activate/{code}','ActivationController@activation')->name('user.activation');
Route::get('/resend/code','ActivationController@coderesend')->name('code.resend');

/**
 * Authenticated pages
 */
Route::group(['middleware' => 'auth'], function () {

    Route::get('/admin', 'AdminController@index')->name('admin.index');
    Route::get('/admin/users', 'AdminUsersController@index')->name('admin.users');
    Route::post('/store','AdminUsersController@store')->name('store');
    Route::get('admin/users/create','AdminUsersController@create')->name('users.create');
    Route::delete('admin/users/{user}','AdminUsersController@destroy')->name('destroy');
    Route::get('/admin/users/{profile}', 'AdminUsersController@show')->name('admin.users.profile');
    Route::post('/upload','AdminUsersController@upload')->name('upload');
    Route::get('/admin/users/{user}/editprofile','AdminUsersController@edit')->name('admin.users.editprofile');
    Route::PATCH('/admin/users/{user}','AdminUsersController@update')->name('users.update ');
    Route::PATCH('/admin/courses/{courses}','AdminUsersController@updateCourses')->name('admin.courses.updateCourses ');
    Route::get('/admin/courses','AdminUsersController@courses')->name('admin.courses');
    Route::get('users/course','AdminUsersController@course')->name('users.course');
    Route::post('/storeCourse','AdminUsersController@storeCourse')->name('storeCourse');
    Route::get('/admin/users/{course}/editcourses','AdminUsersController@editcourses')->name('admin.users.editcourses');
    /**
     *  Students controller
     */
    Route::GET('enrollment/create','StudentController@create')->name('enrollment.create');
    Route::get('/admin/students/', 'StudentController@index')->name('admin.students');
    Route::PATCH('/course/{course}','StudentController@update')->name('register.update');
    Route::POST('enrollment','StudentController@store')->name('enrollment.store');
    Route::get('/students/blackboard','StudentController@blackboard')->name('students.blackboard');
    Route::get('/students/results','StudentController@myresults')->name('results');
    Route::get('/students/project','StudentController@myproject')->name('project');
    /**
     *  lecturers controller
     */
    Route::get('/lecturer/blackboard', 'LecturerController@blackboard')->name('blackboard.index  ');
    Route::POST('/lecturer', 'LecturerController@store')->name(' lecturer.store');
    Route::get('/lecturer/results', 'LecturerController@results')->name('admin.lecturer.results');
    Route::get('/lecturer/assigned_courses', 'LecturerController@assignedcourses')->name('lecturer.assigned_courses');
    Route::patch('/lecturer/{lecturer}','LecturerController@update')->name('lecturer.update');
    Route::patch('/lecturer/blackboard/{lecturer}','LecturerController@updateNotes')->name('lecturer.updateNotes');
    Route::delete('/lecturer/lecturer/{lecturer}','LecturerController@deleteNotes')->name('lecturer.deleteNotes');

//        Route::resource('lecturer','LecturerController');

});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

//Route::get('admin/users/course', function () {
//    return view('course');
//});
