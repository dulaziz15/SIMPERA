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
        Schema::create('m_notifikasi', function (Blueprint $table) {
            $table->id('id_notifikasi');
            $table->unsignedBigInteger('id_pengguna');
            $table->string('judul', 100);
            $table->text('pesan');
            $table->boolean('sudah_dibaca')->default(false);
            $table->timestamp('created_at')->useCurrent();
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
        Schema::dropIfExists('m_notifikasi');
    }
};
