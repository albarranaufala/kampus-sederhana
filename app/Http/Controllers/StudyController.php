<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\StudyStoreRequest;
use App\Periode;
use App\Study;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        return view('studies.index', compact('periodes', 'studies', 'currentPeriode', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudyStoreRequest $request)
    {
        $periode = Periode::find($request->periode);
        if ($this->isCurrentTimeBetween($periode->register_start, $periode->register_end)) {
            $user = Auth::user();
            $user->studies()->create([
                'periode_id' => $request->periode,
                'course_id' => $request->course,
            ]);
            return redirect()->back()->with('status', 'Add study success!');
        } else {
            return redirect()->back()->withErrors([
                'You has exceeded the deadline!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $periode = Periode::find($request->periode);
        if ($this->isCurrentTimeBetween($periode->register_start, $periode->register_end)) {
            $study = Study::find($id);
            $study->delete();
            return redirect()->back()->with('status', 'Delete study success!');
        } else {
            return redirect()->back()->withErrors([
                'You has exceeded the deadline!'
            ]);
        }
    }

    private function isCurrentTimeBetween ($start, $end) {
        return Carbon::now()->between(Carbon::parse($start), Carbon::parse($end.' 23:59:59'));
    }
}