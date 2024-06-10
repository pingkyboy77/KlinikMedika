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
        Schema::table('users', function (Blueprint $table) {
            // Kolom khusus untuk mahasiswa
            $table->integer('angkatan_tahun')->nullable();
            $table->string('prodi')->nullable();
            $table->integer('sks_ditempuh')->nullable();
            $table->decimal('ipk', 3, 2)->nullable();
            // Kolom khusus untuk dosen
            $table->string('NIP')->nullable();
            $table->enum('jenis_kelamin', ['male', 'female'])->nullable();
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('pangkat_akademik')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
