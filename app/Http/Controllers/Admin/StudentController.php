<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\User;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $students = User::where('role', 'student')->get();
        return view('admin.civitas.students.index', compact('students'));
    }

    public function store(StudentStoreRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'role' => 'student',
            'password' => bcrypt($request->password)
        ]);
        $user->credit()->create([
            'credit' => $request->credit
        ]);

        return redirect()->back()->with('status', 'Add student success!');
    }

    public function update(StudentUpdateRequest $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'username' => $request->username
        ]);
        $user->credit()->update([
            'credit' => $request->credit
        ]);
        

        return redirect()->back()->with('status', 'Update student success!');
    }

    public function destroy($id)
    {
        $student = User::find($id);
        $student->delete();
        return redirect()->back()->with('status', 'Delete student success!');
    }
}
