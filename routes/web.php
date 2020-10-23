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
    Route::get('/admin/students/', 'StudentController@index')->name('admin.students');
    Route::get('/admin/courses','AdminUsersController@courses')->name('admin.courses');
    Route::get('users/course','AdminUsersController@course')->name('users.course');
    Route::post('/storeCourse','AdminUsersController@storeCourse')->name('storeCourse');
    Route::PATCH('/course/{course}','StudentController@update')->name('register.update');
    Route::get('/admin/users/{course}/editcourses','AdminUsersController@editcourses')->name('admin.users.editcourses');
    Route::GET('enrollment/create','StudentController@create')->name('enrollment.create');
    Route::POST('enrollment','StudentController@store')->name('enrollment.store');
    Route::resource('lecturer','LecturerController');
    Route::get('/results', 'LecturerController@results')->name('admin.lecturer.results');

});


//Route::get('admin/users/course', function () {
//    return view('course');
//});
