<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TblBiaya;

class BiayaController extends Controller
{
    public function index()
    {
        $biaya = TblBiaya::first(); // Retrieve biaya data from the database
        return view('dashboards.biaya.index', compact('biaya'));
    }

    public function createOrUpdate(Request $request)
    {
        $data = $request->validate([
            'amount_laki' => 'required|numeric',
            'amount_perempuan' => 'required|numeric',
        ]);

        $biaya = TblBiaya::first(); // Retrieve existing biaya data from the database

        if ($biaya) {
            // If biaya data exists, update it
            $biaya->update($data);
            $message = 'Sekolah data has been updated successfully!';
        } else {
            // If biaya data doesn't exist, create a new record
            TblBiaya::create($data);
            $message = 'Sekolah data has been stored successfully!';
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', $message);
    }

}
