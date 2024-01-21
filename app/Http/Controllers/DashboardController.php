<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;


// Load Models
use App\Models\User;
use App\Modules\Tus\Models\Tu;
use App\Models\Hasil;
use App\Models\PesertaPPDB;
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
        // Retrieve the 'name' field from 'tbl_peserta_ppdb' table based on the provided ID
        $namaPeserta = PesertaPPDB::where('id', $id)->value('nama'); // Assuming 'nama' is the field you want to retrieve
        $no_hp = PesertaPPDB::where('id', $id)->value('no_telp');

        if (!$namaPeserta) {
            // Handle the situation where data with the provided ID is not found
            Alert::error('Error', 'Data not found');
            return redirect()->route('home');
        }

        // Create a new user
        $user = new User();
        $user->name = $namaPeserta;
        $baseEmail = $namaPeserta . '@example.com';
        $suffix = $id; // Use the ID directly as the suffix
        if (User::where('email', $baseEmail)->exists()) {
            $randomEmail = $namaPeserta . $suffix . '@example.com';
        } else {
            $randomEmail = $baseEmail;
        }

        $user->email = $randomEmail;
        $user->password = bcrypt($randomEmail);
        // Save the user object to the database
        $user->phone = $no_hp;
        $user->save();

        // Update the status of the Hasil item to 'DITERIMA'
        $item = Hasil::findOrFail($id);
        $item->status = 'DITERIMA';
        // Save the new user's ID to the $item->id_user field
        $item->user_id = $user->id;
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

        // Redirect the user to the 'home' route
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
