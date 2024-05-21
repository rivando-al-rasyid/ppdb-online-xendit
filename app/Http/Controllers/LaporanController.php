<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\TblHasil;

class LaporanController extends Controller
{
    public function generatePdf()
    {
        $items = TblHasil::with(['tbl_peserta_ppdb'])->get();

        $pdf = PDF::loadView('dashboards.laporan.downloads.laporanditerima', compact('items'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download('students.pdf');
    }
}
