<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TblHasil;
use App\Models\InformasiSekolah;
use Illuminate\Support\Facades\Cache;

class LaporanController extends Controller
{
    private function getInformasiSekolah()
    {
        return Cache::remember('informasi_sekolah', 60, function () {
            return InformasiSekolah::first();
        });
    }

    private function getTahunAjar()
    {
        $tentang = $this->getInformasiSekolah();
        return $tentang->tahun_ajar . '/' . ($tentang->tahun_ajar + 1);
    }

    private function generatePdf($view, $data, $filename, $paper = 'a4')
    {
        $pdf = PDF::loadView($view, $data)->setPaper($paper);
        return $pdf->stream($filename);
    }

    public function LaporanDiterima()
    {
        $items = TblHasil::with(['tbl_peserta_ppdb:id,nama_depan,nama_belakang,jenis_kelamin,nisn,tanggal_lahir,tempat_lahir,agama,nilai_rata_rata,asal_sekolah'])
            ->where('status', 'DITERIMA')
            ->get(['id', 'status', 'nis']);

        $tentang = $this->getInformasiSekolah();
        $tahun = $this->getTahunAjar();

        return $this->generatePdf('dashboards.laporan.downloads.diterima', compact('items', 'tentang'), 'Laporan_Siswa_Diterima_' . $tahun . '.pdf');
    }

    public function LaporanDiterimaLakiLaki()
    {
        $items = TblHasil::with(['tbl_peserta_ppdb:id,nama_depan,nama_belakang,jenis_kelamin,nisn,tanggal_lahir,tempat_lahir,agama,nilai_rata_rata,asal_sekolah'])
            ->where('status', 'DITERIMA')
            ->whereHas('tbl_peserta_ppdb', function ($query) {
                $query->where('jenis_kelamin', 'L');
            })
            ->get(['id', 'status', 'nis']);

        $tentang = $this->getInformasiSekolah();
        $tahun = $this->getTahunAjar();

        return $this->generatePdf('dashboards.laporan.downloads.diterima', compact('items', 'tentang'), 'Laporan_Siswa_Diterima_Laki-Laki_' . $tahun . '.pdf');
    }

    public function LaporanDiterimaPerempuan()
    {
        $items = TblHasil::with(['tbl_peserta_ppdb:id,nama_depan,nama_belakang,jenis_kelamin,nisn,tanggal_lahir,tempat_lahir,agama,nilai_rata_rata,asal_sekolah'])
            ->where('status', 'DITERIMA')
            ->whereHas('tbl_peserta_ppdb', function ($query) {
                $query->where('jenis_kelamin', 'P');
            })
            ->get(['id', 'status', 'nis']);

        $tentang = $this->getInformasiSekolah();
        $tahun = $this->getTahunAjar();

        return $this->generatePdf('dashboards.laporan.downloads.diterima', compact('items', 'tentang'), 'Laporan_Siswa_Diterima_Perempuan_' . $tahun . '.pdf');
    }

    public function LaporanSemua()
    {
        $items = TblHasil::with(['tbl_peserta_ppdb'])->get();
        $tentang = $this->getInformasiSekolah();
        $tahun = $this->getTahunAjar();

        $pdf = PDF::loadView('dashboards.laporan.downloads.semua', compact('items', 'tentang'))
            ->setPaper([0, 0, 794, 1250], 'landscape'); // Use F4 dimensions in mm

        return $pdf->stream('Laporan Pendaftaran PPDB' . $tahun . '.pdf'); // Ensure proper concatenation for the filename

    }

    public function LaporanPembayaran()
    {
        $items = TblHasil::with(['tbl_peserta_ppdb'])
            ->where('status', 'DITERIMA')
            ->get();
        $tentang = $this->getInformasiSekolah();
        $tahun = $this->getTahunAjar();

        return $this->generatePdf('dashboards.laporan.downloads.pembayaran', compact('items', 'tentang'), 'Laporan_Pembayaran_Siswa_' . $tahun . '.pdf');
    }
}
