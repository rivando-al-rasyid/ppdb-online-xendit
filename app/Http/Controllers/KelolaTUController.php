<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Modules\Tus\Models\Tu;
use Illuminate\Support\Str; // Import the Str class


use Illuminate\Http\Request;

class KelolaTUController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Tu::all();
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

        $tu = new Tu();
        $tu->name = $request->name;
        $tu->email = $request->email;
        $tu->email_verified_at = now();
        $tu->password = bcrypt($request->password);
        $tu->remember_token = Str::random(10);

        $tu->save();

        Alert::success('Success', 'Akun Tu Created Successfully');
        return redirect()->route('admin.kelola_tu.index');
    }
    public function edit($id)
    {
        $data = Tu::find($id);
        return view('dashboards.kelola_tu.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $tu = Tu::find($id);
        if ($tu) {
            $tu->name = $request->name;
            $tu->email = $request->email;
            if ($request->password) {
                $tu->password = bcrypt($request->password);
            }
            $tu->save();

            Alert::success('Success', 'Data Updated Successfully');
            return redirect()->route('admin.kelola_tu.index');
        }

        Alert::error('Error', 'Failed to update data');
        return back();
    }
    public function destroy($id)
    {
        $tu = Tu::find($id);
        if ($tu) {
            $tu->delete();
            Alert::success('Success', 'Tu Deleted Successfully');
            return redirect()->route('admin.kelola_tu.index');
        }

        Alert::error('Error', 'Failed to delete tu');
        return back();
    }
}
