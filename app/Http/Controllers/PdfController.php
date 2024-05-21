namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\TblHasil;

class PdfController extends Controller
{
    public function generatePdf()
    {
        $students = TblHasil::with('tbl_peserta_ppdb')->get();

        $pdf = PDF::loadView('dashboards.laporan.downloads.laporanditerima', compact('students'));
        return $pdf->download('students.pdf');
    }
}
