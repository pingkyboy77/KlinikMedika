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
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->string('identity_number')->unique();
            $table->string('insurance_number')->unique();
            $table->string('PasienName');
            $table->date('tgl_lahir')->nullable();
            $table->string('email')->unique();
            $table->string('telp')->nullable();
            $table->text('alamat')->nullable();
            $table->string('id_prov')->nullable();
            $table->string('id_kab')->nullable();
            $table->string('id_kec')->nullable();
            $table->string('id_des')->nullable();
            $table->text('allergy')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
