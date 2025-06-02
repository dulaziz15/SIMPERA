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
        Schema::create('m_riwayat_perbaikan', function (Blueprint $table) {
             $table->id('id_riwayat');
            $table->unsignedBigInteger('id_penugasan');
            $table->text('tindakan_dilakukan');
            $table->text('material_dipakai')->nullable();
            $table->decimal('biaya', 10, 2)->nullable();
            $table->unsignedBigInteger('diperbaiki_oleh')->nullable();
            $table->timestamp('tanggal_perbaikan')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->foreign('id_penugasan')
                  ->references('id_penugasan')
                  ->on('m_penugasan')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('diperbaiki_oleh')
                  ->references('id_pengguna')
                  ->on('m_user')
                  ->OnDelete()
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_riwayat_perbaikan');
    }
};