<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformasiSekolah;
use RealRashid\SweetAlert\Facades\Alert;

class InformasiSekolahController extends Controller
{
    public function manage()
    {
        $informasiSekolah = InformasiSekolah::first();
        return view('dashboards.informasi_sekolah.index', compact('informasiSekolah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajar' => 'required|integer',
            'tanggal_laporan' => 'required|date',
            'nama_kepsek' => 'required|string|max:255',
            'nip' => 'required|numeric|unique:informasi_sekolahs,nip',
        ]);

        InformasiSekolah::create($request->all());

        Alert::success('Success', 'Informasi Sekolah created successfully.');
        return redirect()->route('admin.informasi_sekolah.manage');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun_ajar' => 'required|integer',
            'tanggal_laporan' => 'required|date',
            'nama_kepsek' => 'required|string|max:255',
            'nip' => 'required|numeric|unique:informasi_sekolahs,nip,' . $id,
        ]);

        $informasiSekolah = InformasiSekolah::findOrFail($id);
        $informasiSekolah->update($request->all());

        Alert::success('Success', 'Informasi Sekolah updated successfully.');
        return redirect()->route('admin.informasi_sekolah.manage');
    }
}
