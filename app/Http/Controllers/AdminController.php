<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use App\Models\Lokasi;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $data = array(
                'title' => 'Beranda',
                'pages' => 'beranda',
                'name' => Auth::user()->name
            );

            $lokasi = Lokasi::all();

            return view('admin.beranda', array_merge($data, ['lokasi' => $lokasi]));
        }
    }

    public function dataKonser()
    {
        $data = [
            'title' => 'Data Konser',
            'pages' => 'dataKonser',
            'dataKonser' => DB::table('konser')
                ->join('lokasi', 'konser.id_lokasi', '=', 'lokasi.id_lokasi')
                ->orderBy('konser.created_at', 'desc')
                ->get(),
        ];

        $lokasi = Lokasi::all();

        return view('admin.dataKonser', array_merge($data, ['lokasi' => $lokasi]));
    }



    public function updateKonser(Request $request)
    {
        Konser::where('id_konser', $request->id_konser)
            ->where('id_konser', $request->id_konser)
            ->update([
                'status' => $request->status
            ]);

        return redirect('/admin/konser')->with('success', 'Status Berhasil Diubah');
    }


    public function dataTransaksi()
    {
        $data = array(
            'title' => 'Data Transaksi',
            'pages' => 'dataTransaksi',
            'name' => Auth::user()->name,
            'dataTransaksi' => DB::table('transaksi')
                ->join('users', 'transaksi.id_user', '=', 'users.id_user')
                ->join('konser', 'transaksi.id_konser', '=', 'konser.id_konser')
                ->orderBy('tanggal', 'desc')
                ->get(),
        );
        return view('admin.dataTransaksi', $data);
    }

    public function dataPembeli()
    {
        $data = array(
            'title' => 'Data Pembeli',
            'pages' => 'dataPembeli',
            'name' => Auth::user()->name,
            'dataPembeli' => DB::table('users')
                ->where('role', 'pembeli')
                ->get(),
        );
        return view('admin.dataPembeli', $data);
    }

    public function tambahLokasi(Request $request)
    {

        Lokasi::create([
            'lokasi' => $request->lokasi,
            'tiket' => $request->tiket,
        ]);

        return redirect()->back()->with('success', 'Lokasi dan Kapasitas Berhasil Ditambahkan!!');
    }

    public function updateLokasi(Request $request)
    {

        Lokasi::where('id_lokasi', $request->id_lokasi)
            ->where('id_lokasi', $request->id_lokasi)
            ->update([
                'lokasi' => $request->lokasi,
                'tiket' => $request->tiket,
                
            ]);
        return redirect()->back()->with('success', 'Lokasi dan Kapasitas Berhasil Diubah!!');
    }


}