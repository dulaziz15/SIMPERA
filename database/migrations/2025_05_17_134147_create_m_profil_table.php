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
        Schema::create('m_profil', function (Blueprint $table) {
           $table->id('id_profil');
            $table->unsignedBigInteger('id_pengguna');
            $table->string('nama_lengkap', 100)->nullable();
            $table->date('aktif')->nullable();
            $table->string('foto_profil')->nullable(); // simpan path file/foto, bukan tipe image
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->foreign('id_pengguna')
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
        Schema::dropIfExists('m_profil');
    }
};