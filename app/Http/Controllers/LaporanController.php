<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\TblHasil;
use App\Models\InformasiSekolah;

class LaporanController extends Controller
{
    public function LaporanDiterima()
    {
        $items = TblHasil::with(['tbl_peserta_ppdb'])->get();
        $tentang = InformasiSekolah::all();
        $tahun_ajar = $tentang->first()->tahun_ajar;
        $tahun = $tahun_ajar . '/' . ($tahun_ajar + 1); // Correctly format the academic year

        $pdf = PDF::loadView('dashboards.laporan.downloads.diterima', compact('items', 'tentang'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan Siswa Diterima' . $tahun . '.pdf'); // Ensure proper concatenation for the filename
    }
    public function LaporanDiterimaLakiLaki()
    {
        $items = TblHasil::with(['tbl_peserta_ppdb'])->get();
        $tentang = InformasiSekolah::all();
        $tahun_ajar = $tentang->first()->tahun_ajar;
        $tahun = $tahun_ajar . '/' . ($tahun_ajar + 1); // Correctly format the academic year

        $pdf = PDF::loadView('dashboards.laporan.downloads.diterima', compact('items', 'tentang'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan Siswa Diterima Laki-Laki' . $tahun . '.pdf'); // Ensure proper concatenation for the filename
    }
    public function LaporanDiterimaPerempuan()
    {
        $items = TblHasil::with(['tbl_peserta_ppdb'])->get();
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

        $pdf = PDF::loadView('dashboards.laporan.downloads.diterima', compact('items', 'tentang'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan Pendaftaran PPDB' . $tahun . '.pdf'); // Ensure proper concatenation for the filename
    }
    public function LaporanPembayaran()
    {
        $items = TblHasil::with(['tbl_peserta_ppdb'])->get();
        $tentang = InformasiSekolah::all();
        $tahun_ajar = $tentang->first()->tahun_ajar;
        $tahun = $tahun_ajar . '/' . ($tahun_ajar + 1); // Correctly format the academic year

        $pdf = PDF::loadView('dashboards.laporan.downloads.diterima', compact('items', 'tentang'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan Siswa pembayaran ' . $tahun . '.pdf'); // Ensure proper concatenation for the filename
    }


}
