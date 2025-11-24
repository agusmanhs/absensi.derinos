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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('tanggal');
            $table->string('lokasi_kantor')->nullable();
            $table->time('absen_masuk')->nullable();
            $table->string('lokasi_masuk')->nullable();
            $table->string('ket_masuk')->nullable();
            $table->time('absen_keluar')->nullable();
            $table->string('lokasi_keluar')->nullable();
            $table->string('ket_keluar')->nullable();
            $table->string('status')->nullable();
            $table->string('ket_izin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
