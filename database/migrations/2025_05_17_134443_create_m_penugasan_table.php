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
        Schema::create('m_penugasan', function (Blueprint $table) {
            $table->id('id_penugasan');
            $table->unsignedBigInteger('id_laporan');
            $table->unsignedBigInteger('id_teknisi');
            $table->unsignedBigInteger('ditugaskan_oleh');
            $table->timestamp('tanggal_mulai')->nullable();
            $table->timestamp('tanggal_selesai')->nullable();
            $table->string('status_progres')->default('ditugaskan');
            $table->text('catatan_perubahan')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->foreign('id_laporan')
                  ->references('id_laporan')
                  ->on('m_laporan_perbaikan')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('id_teknisi')
                  ->references('id_pengguna')
                  ->on('m_user')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
            $table->foreign('ditugaskan_oleh')// Foreign key ke m_user untuk penugas (sarpras)
                  ->references('id_pengguna')
                  ->on('m_user')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_penugasan');
    }
};