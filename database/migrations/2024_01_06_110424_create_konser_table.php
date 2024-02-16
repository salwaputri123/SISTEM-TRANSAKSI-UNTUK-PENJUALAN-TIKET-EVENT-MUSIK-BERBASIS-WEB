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
        Schema::create('konser', function (Blueprint $table) {
            $table->id('id_konser');
            $table->integer('id_user');
            $table->unsignedBigInteger('id_lokasi');
            $table->string('nama_konser')->nullable();
            $table->date('tanggal_konser')->nullable();
            $table->integer('jumlah_tiket')->nullable();
            $table->bigInteger('harga');
            $table->text('image')->nullable();
            $table->string('jenis_bank')->nullable();
            $table->string('atas_nama')->nullable();
            $table->bigInteger('rekening')->unique();
            $table->enum('status', ['Setuju', 'Tidak']);
            $table->timestamps();

            $table->foreign('id_lokasi')->references('id_lokasi')->on('lokasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konser');
    }
};
