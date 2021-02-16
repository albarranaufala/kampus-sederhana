<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\User;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $courses = Course::all();
        $lectures = User::where('role', 'lecture')->get();
        
        return view('admin.courses.index', compact('courses', 'lectures'));
    }

    public function store(CourseStoreRequest $request)
    {
        Course::create([
            'user_id' => $request->lecture,
            'name' => $request->name,
            'credit' => $request->credit,
        ]);

        return redirect()->back()->with('status', 'Add course success!');
    }

    public function update(CourseUpdateRequest $request, $id)
    {
        Course::find($id)->update([
            'user_id' => $request->lecture,
            'name' => $request->name,
            'credit' => $request->credit,
        ]);

        return redirect()->back()->with('status', 'Update course success!');
    }

    public function destroy($id)
    {
        Course::find($id)->delete();

        return redirect()->back()->with('status', 'Delete course success!');
    }
}
