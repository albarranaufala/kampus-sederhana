<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
    Route::resource('admins', 'AdminController');
    Route::resource('lectures', 'LectureController');
    Route::resource('students', 'StudentController');
    Route::resource('courses', 'CourseController');
    Route::resource('periodes', 'PeriodeController');
});
Route::namespace('Student')->prefix('student')->name('student.')->middleware('role:student')->group(function () {
    Route::resource('studies', 'StudyController');
});
Route::namespace('Lecture')->prefix('lecture')->name('lecture.')->middleware('role:lecture')->group(function () {
    Route::resource('courses', 'CourseController');
    Route::post('studies/{study}/grade', 'StudyController@grade')->name('studies.grade');
});