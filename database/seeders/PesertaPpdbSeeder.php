<?php

namespace Database\Seeders;

use App\Models\TblPesertaPpdb;
use Illuminate\Database\Seeder;

class PesertaPpdbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_depan' => 'John',
                'nama_belakang' => 'Doe',
                'nisn' => 1234567890,
                'nik' => 9876543210,
                'no_kk' => 123456789,
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2009-01-01',
                'tempat_lahir' => 'Jakarta',
                'agama' => 'Islam',
                'nilai_rata_rata' => 85.5,
                'asal_sekolah' => 'SMP Negeri 1 Jakarta',
                'alamat' => 'Jl. Jendral Sudirman No. 123, Jakarta',
                'id_biodata_ortu' => 1,
                'id_user' => 1,
            ],
            // Add more sample data as needed
        ];

        // Additional sample data
        $additionalData = [
            [
                'nama_depan' => 'Hasudungan',
                'nama_belakang' => 'Simanjuntak',
                'nisn' => 1234567891,
                'nik' => 9876543211,
                'no_kk' => 123456781,
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2009-02-01',
                'tempat_lahir' => 'Medan',
                'agama' => 'Kristen',
                'nilai_rata_rata' => 86.0,
                'asal_sekolah' => 'SMP Negeri 2 Medan',
                'alamat' => 'Jl. Sisingamangaraja No. 123, Medan',
                'id_biodata_ortu' => 2,

            ],
            [
                'nama_depan' => 'Ribka',
                'nama_belakang' => 'Sitorus',
                'nisn' => 1234567892,
                'nik' => 9876543212,
                'no_kk' => 123456782,
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '2009-03-01',
                'tempat_lahir' => 'Medan',
                'agama' => 'Kristen',
                'nilai_rata_rata' => 87.0,
                'asal_sekolah' => 'SMP Negeri 3 Medan',
                'alamat' => 'Jl. Sisingamangaraja No. 124, Medan',
                'id_biodata_ortu' => 3,

            ],
            [
                'nama_depan' => 'Ferdinand',
                'nama_belakang' => 'Lumban Gaol',
                'nisn' => 1234567893,
                'nik' => 9876543213,
                'no_kk' => 123456783,
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2009-04-01',
                'tempat_lahir' => 'Medan',
                'agama' => 'Kristen',
                'nilai_rata_rata' => 88.0,
                'asal_sekolah' => 'SMP Negeri 4 Medan',
                'alamat' => 'Jl. Sisingamangaraja No. 125, Medan',
                'id_biodata_ortu' => 4,

            ],
            [
                'nama_depan' => 'Yulita',
                'nama_belakang' => 'Nasution',
                'nisn' => 1234567894,
                'nik' => 9876543214,
                'no_kk' => 123456784,
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '2009-05-01',
                'tempat_lahir' => 'Padang',
                'agama' => 'Islam',
                'nilai_rata_rata' => 89.0,
                'asal_sekolah' => 'SMP Negeri 1 Padang',
                'alamat' => 'Jl. Ahmad Yani No. 123, Padang',
                'id_biodata_ortu' => 5,
            ],
            [
                'nama_depan' => 'Rafli',
                'nama_belakang' => 'Harahap',
                'nisn' => 1234567895,
                'nik' => 9876543215,
                'no_kk' => 123456785,
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2009-06-01',
                'tempat_lahir' => 'Padang',
                'agama' => 'Islam',
                'nilai_rata_rata' => 90.0,
                'asal_sekolah' => 'SMP Negeri 2 Padang',
                'alamat' => 'Jl. Ahmad Yani No. 124, Padang',
                'id_biodata_ortu' => 6,
            ],
            [
                'nama_depan' => 'Syafira',
                'nama_belakang' => 'Siregar',
                'nisn' => 1234567896,
                'nik' => 9876543216,
                'no_kk' => 123456786,
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '2009-07-01',
                'tempat_lahir' => 'Padang',
                'agama' => 'Islam',
                'nilai_rata_rata' => 91.0,
                'asal_sekolah' => 'SMP Negeri 3 Padang',
                'alamat' => 'Jl. Ahmad Yani No. 125, Padang',
                'id_biodata_ortu' => 7,
            ],
            [
                'nama_depan' => 'Hasiholan',
                'nama_belakang' => 'Simbolon',
                'nisn' => 1234567897,
                'nik' => 9876543217,
                'no_kk' => 123456787,
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2009-08-01',
                'tempat_lahir' => 'Medan',
                'agama' => 'Kristen',
                'nilai_rata_rata' => 92.0,
                'asal_sekolah' => 'SMP Negeri 5 Medan',
                'alamat' => 'Jl. Sisingamangaraja No. 126, Medan',
                'id_biodata_ortu' => 8,
            ],
            [
                'nama_depan' => 'Saras',
                'nama_belakang' => 'Sinaga',
                'nisn' => 1234567898,
                'nik' => 9876543218,
                'no_kk' => 123456788,
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '2009-09-01',
                'tempat_lahir' => 'Medan',
                'agama' => 'Kristen',
                'nilai_rata_rata' => 93.0,
                'asal_sekolah' => 'SMP Negeri 6 Medan',
                'alamat' => 'Jl. Sisingamangaraja No. 127, Medan',
                'id_biodata_ortu' => 9,
            ],
            // Add more entries as needed up to 30
            [
                'nama_depan' => 'Daniel',
                'nama_belakang' => 'Tampubolon',
                'nisn' => 1234567899,
                'nik' => 9876543219,
                'no_kk' => 123456789,
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2009-10-01',
                'tempat_lahir' => 'Medan',
                'agama' => 'Kristen',
                'nilai_rata_rata' => 94.0,
                'asal_sekolah' => 'SMP Negeri 7 Medan',
                'alamat' => 'Jl. Sisingamangaraja No. 128, Medan',
                'id_biodata_ortu' => 10,
            ],
            [
                'nama_depan' => 'Melati',
                'nama_belakang' => 'Tanjung',
                'nisn' => 1234567810,
                'nik' => 9876543220,
                'no_kk' => 1234567810,
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '2009-11-01',
                'tempat_lahir' => 'Padang',
                'agama' => 'Islam',
                'nilai_rata_rata' => 95.0,
                'asal_sekolah' => 'SMP Negeri 4 Padang',
                'alamat' => 'Jl. Ahmad Yani No. 126, Padang',
                'id_biodata_ortu' => 11,
            ],
            [
                'nama_depan' => 'Dicky',
                'nama_belakang' => 'Saragih',
                'nisn' => 1234567811,
                'nik' => 9876543221,
                'no_kk' => 1234567811,
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2009-12-01',
                'tempat_lahir' => 'Medan',
                'agama' => 'Kristen',
                'nilai_rata_rata' => 96.0,
                'asal_sekolah' => 'SMP Negeri 8 Medan',
                'alamat' => 'Jl. Sisingamangaraja No. 129, Medan',
                'id_biodata_ortu' => 12,
            ],
            // Continue adding more entries until you reach 30 total
        ];

        // Merge the initial data with additional data
        $data = array_merge($data, $additionalData);

        // Insert the data
        foreach ($data as $item) {
            TblPesertaPpdb::create($item);
        }
    }
}
