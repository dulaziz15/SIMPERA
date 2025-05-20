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
        Schema::create('m_gedung', function (Blueprint $table) {
            $table->id('id_gedung');
            $table->unsignedBigInteger('id_kategori_gedung');
            $table->string('kode', 10)->unique();
            $table->string('nama', 100);
            $table->text('deskripsi')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->foreign('id_kategori_gedung')
                  ->references('id_kategori_gedung')
                  ->on('m_kategori_gedung')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_gedung');
    }
};