<?php

namespace App\Http\Controllers;

use App\Models\TblBiodataWali;
use App\Models\TblFileRapor;
use App\Models\TblKartu;
use App\Models\TblPesertaPpdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

// Load Models
use App\Models\TblPekerjaanOrtu;
use App\Models\TblBiodataOrtu;
use App\Models\TblHasil;
use Illuminate\Support\Facades\Storage;

class DaftarController extends Controller
{
    public function index()
    {
        $pekerjaan_ortu = TblPekerjaanOrtu::all();
        return view(
            'home.pendaftaran',
            compact(
                'pekerjaan_ortu',
            )
        );
    }

    public function daftar(Request $request)
    {
        DB::beginTransaction();

        $validator = $this->validateRequest($request);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        try {
            $ortu = $this->createOrtu($request);
            $wali = $this->createWali($request);
            $kartu = $this->createKartu($request);
            $file = $this->createFile($request);

            $daftar = $this->createPeserta($request, $ortu->id, $wali->id, $kartu->id, $file->id);
            $hasil = $this->createHasil($daftar);

            DB::commit();

            Alert::success('Success', 'Thank you for registering!');
            return redirect()->route('landing-page');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Please check your form again!');
            return redirect()->back();
        }
    }

    private function validateRequest($request)
    {
        return Validator::make($request->all(), [
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
            'file_rapor' => 'required',
            'nilai_rata_rata' => 'nullable|numeric',
        ]);
    }

    private function createPeserta($request, $idBiodataOrtu, $idBiodataWali, $idKartu, $idFile)
    {
        return TblPesertaPpdb::create([
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
            'id_biodata_ortu' => $idBiodataOrtu,
            'id_biodata_wali' => $idBiodataWali,
            'id_kartu' => $idKartu,
            'id_file_rapor' => $idFile,
        ]);
    }

    private function createOrtu($request)
    {
        return TblBiodataOrtu::create([
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'no_tlp_ayah' => $request->no_telp_ayah,
            'no_tlp_ibu' => $request->no_telp_ibu,
            'id_pekerjaan_ayah' => $request->id_pekerjaan_ayah,
            'id_pekerjaan_ibu' => $request->id_pekerjaan_ibu,
        ]);
    }

    private function createWali($request)
    {
        return TblBiodataWali::create([
            'nama_wali' => $request->nama_wali,
            'no_tlp_wali' => $request->no_telp_wali,
            'id_pekerjaan_wali' => $request->id_pekerjaan_wali,
        ]);
    }

    private function createKartu($request)
    {
        return TblKartu::create([
            'kip' => $request->nomor_kip,
            'kks' => $request->nomor_kks,
            'kps' => $request->nomor_kps,
            'pkh' => $request->nomor_pkh,
        ]);
    }
    private function createFile($request)
    {

        return TblFileRapor::create([
            'file' => $request->link_file,
        ]);
    }

    private function createHasil($daftar)
    {
        return TblHasil::create([
            'nis' => $daftar->id
        ]);
    }

    public function hasil()
    {
        $items = TblHasil::with(['tbl_peserta_ppdb'])->get();
        return view('home.hasil', compact('items'));

    }
}
