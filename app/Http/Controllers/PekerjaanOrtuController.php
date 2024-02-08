<?php

namespace App\Http\Controllers;

use App\Models\TblPekerjaanOrtu;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PekerjaanOrtuController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $items = TblPekerjaanOrtu::all();
        return view('dashboards.pekerjaan_ortu.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboards.pekerjaan_ortu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pekerjaan' => 'required',
        ]);

        $pekerjaanOrtu = new PekerjaanOrtu();
        $pekerjaanOrtu->nama_pekerjaan = $request->nama_pekerjaan;
        $pekerjaanOrtu->save();

        Alert::success('Success', 'Data Saved Successfully');
        return redirect()->route('admin.pekerjaan_ortu.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(PekerjaanOrtu $pekerjaanOrtu)
    {
        // Implementation for showing a specific resource
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = TblPekerjaanOrtu::find($id);

        return view('dashboards.pekerjaan_ortu.edit', compact('data'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pekerjaan' => 'required',
        ]);

        $Query = TblPekerjaanOrtu::find($id);
        $Query->nama_pekerjaan = $request->nama_pekerjaan;

        if ($Query) {
            $Query->update();
            Alert::success('Sukses', 'Edit Data Sukses');
            return redirect()->route('admin.pekerjaan_ortu.index');
        }

        Alert::error('Error', 'Failed to update data');
        return back();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TblPekerjaanOrtu $pekerjaanOrtu)
    {
        $pekerjaanOrtu->delete();

        Alert::success('Success', 'Data Deleted Successfully');
        return redirect()->route('admin.pekerjaan_ortu.index');
    }
}
