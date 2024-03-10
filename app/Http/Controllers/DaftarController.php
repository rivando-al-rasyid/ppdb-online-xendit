<?php

namespace App\Http\Controllers;

use App\Models\TblBiodataWali;
use App\Models\TblKartu;
use App\Models\TblPesertaPpdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\TblFile;
// Load Models
use App\Models\TblPekerjaanOrtu;
use App\Models\TblBiodataOrtu;
use App\Models\TblHasil;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Process;

class DaftarController extends Controller
{
    public function index()
    {
        $pekerjaan_ortu = TblPekerjaanOrtu::all();
        return view('home.pendaftaran', compact('pekerjaan_ortu'));
    }

    public function daftar(Request $request)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'nama_depan' => 'required',
                'nama_belakang' => 'required',
                'nisn' => 'required|numeric',
                'nik' => 'required|numeric',
                'no_kk' => 'required|numeric',
                'jenis_kelamin' => 'required',
                'agama' => 'required',
                'tanggal_lahir' => 'required|date|before:yesterday',
                'tempat_lahir' => 'required',
                'asal_sekolah' => 'required',
                'alamat' => 'required',
                'nilai_rata_rata' => 'nullable|numeric',
                'rapor_semester_9' => 'file|mimes:pdf',
                'rapor_semester_10' => 'file|mimes:pdf',
                'rapor_semester_11' => 'file|mimes:pdf',
                'foto' => 'image|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors());
            }

            $ortu = TblBiodataOrtu::create([
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'no_tlp_ayah' => $request->no_telp_ayah,
                'no_tlp_ibu' => $request->no_telp_ibu,
                'id_pekerjaan_ayah' => $request->id_pekerjaan_ayah,
                'id_pekerjaan_ibu' => $request->id_pekerjaan_ibu,
            ]);

            $wali = TblBiodataWali::create([
                'nama_wali' => $request->nama_wali,
                'no_tlp_wali' => $request->no_telp_wali,
                'id_pekerjaan_wali' => $request->id_pekerjaan_wali,
            ]);

            $kartu = TblKartu::create([
                'kip' => $request->nomor_kip,
                'kks' => $request->nomor_kks,
                'kps' => $request->nomor_kps,
                'pkh' => $request->nomor_pkh,
            ]);

            $data = [
                'rapor_semester_9' => $request->hasFile('rapor_semester_9') ? $this->storeFileWithCustomName($request->file('rapor_semester_9'), $request->nama_depan, $request->nama_belakang, 'rapor_semester_9') : null,
                'rapor_semester_10' => $request->hasFile('rapor_semester_10') ? $this->storeFileWithCustomName($request->file('rapor_semester_10'), $request->nama_depan, $request->nama_belakang, 'rapor_semester_10') : null,
                'rapor_semester_11' => $request->hasFile('rapor_semester_11') ? $this->storeFileWithCustomName($request->file('rapor_semester_11'), $request->nama_depan, $request->nama_belakang, 'rapor_semester_11') : null,
                'foto' => $request->hasFile('foto') ? $this->storeFileWithCustomName($request->file('foto'), $request->nama_depan, $request->nama_belakang, 'foto') : null,
            ];
            // Remove null values from the data array
            $filteredData = array_filter($data);

            $file = TblFile::create($filteredData);

            $daftar = TblPesertaPpdb::create([
                'nama_depan' => $request->nama_depan,
                'nama_belakang' => $request->nama_belakang,
                'nisn' => $request->nisn,
                'nik' => $request->nik,
                'no_kk' => $request->no_kk,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'tanggal_lahir' => $request->tanggal_lahir,
                'tempat_lahir' => $request->tempat_lahir,
                'asal_sekolah' => $request->asal_sekolah,
                'alamat' => $request->alamat,
                'id_biodata_ortu' => $ortu->id,
                'id_biodata_wali' => $wali->id,
                'id_kartu' => $kartu->id,
                'id_file' => $file->id,
            ]);

            // Create TblHasil record
            TblHasil::create([
                'nis' => $daftar->id
            ]);

            DB::commit();

            Alert::success('Success', 'Thank you for registering!');
            return redirect()->route('landing-page');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Please check your form again!');
            return redirect()->back();
        }
    }
    private function storeFileWithCustomName($file, $firstName, $lastName, $fileType)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = $fileType . '_' . $firstName . '_' . $lastName . '.' . $extension;
        return $file->storeAs('uploads', $fileName, 'public');
    }
                public function hasil()
    {
        $items = TblHasil::with(['tbl_peserta_ppdb'])->get();
        return view('home.hasil', compact('items'));
    }
}
