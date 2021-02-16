<?php

namespace App\Http\Controllers\Lecture;

use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = Auth::user();
        $courses = $user->courses;

        return view('lecture.courses.index', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::find($id);

        return view('lecture.courses.show', compact('course'));
    }
}
