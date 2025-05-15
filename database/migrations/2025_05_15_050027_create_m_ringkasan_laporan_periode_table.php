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
        Schema::create('m_ringkasan_laporan_periode', function (Blueprint $table) {
            $table->id('id_ringkasan');
            $table->unsignedBigInteger('id_laporan_periode');
            $table->integer('total_laporan')->default(0);
            $table->integer('total_selesai')->default(0);
            $table->integer('total_dalam_proses')->default(0);
            $table->integer('total_tertunda')->default(0);
            $table->float('rata_rata_waktu_penyelesaian')->nullable();
            $table->unsignedBigInteger('fasilitas_paling_sering')->nullable();
            $table->unsignedBigInteger('teknisi_paling_aktif')->nullable();
            $table->decimal('total_biaya', 15, 2)->default(0);
            $table->float('persentase_penyelesaian')->nullable();
            $table->foreign('id_laporan_periode')
                ->references('id_laporan_periode')
                ->on('m_laporan_periode')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('fasilitas_paling_sering')
                ->references('id_fasilitas')
                ->on('m_fasilitas')
                ->nullOnDelete()
                ->onUpdate('cascade');
            $table->foreign('teknisi_paling_aktif')
                ->references('id_pengguna')
                ->on('m_user')
                ->nullOnDelete()
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_ringkasan_laporan_periode');
    }
};
