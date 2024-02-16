<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_konser');
            $table->integer('qty');
            $table->bigInteger('total');
            $table->date('tanggal')->nullable();
            $table->string('transfer');
            $table->text('qrcode');
            $table->enum('status', ['Berhasil', 'Proses','Gagal']);
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users');
            $table->foreign('id_konser')->references('id_konser')->on('konser');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
