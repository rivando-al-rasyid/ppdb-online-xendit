<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\TblHasil;
use App\Models\InformasiSekolah;
use Illuminate\Support\Facades\Cache;

class LaporanController extends Controller
{
    public function LaporanDiterima()
    {
        // Eager load only necessary columns to reduce query size and memory usage
        $items = TblHasil::with(['tbl_peserta_ppdb:id,nama_depan,nama_belakang,jenis_kelamin,nisn,tanggal_lahir,tempat_lahir,agama,nilai_rata_rata,asal_sekolah'])
            ->where('status', 'DITERIMA')
            ->get(['id', 'status', 'nis']); // fetch only needed columns
        // Ensure we only call first() once
        $tentang = InformasiSekolah::first();
        $tahun_ajar = $tentang->tahun_ajar;
        $tahun = $tahun_ajar . '/' . ($tahun_ajar + 1); // Correctly format the academic year

        // Pass only the necessary data to the view
        $pdf = PDF::loadView('dashboards.laporan.downloads.diterima', compact('items', 'tentang'))
            ->setPaper('a4', 'portrait');

        // Ensure proper concatenation for the filename
        return $pdf->stream('Laporan_Siswa_Diterima_' . $tahun . '.pdf');
    }


    public function LaporanDiterimaLakiLaki()
    {
        $items = TblHasil::whereHas('tbl_peserta_ppdb', function ($query) {
            $query->where('jenis_kelamin', 'L');
        })->where('status', 'DITERIMA')
            ->with('tbl_peserta_ppdb')
            ->get();
        $tentang = InformasiSekolah::all();
        $tahun_ajar = $tentang->first()->tahun_ajar;
        $tahun = $tahun_ajar . '/' . ($tahun_ajar + 1); // Correctly format the academic year

        $pdf = PDF::loadView('dashboards.laporan.downloads.diterima', compact('items', 'tentang'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan Siswa Diterima Laki-Laki' . $tahun . '.pdf'); // Ensure proper concatenation for the filename
    }

    public function LaporanDiterimaPerempuan()
    {
        $items = TblHasil::whereHas('tbl_peserta_ppdb', function ($query) {
            $query->where('jenis_kelamin', 'P');
        })->where('status', 'DITERIMA')
            ->with('tbl_peserta_ppdb')
            ->get();
        $tentang = InformasiSekolah::all();
        $tahun_ajar = $tentang->first()->tahun_ajar;
        $tahun = $tahun_ajar . '/' . ($tahun_ajar + 1); // Correctly format the academic year

        $pdf = PDF::loadView('dashboards.laporan.downloads.diterima', compact('items', 'tentang'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan Siswa Diterima Perempuan' . $tahun . '.pdf'); // Ensure proper concatenation for the filename
    }

    public function LaporanSemua()
    {
        $items = TblHasil::with(['tbl_peserta_ppdb'])->get();
        $tentang = InformasiSekolah::all();
        $tahun_ajar = $tentang->first()->tahun_ajar;
        $tahun = $tahun_ajar . '/' . ($tahun_ajar + 1); // Correctly format the academic year

        $pdf = PDF::loadView('dashboards.laporan.downloads.semua', compact('items', 'tentang'))
            ->setPaper([0, 0, 794, 1250], 'landscape'); // Use F4 dimensions in mm

        return $pdf->stream('Laporan Pendaftaran PPDB' . $tahun . '.pdf'); // Ensure proper concatenation for the filename
    }

    public function LaporanPembayaran()
    {
        $items = TblHasil::with(['tbl_peserta_ppdb'])
            ->where('status', 'DITERIMA')
            ->get();
        $tentang = InformasiSekolah::all();
        $tahun_ajar = $tentang->first()->tahun_ajar;
        $tahun = $tahun_ajar . '/' . ($tahun_ajar + 1); // Correctly format the academic year

        $pdf = PDF::loadView('dashboards.laporan.downloads.pembayaran', compact('items', 'tentang'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan Siswa pembayaran ' . $tahun . '.pdf'); // Ensure proper concatenation for the filename
    }
}
