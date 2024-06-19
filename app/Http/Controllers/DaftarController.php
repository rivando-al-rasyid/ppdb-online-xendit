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
use App\Models\TblNilai;
use Intervention\Image\Facades\Image;


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
                'tanggal_lahir' => 'required|date|before:',
                'tempat_lahir' => 'required',
                'asal_sekolah' => 'required',
                'alamat' => 'required',
                'nilai_rata_rata' => 'nullable|numeric',
                'rapor_semester_9' => 'file|mimes:pdf',
                'rapor_semester_10' => 'file|mimes:pdf',
                'rapor_semester_11' => 'file|mimes:pdf',
                'sertifikat_tpq' => 'file|mimes:pdf',
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
            $ratarata = number_format(
                ($request->nilai_mtk_5_1 + $request->nilai_ipa_5_1 + $request->nilai_bi_5_1 +
                    $request->nilai_mtk_5_2 + $request->nilai_ipa_5_2 + $request->nilai_bi_5_2 +
                    $request->nilai_mtk_6_1 + $request->nilai_ipa_6_1 + $request->nilai_bi_6_1) / 9,
                2,
                '.',
                ''
            );
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
                'nilai_rata_rata' => $ratarata,
            ]);
            $nilai = TblNilai::create([
                'id_peserta_ppdb' => $daftar->id,
                'nilai_mtk_5_1' => $request->nilai_mtk_5_1,
                'nilai_ipa_5_1' => $request->nilai_ipa_5_1,
                'nilai_bi_5_1' => $request->nilai_bi_5_1,
                'nilai_mtk_5_2' => $request->nilai_mtk_5_2,
                'nilai_ipa_5_2' => $request->nilai_ipa_5_2,
                'nilai_bi_5_2' => $request->nilai_bi_5_2,
                'nilai_mtk_6_1' => $request->nilai_mtk_6_1,
                'nilai_ipa_6_1' => $request->nilai_ipa_6_1,
                'nilai_bi_6_1' => $request->nilai_bi_6_1,
            ]);

            $data = [
                'rapor_semester_9' => $request->hasFile('rapor_semester_9') ? $this->compressAndStoreFile($request->file('rapor_semester_9'), $request->nama_depan, $request->nama_belakang, 'rapor_semester_9', $daftar->id, 'pdf') : null,
                'rapor_semester_10' => $request->hasFile('rapor_semester_10') ? $this->compressAndStoreFile($request->file('rapor_semester_10'), $request->nama_depan, $request->nama_belakang, 'rapor_semester_10', $daftar->id, 'pdf') : null,
                'rapor_semester_11' => $request->hasFile('rapor_semester_11') ? $this->compressAndStoreFile($request->file('rapor_semester_11'), $request->nama_depan, $request->nama_belakang, 'rapor_semester_11', $daftar->id, 'pdf') : null,
                'sertifikat_tpq' => $request->hasFile('sertifikat_tpq') ? $this->compressAndStoreFile($request->file('sertifikat_tpq'), $request->nama_depan, $request->nama_belakang, 'sertifikat_tpq', $daftar->id, 'pdf') : null,
                'foto' => $request->hasFile('foto') ? $this->compressAndStoreFile($request->file('foto'), $request->nama_depan, $request->nama_belakang, 'foto', $daftar->id, 'image') : null,
            ];
            $filteredData = array_filter($data);
            $file = TblFile::create($filteredData);
            $daftar->id_file = $file->id;
            $daftar->save();

            TblHasil::create([
                'nis' => $daftar->id
            ]);

            DB::commit();

            $account_sid = env('TWILIO_SID');
            $auth_token = env('TWILIO_TOKEN');
            $twilio_number = env('TWILIO_FROM_NUMBER');
            $phoneNumber = $request->no_telp_ayah;
            if (substr($phoneNumber, 0, 1) == '0') {
                $phoneNumber = '+62' . substr($phoneNumber, 1);
            } elseif (substr($phoneNumber, 0, 2) == '62') {
                $phoneNumber = '+' . $phoneNumber;
            } else {
                $phoneNumber = '+62' . $phoneNumber;
            }
            $client = new \Twilio\Rest\Client($account_sid, $auth_token);

            try {
                $message = $client->messages->create(
                    $phoneNumber,
                    [
                        "from" => $twilio_number,
                        "body" => 'Your registration is successful.'
                    ]
                );

                if ($message->sid) {
                    Alert::success('Success', 'Thank you for registering! SMS notification sent successfully.');
                } else {
                    Alert::error('Error', 'Thank you for registering! However, SMS notification could not be sent.');
                }
            } catch (\Twilio\Exceptions\RestException $e) {
                Alert::error('Error', 'SMS could not be sent. Error: ' . $e->getMessage());
            }

            return redirect()->route('hasil');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorMessage = 'Error: ' . $e->getMessage() . ' (Code: ' . $e->getCode() . ')';
            Alert::error('Error', $errorMessage);
            return redirect()->back();
        }
    }
    private function compressAndStoreFile($file, $firstName, $lastName, $fileType, $daftarId, $fileFormat)
    {
        $firstName = str_replace(' ', '_', $firstName);
        $lastName = str_replace(' ', '_', $lastName);
        $baseFolderPath = 'uploads/files/';
        $userFolderName = $firstName . '_' . $lastName . '_' . $daftarId;
        $folderPath = $baseFolderPath . $userFolderName;

        if (!file_exists(storage_path('app/' . $folderPath))) {
            mkdir(storage_path('app/' . $folderPath), 0755, true);
        }

        if ($fileFormat === 'pdf') {
            // Not compressing PDF files, just moving the original file
            $optimizedFilePath = $folderPath . '/' . $fileType . '_' . $firstName . '_' . $lastName . '.pdf';
            $file->move(storage_path('app/' . $folderPath), $optimizedFilePath);
            return $optimizedFilePath;
        } elseif ($fileFormat === 'image') {
            // Compress image
            $quality = 75; // Initial quality setting
            $maxFileSize = 2048 * 2048; // 2 MB in bytes
            $image = Image::make($file);
            do {
                // Encode the image with the current quality setting
                $encodedImage = $image->encode('jpg', $quality);
                // Get the size of the encoded image
                $fileSize = strlen($encodedImage);
                // If the size is greater than 1 MB, reduce the quality
                if ($fileSize > $maxFileSize) {
                    $quality -= 5; // Decrease quality by 5
                }
            } while ($fileSize > $maxFileSize && $quality > 0);

            // Save the compressed image
            $optimizedFilePath = $folderPath . '/' . $fileType . '_' . $firstName . '_' . $lastName . '.jpg';
            $image->save(storage_path('app/' . $optimizedFilePath), $quality);

            return $optimizedFilePath;
        }

        return null;
    }

    public function hasil()
    {
        $items = TblHasil::with(['tbl_peserta_ppdb'])->get();
        return view('home.hasil', compact('items'));
    }
}
