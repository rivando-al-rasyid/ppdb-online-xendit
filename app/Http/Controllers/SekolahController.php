<?php

namespace App\Http\Controllers;

use App\Models\TblBiaya;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SekolahController extends Controller
{
    public function index()
    {
        $sekolah = TblBiaya::first(); // Retrieve sekolah data from the database
        return view('dashboards.sekolah.index', compact('sekolah'));
    }

    public function createOrUpdate(Request $request)
    {
        $data = $request->validate([
            'amount' => 'required|numeric',
            'amount_perempuan' => 'required|numeric',
        ]);

        $sekolah = TblBiaya::first(); // Retrieve existing sekolah data from the database

        if ($sekolah) {
            // If sekolah data exists, update it
            $sekolah->update($data);
            $message = 'Sekolah data has been updated successfully!';
        } else {
            // If sekolah data doesn't exist, create a new record
            TblBiaya::create($data);
            $message = 'Sekolah data has been stored successfully!';
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', $message);
    }
}
