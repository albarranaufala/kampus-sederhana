<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LectureStoreRequest;
use App\Http\Requests\LectureUpdateRequest;
use App\User;

class LectureController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $lectures = User::where('role', 'lecture')->get();
        return view('admin.civitas.lectures.index', compact('lectures'));
    }

    public function store(LectureStoreRequest $request)
    {
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'role' => 'lecture',
            'password' => bcrypt($request->password)
        ]);

        return redirect()->back()->with('status', 'Add lecture success!');
    }

    public function update(LectureUpdateRequest $request, $id)
    {
        User::find($id)->update([
            'name' => $request->name,
            'username' => $request->username
        ]);

        return redirect()->back()->with('status', 'Update lecture success!');
    }

    public function destroy($id)
    {
        $lecture = User::find($id);
        $lecture->delete();
        return redirect()->back()->with('status', 'Delete lecture success!');
    }
}
