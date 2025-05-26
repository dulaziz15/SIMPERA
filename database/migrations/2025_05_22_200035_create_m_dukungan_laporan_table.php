<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMDukunganLaporanTable extends Migration
{
    public function up(): void
    {
        Schema::create('m_dukungan_laporan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_laporan');
            $table->unsignedBigInteger('id_user');
            $table->text('deskripsi')->nullable();
            $table->integer('tingkat_kerusakan');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->primary(['id_laporan', 'id_user']);

            $table->foreign('id_laporan')
                    ->references('id_laporan')
                    ->on('m_laporan_perbaikan')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('id_user')
                    ->references('id_pengguna')
                    ->on('m_user')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('m_dukungan_laporan');
    }
}