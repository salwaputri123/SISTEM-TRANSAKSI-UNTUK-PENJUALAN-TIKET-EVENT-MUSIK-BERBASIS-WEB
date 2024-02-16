<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Transaksi extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'id_konser',
        'id_user',
        'qty',
        'total',
        'tanggal',
        'status',
        'transfer',
        'qrcode',
        'keterangan'
    ];
}
