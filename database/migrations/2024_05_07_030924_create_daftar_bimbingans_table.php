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
        Schema::create('daftar_bimbingans', function (Blueprint $table) {
            $table->id();
            $table->text('stored_by');
            $table->text('nama_ketua');
            $table->text('nama_lomba');
            $table->string('identitas_number_ketua');
            $table->string('jenis_pengajuan');
            $table->string('kategori_lomba');
            $table->text('namadosen');
            $table->text('lokasi_bimbingan');
            $table->text('tanggal_bimbingan');
            $table->time('waktu_bimbingan');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_bimbingans');
    }
};
