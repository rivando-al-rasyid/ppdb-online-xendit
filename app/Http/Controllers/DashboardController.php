<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;


// Load Models
use App\Models\Hasil;
use App\Modules\Tus\Models\Tu;
use App\Models\Pembayaran;
use PDF;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller
{
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
        // Determine the user's role
        $role = Auth::guard('web')->user();
        $items = Hasil::with(['peserta', 'orang_tua'])->get();
        $count_admin = Tu::all()->count();

        // Count
        $count_all_peserta = Hasil::all()->count();
        $count_menunggu_peserta = Hasil::where('status', 'MENUNGGU')->count();
        $count_ditolak_peserta = Hasil::where('status', 'DITOLAK')->count();
        $count_cadangan_peserta = Hasil::where('status', 'CADANGAN')->count();
        $count_diterima_peserta = Hasil::where('status', 'DITERIMA')->count();

        // Determine the view based on the user's role
        $view = $role === 'admin' ? 'dashboards.dashboard.tu.index' : 'dashboards.dashboard.admin.index';

        return view(
            $view,
            compact(
                'items',
                'count_admin',
                'count_all_peserta',
                'count_menunggu_peserta',
                'count_ditolak_peserta',
                'count_cadangan_peserta',
                'count_diterima_peserta'
            )
        );
    }
    public function laporan()
    {
        $items = Hasil::with(['peserta', 'orang_tua'])->get();

        // Count
        return view(
            'dashboards.laporan.index',
            compact(
                'items',
            )
        );
    }
    public function dataortu()
    {
        $items = Hasil::with(['peserta', 'orang_tua'])->get();

        // Count
        return view(
            'dashboards.laporan.dataortu',
            compact(
                'items',
            )
        );
    }



    public function transaksi()
    {
        $items = Pembayaran::all();
        return view(
            'dashboards.dashboard.tu.transaksi',
            compact(
                'items',
            )
        );

    }



    public function detail($id)
    {
        $role = Auth::guard('web')->user();
        $item = Hasil::with(['peserta.orang_tua'])->where('id', $id)->first();
        $view = $role === 'admin' ? 'dashboards.dashboard.tu.detail' : 'dashboards.dashboard.admin.detail';
        return view(
            $view,
            compact(
                'item'
            )
        );

    }
    public function detailtu($id)
    {
        $item = Hasil::with(['peserta.orang_tua'])->where('id', $id)->first();
        return view('dashboards.dashboard.tu.detail', compact('item'));
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
    public function cadangan($id)
    {
        $item = Hasil::findOrFail($id);
        $item->status = 'CADANGAN';
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


}
