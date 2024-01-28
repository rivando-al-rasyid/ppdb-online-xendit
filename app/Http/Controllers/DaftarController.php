<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

// Load Models
use App\Models\User;
use App\Models\PekerjaanOrtu;
use App\Models\PesertaPPDB;
use App\Models\BiodataOrtu;
use App\Models\Hasil;

class DaftarController extends Controller
{
    public function index()
    {
        $pekerjaan_ortu = PekerjaanOrtu::all();
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

        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $namaPeserta = $request->nama;
        // Handle 'ijasah' file upload with custom name
        // $ijasahPath = $request->file('ijasah')->storeAs('uploads', 'ijasah_' . $namaPeserta . '.' . $request->file('ijasah')->getClientOriginalExtension(), 'public');

        // // Handle 'kk' file upload with custom name
        // $fotoKkPath = $request->file('kk')->storeAs('uploads', 'kk_' . $namaPeserta . '.' . $request->file('kk')->getClientOriginalExtension(), 'public');

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

        $daftar = PesertaPPDB::create($dataPeserta);
        if (!$daftar) {
            DB::rollBack();
            Alert::error('Error', 'Please check your form again!');
            return redirect()->back();
        }
        $dataOrtu = [
            'id_peserta_ppdb' => $daftar->id,
            'id_pekerjaan_ayah' => $request->id_pekerjaan_ayah,
            'id_pekerjaan_ibu' => $request->id_pekerjaan_ibu,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'no_tlp_ayah' => $request->no_telp_ayah,
            'no_tlp_ibu' => $request->no_telp_ibu,
        ];


        $ortu = BiodataOrtu::create($dataOrtu);
        if (!$ortu) {
            DB::rollBack();
            Alert::error('Error', 'Please check your form again!');
            return redirect()->back();
        }
        $data3 = [
            'nis' => $daftar->id
        ];

        $hasil = Hasil::create($data3);
        if (!$hasil) {
            DB::rollBack();
            Alert::error('Error', 'Please check your form again!');
            return redirect()->back();
        }

        DB::commit();
        Alert::success('Success', 'Thank you for registering!');
        return redirect()->route('landing-page');
    }

    public function hasil()
    {
        $items = Hasil::with(['peserta', 'orang_tua'])->get();
        return view('home.hasil', compact('items'));

    }
}
