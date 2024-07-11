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
    public function download($file)
    {
        // Define the storage path for private files
        $filePath = storage_path('app/private/' . $file);

        // Check if the file exists
        if (!file_exists($filePath)) {
            abort(404);
        }

        // Return the file as a response for download
        return response()->download($filePath);
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
        return view(
            'dashboards.laporan.index'
        );
    }
    public function laporanterima()
    {
        return view(
            'dashboards.laporan.terima'
        );
    }
    public function laporanterimalaki()
    {
        return view(
            'dashboards.laporan.terimalaki'
        );
    }
    public function laporanterimaperempuan()
    {
        return view(
            'dashboards.laporan.terimaperempuan'
        );
    }
    public function laporantransaksi()
    {
        return view(
            'dashboards.laporan.transaksi'
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

    public function updateStatus($id, $status, $messageBody)
    {
        $item = TblHasil::findOrFail($id);
        $item->status = $status;
        $item->update();

        $this->sendSMSNotification($item->tbl_peserta_ppdb->tbl_biodata_ortu->no_tlp_ayah, $messageBody);

        Alert::success('Sukses', 'Simpan Data Sukses');
        return $this->redirectToDashboard();
    }

    private function sendSMSNotification($phoneNumber, $messageBody)
    {
        $phoneNumber = $this->formatPhoneNumber($phoneNumber);
        $client = new \Twilio\Rest\Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));

        try {
            $message = $client->messages->create(
                $phoneNumber,
                [
                    "from" => env('TWILIO_FROM_NUMBER'),
                    "body" => $messageBody
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
    }

    private function redirectToDashboard()
    {
        if (Auth::guard('tu')->check()) {
            return redirect()->route('tu.dashboard');
        } elseif (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        } else {
            view()->share('guard', 'web');
        }
    }

    public function terima($id)
    {
        return $this->updateStatus($id, 'DITERIMA', 'Kamu telah Diterima');
    }

    public function tolak($id)
    {
        return $this->updateStatus($id, 'DITOLAK', 'Maaf, kamu belum diterima.');
    }

    public function cadangan($id)
    {
        return $this->updateStatus($id, 'CADANGAN', 'Kamu berada di daftar cadangan.');
    }
}
