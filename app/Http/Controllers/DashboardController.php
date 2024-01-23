<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;


// Load Models
use App\Models\Hasil;
use App\Modules\Tus\Models\Tu;
use App\Models\PesertaPPDB;
use App\Models\Pembayaran;
use PDF;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller
{w
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {

        $items = Hasil::with(['peserta.orang_tua'])->get();

        // Count
        $count_admin = Tu::all()->count();
        $count_all_peserta = Hasil::all()->count();
        $count_menunggu_peserta = Hasil::where('status', 'MENUNGGU')->count();
        $count_ditolak_peserta = Hasil::where('status', 'DITOLAK')->count();
        $count_diterima_peserta = Hasil::where('status', 'DITERIMA')->count();
        return view(
            'dashboards.laporan.index',
            compact(
                'items',
                'count_admin',
                'count_all_peserta',
                'count_menunggu_peserta',
                'count_ditolak_peserta',
                'count_diterima_peserta'
            )
        );
    }
    public function indextu()
    {

        $items = Hasil::with(['peserta.orang_tua'])->get();

        // Count
        $count_admin = Tu::all()->count();
        $count_all_peserta = Hasil::all()->count();
        $count_menunggu_peserta = Hasil::where('status', 'MENUNGGU')->count();
        $count_ditolak_peserta = Hasil::where('status', 'DITOLAK')->count();
        $count_diterima_peserta = Hasil::where('status', 'DITERIMA')->count();
        return view(
            'dashboards.laporan.tu.index',
            compact(
                'items',
                'count_admin',
                'count_all_peserta',
                'count_menunggu_peserta',
                'count_ditolak_peserta',
                'count_diterima_peserta'
            )
        );
    }


    public function transaksi()
    {
        $items = Pembayaran::all();
        return view(
            'dashboards.laporan.tu.transaksi',
            compact(
                'items',
            )
        );

    }



    public function detail($id)
    {
        $item = Hasil::with(['peserta.orang_tua'])->where('id', $id)->first();
        return view('dashboards.laporan.detail', compact('item'));
    }
    public function detailtu($id)
    {
        $item = Hasil::with(['peserta.orang_tua'])->where('id', $id)->first();
        return view('dashboards.laporan.tu.detail', compact('item'));
    }

    public function terima($id)
    {
        $item = Hasil::findOrFail($id);
        $item->status = 'DITERIMA';
        // Save the new Hasil's ID to the $item->id_Hasil field
        $item->update();

        // Display a success message
        Alert::success('Sukses', 'Simpan Data Sukses');
        if (Auth::guard('tu')->check()) {
            return redirect()->route('tu.dashboard');
        } elseif (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        } else {
            view()->share('guard', 'web');
        }

        // Redirect the Hasil to the 'home' route
    }

    public function tolak($id)
    {
        $item = Hasil::findOrFail($id);

        $item->status = 'DITOLAK';
        $item->update();

        Alert::success('Sukses', 'Simpan Data Sukses');
        if (Auth::guard('tu')->check()) {
            return redirect()->route('tu.dashboard');
        } elseif (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        } else {
            view()->share('guard', 'web');
        }
    }

    public function download()
    {
        $data = PesertaPPDB::all();
        $pdf = PDF::loadView('dashboards.laporan.laporan', compact('data')); // 'reports.report' is the blade file for your report
        return $pdf->download('laporan.pdf');
    }
}
