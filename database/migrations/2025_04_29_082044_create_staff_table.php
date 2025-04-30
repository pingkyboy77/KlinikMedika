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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('StaffID')->unique();
            $table->date('tgl_lahir')->nullable();
            $table->string('email')->unique();
            $table->string('foto')->unique();
            $table->string('telp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('id_prov')->nullable();
            $table->string('id_kab')->nullable();
            $table->string('id_kec')->nullable();
            $table->string('id_des')->nullable();
            $table->string('jabatan')->nullable();
            $table->date('tgl_masuk')->nullable();
            $table->date('tgl_keluar')->nullable();
            $table->string('status', 1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }


};
