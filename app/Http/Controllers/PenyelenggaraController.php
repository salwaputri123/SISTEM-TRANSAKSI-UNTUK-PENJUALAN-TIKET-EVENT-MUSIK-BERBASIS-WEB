<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use App\Models\Transaksi;
use App\Models\Lokasi;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenyelenggaraController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'penyelenggara') {

            $data = array(
                'title' => 'Beranda',
                'pages' => 'beranda',
                'id' => Auth::user()->id_user,
                'name' => Auth::user()->name,
            );
            return view('penyelenggara.beranda', $data);
        }
    }

    public function dataKonser()
    {
        $data = [
            'title' => 'Data Konser',
            'pages' => 'dataKonser',
            'id' => Auth::user()->id_user,
            'dataKonser' => DB::table('konser')
                ->join('lokasi', 'konser.id_lokasi', '=', 'lokasi.id_lokasi')
                ->where('id_user', Auth::user()->id_user)
                ->orderBy('konser.created_at', 'desc')
                ->get(),
        ];

        // Menambahkan informasi jumlah tiket terbeli untuk setiap konser
        foreach ($data['dataKonser'] as $konser) {
            $jumlahTiketTerbeli = DB::table('transaksi')
                ->where('id_konser', $konser->id_konser)
                ->sum('qty');

            $konser->jumlah_tiket_terbeli = $jumlahTiketTerbeli;
        }

        $lokasi = Lokasi::all();

        return view('penyelenggara.dataKonser', array_merge($data, ['lokasi' => $lokasi]));
    }


    public function insertKonser(Request $request)
    {
        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/img/poster'), $fileName);

        $id_lokasi = $request->input('lokasi');
        $jumlahTiketLokasi = DB::table('lokasi')->where('id_lokasi', $id_lokasi)->value('tiket');

        $request->merge([
            'status' => 'Tidak',
        ]);

        Konser::create([
            'id_user' => Auth::user()->id_user,
            'nama_konser' => $request->nama_konser,
            'tanggal_konser' => $request->tanggal_konser,
            'id_lokasi' => $id_lokasi,
            'jumlah_tiket' => $jumlahTiketLokasi,
            'harga' => $request->harga,
            'image' => $fileName,
            'jenis_bank' => $request->jenis_bank,
            'atas_nama' => $request->atas_nama,
            'rekening' => $request->rekening,
            'status' => 'Tidak',
        ]);

        return redirect('/penyelenggara/dataKonser')->with('success', 'Data Konser Berhasil Diubah!!');
    }

    public function updateKonser(Request $request)
    {
        $id_lokasi = $request->input('lokasi');
        $jumlahTiketLokasi = DB::table('lokasi')->where('id_lokasi', $id_lokasi)->value('tiket');

        Konser::where('id_konser', $request->id_konser)
            ->where('id_konser', $request->id_konser)
            ->update([
                'id_user' => Auth::user()->id_user,
                'nama_konser' => $request->nama_konser,
                'tanggal_konser' => $request->tanggal_konser,
                'id_lokasi' => $id_lokasi,
                'jumlah_tiket' => $jumlahTiketLokasi,
                'harga' => $request->harga,
                'jenis_bank' => $request->jenis_bank,
                'atas_nama' => $request->atas_nama,
                'rekening' => $request->rekening,
            ]);

        return redirect('/penyelenggara/dataKonser')->with('success', 'Data Konser Berhasil Terbeli!!');
    }

    public function deleteKonser(Request $request)
    {
        // Check if there are transactions related to the concert
        $hasTransactions = Transaksi::where('id_konser', $request->id_konser)->exists();

        // If there are transactions, notify the user and redirect back
        if ($hasTransactions) {
            return redirect('/penyelenggara/dataKonser')->with('error', 'Konser tidak dapat dihapus karena memiliki transaksi terkait.');
        }

        // If no transactions, proceed with deletion
        $image_name = $request->image;
        $image_path = public_path('assets/img/poster/' . $image_name);

        // Delete the concert image
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // Delete the concert record
        Konser::where('id_konser', $request->id_konser)->delete();

        return redirect('/penyelenggara/dataKonser')->with('success', 'Konser berhasil dihapus.');
    }


    public function dataTransaksi()
    {
        $data = array(
            'title' => 'Data Transaksi',
            'pages' => 'dataTransaksi',
            'id' => Auth::user()->id_user,
            'dataTransaksi' => DB::table('transaksi')
                ->join('users', 'transaksi.id_user', '=', 'users.id_user')
                ->join('konser', 'transaksi.id_konser', '=', 'konser.id_konser')
                ->where('konser.id_user', Auth::user()->id_user)
                ->orderBy('transaksi.created_at', 'desc')
                ->get(),
        );
        return view('penyelenggara.dataTransaksi', $data);
    }

    public function updateTransaksi(Request $request)
    {
        Transaksi::where('id_transaksi', $request->id_transaksi)
            ->where('id_transaksi', $request->id_transaksi)
            ->update([
                'keterangan' => $request->status,
            ]);

        return redirect('/penyelenggara/dataTransaksi')->with('success', 'Status Transaksi Berhasil Diubah!!');
    }
}