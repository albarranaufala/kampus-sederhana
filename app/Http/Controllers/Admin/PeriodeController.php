<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PeriodeStoreRequest;
use App\Http\Requests\PeriodeUpdateRequest;
use App\Periode;

class PeriodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $periodes = Periode::all();

        return view('admin.periodes.index', compact('periodes'));
    }

    public function store(PeriodeStoreRequest $request)
    {
        Periode::create([
            'year' => $request->year,
            'semester' => $request->semester,
            'register_start' => $request->register_start,
            'register_end' => $request->register_end
        ]);

        return redirect()->back()->with('status', 'Add periode success!');
    }

    public function update(PeriodeUpdateRequest $request, $id)
    {
        Periode::find($id)->update([
            'year' => $request->year,
            'semester' => $request->semester,
            'register_start' => $request->register_start,
            'register_end' => $request->register_end
        ]);

        return redirect()->back()->with('status', 'Update periode success!');
    }

    public function destroy($id)
    {
        $periode = Periode::find($id);
        $periode->delete();

        return redirect()->back()->with('status', 'Delete periode success!');
    }
}
