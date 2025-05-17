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
        Schema::create('m_detail_laporan_periode', function (Blueprint $table) {
            $table->id('id_detail');
            $table->unsignedBigInteger('id_laporan_periode');
            $table->unsignedBigInteger('id_laporan_perbaikan');
            $table->unsignedBigInteger('id_penugasan')->nullable();
            $table->timestamp('waktu_pelaporan')->nullable();
            $table->timestamp('waktu_penyelesaian')->nullable();
            $table->float('durasi_penyelesaian')->nullable()->comment('dalam jam');
            $table->decimal('biaya_perbaikan', 12, 2)->nullable();
            $table->text('materi_perbaikan')->nullable();
            $table->text('catatan_khusus')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->foreign('id_laporan_periode')
                  ->references('id_laporan_periode')
                  ->on('m_laporan_periode')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('id_laporan_perbaikan')
                  ->references('id_laporan')
                  ->on('m_laporan_perbaikan')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('id_penugasan')
                  ->references('id_penugasan')
                  ->on('m_penugasan')
                  ->nullOnDelete()
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_detail_laporan_periode');
    }
};