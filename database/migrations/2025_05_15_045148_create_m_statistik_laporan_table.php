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
        Schema::create('m_statistik_laporan', function (Blueprint $table) {
            $table->id('id_statistik');
            $table->unsignedBigInteger('id_periode')->nullable();
            $table->integer('total_laporan')->default(0);
            $table->integer('laporan_selesai')->default(0);
            $table->float('rata_waktu_penyelesaian')->nullable();
            $table->unsignedBigInteger('fasilitas_paling_sering')->nullable();
            $table->timestamp('waktu_pembuatan')->useCurrent();
            $table->foreign('id_periode')
                  ->references('id_periode')
                  ->on('periode')
                  ->OnDelete()
                  ->onUpdate('cascade');
            $table->foreign('fasilitas_paling_sering')
                  ->references('id_fasilitas')
                  ->on('m_fasilitas')
                  ->OnDelete()
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_statistik_laporan');
    }
};
