<?php

namespace App\Http\Controllers;

use App\Models\TblPesertaPpdb;
use RealRashid\SweetAlert\Facades\Alert;


// Load Models
use App\Models\TblHasil;
use App\Modules\Tus\Models\Tu;
use App\Models\Pembayaran;
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
        // Get counts
        $counts = $this->getCounts();

        // Fetch items
        $items = TblHasil::with(['tbl_peserta_ppdb'])->get();

        return view('dashboards.dashboard.admin.index', compact('items', 'counts'));
    }
    public function indextu()
    {
        // Get counts
        $counts = $this->getCounts();

        // Fetch items
        $items = TblHasil::with(['tbl_peserta_ppdb'])->get();

        return view('dashboards.dashboard.tu.index', compact('items', 'counts'));
    }

    private function getCounts()
    {
        $counts = [
            'admin' => Tu::count(),
            'all_peserta' => TblHasil::count(),
            'menunggu_peserta' => TblHasil::where('status', 'MENUNGGU')->count(),
            'ditolak_peserta' => TblHasil::where('status', 'DITOLAK')->count(),
            'cadangan_peserta' => TblHasil::where('status', 'CADANGAN')->count(),
            'diterima_peserta' => TblHasil::where('status', 'DITERIMA')->count(),
        ];

        return $counts;
    }
    public function laporan()
    {
        $items = TblPesertaPpdb::with(['tbl_biodata_ortu', 'tbl_biodata_wali'])->get();

        // Count
        return view(
            'dashboards.laporan.index',
            compact(
                'items',
            )
        );
    }
    public function exportindex()
    {
        $items = TblPesertaPpdb::with(['tbl_biodata_ortu', 'tbl_biodata_wali'])->get();

        // Count
        return view(
            'dashboards.export.index',
            compact(
                'items',
            )
        );
    }

    public function dataortu()
    {
        $items = TblPesertaPpdb::with(['tbl_biodata_ortu', 'tbl_biodata_wali'])->get();

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
        $items = TblPesertaPpdb::with(['tbl_pembayaran'])->get();
        return view(
            'dashboards.laporan.transaksi',
            compact(
                'items',
            )
        );

    }

    public function kartu()
    {
        $items = TblPesertaPpdb::with(['tbl_kartu'])->get();
        return view(
            'dashboards.laporan.kartu',
            compact(
                'items',
            )
        );

    }


    public function detail($id)
    {
        $item = TblHasil::findOrFail($id); // Assuming TblHasil is your model

        // You can also eager load relationships if needed
        $item->load('tbl_peserta_ppdb');
        return view(
            'dashboards.dashboard.admin.detail',
            compact(
                'item'
            )
        );

    }
    public function detailtu($id)
    {
        $item = TblHasil::findOrFail($id); // Assuming TblHasil is your model

        // You can also eager load relationships if needed
        $item->load('tbl_peserta_ppdb');
        return view(
            'dashboards.dashboard.tu.detail',
            compact(
                'item'
            )
        );

    }
    private function formatPhoneNumber($phoneNumber)
    {
        if (substr($phoneNumber, 0, 1) == '0') {
            return '+62' . substr($phoneNumber, 1);
        } elseif (substr($phoneNumber, 0, 2) == '62') {
            return '+' . $phoneNumber;
        } else {
            return '+62' . $phoneNumber;
        }
    }


    public function terima($id)
    {
        $item = TblHasil::findOrFail($id);
        $item->status = 'DITERIMA';
        // Save the new Hasil's ID to the $item->id_Hasil field
        $item->update();
        $phoneNumber = $item->tbl_peserta_ppdb->tbl_biodata_ortu->no_tlp_ayah;
        $phoneNumber = $this->formatPhoneNumber($phoneNumber);

        $client = new \Twilio\Rest\Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));

        try {
            $message = $client->messages->create(
                $phoneNumber,
                [
                    "from" => env('TWILIO_FROM_NUMBER'),
                    "body" => "Kamu telah Diterima"
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
        $item = TblHasil::findOrFail($id);

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
        $item = TblHasil::findOrFail($id);
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
