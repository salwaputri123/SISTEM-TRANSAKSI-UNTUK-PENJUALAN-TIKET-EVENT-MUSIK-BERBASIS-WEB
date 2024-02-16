<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfDownloadController extends Controller
{
    public function unduhPDF($id_transaksi)
    {
        $data = array(
            'title' => 'Data Tiket',
            'pages' => 'dataTiket',
            'dataTiket' => DB::table('transaksi')
                ->join('users', 'transaksi.id_user', '=', 'users.id_user')
                ->join('konser', 'transaksi.id_konser', '=', 'konser.id_konser')
                ->where('transaksi.id_transaksi', $id_transaksi)
                ->get(),
        );

        $html = view('pembeli.unduhPdf', $data)->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper("A4", "portrait");
        $dompdf->render();

        // Simpan ke file
        $output = $dompdf->output();
        $filename = "Tiket.pdf";
        file_put_contents($filename, $output);

        // Berikan tautan unduhan
        return response()->download($filename)->deleteFileAfterSend(true);
    }

}
