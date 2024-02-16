<?php
namespace App\Http\Controllers;

use App\Models\Konser;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorPNG;

// ini_set('max_execution_time', 500);
class PembeliController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'pembeli') {
            $dataKonser = Konser::where('status', 'Acc')->get();

            foreach ($dataKonser as $konser) {
                $jumlahTiketTerbeli = Transaksi::where('id_konser', $konser->id_konser)->sum('qty');
                $konser->jumlah_tiket_terbeli = $jumlahTiketTerbeli;
            }

            $data = [
                'title' => 'Beranda',
                'pages' => 'beranda',
                'id' => Auth::user()->id_user,
                'name' => Auth::user()->name,
                'dataKonser' => $dataKonser,
            ];

            return view('pembeli.beranda', $data);
        }

    }


    public function dataTiket()
    {
        $data = array(
            'title' => 'Data Tiket',
            'pages' => 'dataTiket',
            'name' => Auth::user()->name,
            'dataTiket' => DB::table('transaksi')
                ->join('users', 'transaksi.id_user', '=', 'users.id_user')
                ->join('konser', 'transaksi.id_konser', '=', 'konser.id_konser')
                ->where('transaksi.id_user', Auth::user()->id_user)
                ->orderBy('tanggal', 'desc')
                ->get(),
        );
        return view('pembeli.dataTiket', $data);
    }

    public function tambahTransaksi(Request $request)
    {
        $file = $request->file('transfer');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/img/transfer'), $fileName);

        $jumlah_tiket = $request->input('jumlah_tiket');
        $id_konser = $request->input('id_konser');

        if ($request->qty > $jumlah_tiket) {
            return redirect()->back()->with('error', 'Jumlah tiket yang dipesan melebihi tiket yang tersedia.');
        }

        $number = mt_rand(10000000000, 99999999999);

        // Memastikan nomor unik
        while ($this->productCodeExists($number)) {
            $number = mt_rand(10000000000, 99999999999);
        }

        // Generate barcode menggunakan Picqer\Barcode
        $generator = new BarcodeGeneratorPNG();
        $barcodeImageInfo = $generator->getBarcode($number, $generator::TYPE_CODE_128);

        // Periksa apakah $barcodeImageInfo tidak null sebelum mengakses elemennya
        if ($barcodeImageInfo !== null) {
            // Simpan gambar barcode ke dalam file
            $barcodeImageName = $number . '.png';
            file_put_contents(public_path('assets/img/qrcode/' . $barcodeImageName), $barcodeImageInfo);
        } else {
            return redirect()->back()->with('error', 'Gagal membuat barcode.');
        }

        $newTiket = $jumlah_tiket - $request->qty;

        // Simpan transaksi ke database
        Transaksi::create([
            'id_konser' => $id_konser,
            'id_user' => $request->id_user,
            'qty' => $request->qty,
            'total' => $request->total,
            'tanggal' => now(),
            'transfer' => $fileName,
            'qrcode' => $barcodeImageName,
            'keterangan' => 'Proses'
        ]);

        // Update jumlah tiket pada konser
        Konser::find($id_konser)->update(['jumlah_tiket' => $newTiket]);

        return redirect('/pembeli')->with('success', 'Tiket Berhasil Terbeli!!');
    }


    public function productCodeExists($number)
    {
        return Transaksi::whereQrcode($number)->exists();
    }
}