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
        Schema::create('daftar_pengajuans', function (Blueprint $table) {
            $table->id();
            $table->text('stored_by');
            $table->text('nama_ketua');
            $table->text('nama_lomba');
            $table->string('identitas_number_ketua');
            $table->string('jenis_pengajuan');
            $table->string('email_ketua')->unique();
            $table->string('no_telp_ketua');
            $table->text('file_proposal_pengajuan');
            $table->string('kategori');
            $table->text('namadosen');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_pengajuans');
    }
};
