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
        Schema::create('m_laporan_periode', function (Blueprint $table) {
            $table->id('id_laporan_periode');
            $table->unsignedBigInteger('id_periode');
            $table->string('judul_laporan', 255);
            $table->timestamp('tanggal_dibuat')->useCurrent();
            $table->unsignedBigInteger('dibuat_oleh');
            $table->text('catatan')->nullable();
            $table->string('status')->default('draft');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->foreign('id_periode')
                  ->references('id_periode')
                  ->on('periode')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('dibuat_oleh')
                  ->references('id_pengguna')
                  ->on('m_user')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_laporan_periode');
    }
};