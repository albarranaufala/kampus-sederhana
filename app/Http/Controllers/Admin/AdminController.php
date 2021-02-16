<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $admins = User::where('role', 'admin')->get();
        return view('admin.civitas.admins.index', compact('admins'));
    }

    public function store(AdminStoreRequest $request)
    {
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'role' => 'admin',
            'password' => bcrypt($request->password)
        ]);

        return redirect()->back()->with('status', 'Add admin success!');
    }

    public function update(AdminUpdateRequest $request, $id)
    {
        User::find($id)->update([
            'name' => $request->name,
            'username' => $request->username
        ]);

        return redirect()->back()->with('status', 'Update admin success!');
    }

    public function destroy($id)
    {
        $admin = User::find($id);
        if($admin->id === Auth::id()){
            return redirect()->back()->withErrors([
                "You can't delete yourself!"
            ]);
        }
        $admin->delete();
        return redirect()->back()->with('status', 'Delete admin success!');
    }
}
