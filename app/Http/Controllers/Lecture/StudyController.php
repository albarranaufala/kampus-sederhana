<?php

namespace App\Http\Controllers\Lecture;

use App\Http\Controllers\Controller;
use App\Http\Requests\GradeRequest;
use App\Study;
use Illuminate\Support\Facades\Auth;

class StudyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function grade(GradeRequest $request, $id) {
        $study = Study::find($id);

        $this->checkIsAuthorizedToGrade($study);

        $study->update([
            'grade' => $request->grade
        ]);

        return redirect()->back()->with('status', 'Grading success!');
    }

    private function checkIsAuthorizedToGrade ($study) {
        if ($study->course->user->id !== Auth::id()) {
            return abort(403, 'Unauthorized action.');
        }
    }
}
