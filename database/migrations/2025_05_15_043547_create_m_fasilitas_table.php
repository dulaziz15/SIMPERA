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
        Schema::create('m_fasilitas', function (Blueprint $table) {
           $table->id('id_fasilitas');
            $table->string('nama', 100);
            $table->unsignedBigInteger('id_kategori');
            $table->string('lokasi', 50)->nullable();
            $table->unsignedBigInteger('id_gedung');
            $table->enum('status', ['berfungsi', 'rusak', 'diperbaiki'])->default('berfungsi');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->foreign('id_kategori')
                  ->references('id_kategori')
                  ->on('m_kategori_fasilitas')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
            $table->foreign('id_gedung')
                  ->references('id_gedung')
                  ->on('m_gedung')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_fasilitas');
    }
};
