<?php

namespace App\Http\Controllers\Student;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudyStoreRequest;
use App\Periode;
use App\Study;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $periodes = Periode::all();
        if ($request->periode_id) {
            $currentPeriode = Periode::find($request->periode_id);
        } else {
            $currentPeriode = $periodes->sortByDesc('created_at')->first();
        }
        $user = Auth::user();
        $studies = $user->studies->where('periode_id', $currentPeriode->id);
        $courses = Course::all();

        return view('student.studies.index', compact('periodes', 'studies', 'currentPeriode', 'courses'));
    }

    public function store(StudyStoreRequest $request)
    {
        $periode = Periode::find($request->periode);
        if ($this->isExpired($periode)) {
            return redirect()->back()->withErrors([
                'You has exceeded the deadline!'
            ]);
        }
        $study = Study::create([
            'periode_id' => $request->periode,
            'course_id' => $request->course,
            'user_id' => Auth::id()
        ]);
        if ($study->id) {
            return redirect()->back()->with('status', 'Add study success!');
        }
        return redirect()->back()->withErrors([
            'Your credit is not enough!'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $periode = Periode::find($request->periode);
        if ($this->isExpired($periode)) {
            return redirect()->back()->withErrors([
                'You has exceeded the deadline!'
            ]);
        }
        $study = Study::find($id);
        $study->delete();
        return redirect()->back()->with('status', 'Delete study success!');
    }

    private function isExpired ($periode) {
        return !Carbon::now()->between(Carbon::parse($periode->register_start), Carbon::parse($periode->register_end.' 23:59:59'));
    }
}
