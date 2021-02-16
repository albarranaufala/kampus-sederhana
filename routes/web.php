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
    Route::resource('admins', 'AdminController', ['except' => [
        'create', 'show', 'edit'
    ]]);
    Route::resource('lectures', 'LectureController', ['except' => [
        'create', 'show', 'edit'
    ]]);
    Route::resource('students', 'StudentController', ['except' => [
        'create', 'show', 'edit'
    ]]);
    Route::resource('courses', 'CourseController', ['except' => [
        'create', 'show', 'edit'
    ]]);
    Route::resource('periodes', 'PeriodeController', ['except' => [
        'create', 'show', 'edit'
    ]]);
});
Route::namespace('Student')->prefix('student')->name('student.')->middleware('role:student')->group(function () {
    Route::resource('studies', 'StudyController', ['only' => [
        'index', 'store', 'destroy'
    ]]);
});
Route::namespace('Lecture')->prefix('lecture')->name('lecture.')->middleware('role:lecture')->group(function () {
    Route::resource('courses', 'CourseController', ['only' => [
        'index', 'show'
    ]]);
    Route::post('studies/{study}/grade', 'StudyController@grade')->name('studies.grade');
});