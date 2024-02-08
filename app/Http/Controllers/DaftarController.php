<?php

namespace App\Http\Controllers;

use App\Models\TblKartu;
use App\Models\TblWali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

// Load Models
use App\Models\tblPekerjaanOrtu;
use App\Models\PesertaPPDB;
use App\Models\TblBiodataOrtu;
use App\Models\tblHasil;

class DaftarController extends Controller
{
    public function index()
    {
        $pekerjaan_ortu = tblPekerjaanOrtu::all();
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

        $daftar = $this->createPeserta($request);

        if (!$daftar) {
            DB::rollBack();
            Alert::error('Error', 'Please check your form again!');
            return redirect()->back();
        }

        $ortu = $this->createOrtu($request, $daftar);

        if (!$ortu) {
            DB::rollBack();
            Alert::error('Error', 'Please check your form again!');
            return redirect()->back();
        }

        $wali = $this->createWali($request, $daftar);

        $kartu = $this->createKartu($request, $daftar);

        $hasil = $this->createHasil($daftar);

        if (!$hasil) {
            DB::rollBack();
            Alert::error('Error', 'Please check your form again!');
            return redirect()->back();
        }

        DB::commit();
        Alert::success('Success', 'Thank you for registering!');
        return redirect()->route('landing-page');
    }

    private function validateRequest($request)
    {
        return Validator::make($request->all(), [
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'nisn' => 'required',
            'nik' => 'required',
            'no_kk' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'tanggal_lahir' => 'date|before:yesterday',
            'tempat_lahir' => 'required',
            'asal_sekolah' => 'required',
            'alamat' => 'required',
            'nama_ayah' => 'required',
            'id_pekerjaan_ayah' => 'required|exists:tbl_pekerjaan_ortu,id',
            'no_telp_ayah' => 'required',
            'nama_ibu' => 'required',
            'id_pekerjaan_ibu' => 'required|exists:tbl_pekerjaan_ortu,id',
        ]);
    }

    private function createPeserta($request)
    {
        $dataPeserta = [
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
        ];

        return PesertaPPDB::create($dataPeserta);
    }

    private function createOrtu($request, $daftar)
    {
        $dataOrtu = [
            'id_peserta_ppdb' => $daftar->id,
            'id_pekerjaan_ayah' => $request->id_pekerjaan_ayah,
            'id_pekerjaan_ibu' => $request->id_pekerjaan_ibu,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'no_tlp_ayah' => $request->no_telp_ayah,
            'no_tlp_ibu' => $request->no_telp_ibu,
        ];

        return tblBiodataOrtu::create($dataOrtu);
    }

    private function createWali($request, $daftar)
    {
        $dataWali = [
            'id_peserta_ppdb' => $daftar->id,
            'id_pekerjaan_wali' => $request->id_pekerjaan_wali,
            'nama_wali' => $request->nama_wali,
            'no_tlp_wali' => $request->no_telp_wali,
        ];

        return tblWali::create($dataWali);
    }

    private function createKartu($request, $daftar)
    {
        $dataKartu = [
            'id_peserta_ppdb' => $daftar->id,
            'kip' => $request->nomor_kip,
            'kks' => $request->nomor_kks,
            'kps' => $request->nomor_kps,
            'pkh' => $request->nomor_pkh,
        ];

        return tblKartu::create($dataKartu);
    }

    private function createHasil($daftar)
    {
        $data3 = [
            'nis' => $daftar->id
        ];

        return tblHasil::create($data3);
    }

    public function hasil()
    {
        $items = tblHasil::with(['peserta', 'orang_tua'])->get();
        return view('home.hasil', compact('items'));

    }
}
