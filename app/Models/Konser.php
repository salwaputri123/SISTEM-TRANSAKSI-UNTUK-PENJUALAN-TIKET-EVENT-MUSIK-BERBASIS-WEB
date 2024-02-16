<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Konser extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'konser';
    protected $primaryKey = 'id_konser';

    protected $fillable = [
        'id_user',
        'id_lokasi',
        'nama_konser',
        'tanggal_konser',
        'jumlah_tiket',
        'harga',
        'image',
        'jenis_bank',
        'atas_nama',
        'rekening',
        'status',
    ];


    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_konser', 'id_konser');
    }

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
