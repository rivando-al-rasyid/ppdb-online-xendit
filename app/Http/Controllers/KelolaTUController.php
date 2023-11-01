<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;

use Illuminate\Http\Request;

class KelolaTUController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = User::all();
        return view('dashboards.kelola_tu.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboards.kelola_tu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        Alert::success('Success', 'User Created Successfully');
        return redirect()->route('kelola_tu.index');
    }
    public function edit($id)
    {
        $data = User::find($id);
        return view('dashboards.kelola_tu.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = User::find($id);
        if ($user) {
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->save();

            Alert::success('Success', 'Data Updated Successfully');
            return redirect()->route('kelola_tu.index');
        }

        Alert::error('Error', 'Failed to update data');
        return back();
    }
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            Alert::success('Success', 'User Deleted Successfully');
            return redirect()->route('kelola_tu.index');
        }

        Alert::error('Error', 'Failed to delete user');
        return back();
    }
}
