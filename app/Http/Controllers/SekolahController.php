<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sekolah;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Pembayaran;
use App\Models\PesertaPPDB;
use App\Models\User;

class SekolahController extends Controller
{
    public function index()
    {
        $sekolah = Sekolah::first(); // Retrieve sekolah data from the database
        return view('dashboards.sekolah', compact('sekolah'));
    }

    public function storeOrUpdate(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'amount' => 'required|numeric',
            'deskripsi_tagihan' => 'required|string',
            // Add validation rules for other fields as needed
        ]);

        $sekolah = Sekolah::first(); // Retrieve existing sekolah data from the database

        if ($sekolah) {
            // If sekolah data exists, update it
            $sekolah->update($data);
            $message = 'Sekolah data has been updated successfully!';
            Alert::success('Success', $message);
            return redirect()->route('admin.sekolah.profile');
        } else {
            // If sekolah data doesn't exist, create a new record
            Sekolah::create($data);
            $message = 'Sekolah data has been stored successfully!';
            Alert::success('Success', $message);

            return redirect()->route('admin.sekolah.profile');
        }
    }
}
