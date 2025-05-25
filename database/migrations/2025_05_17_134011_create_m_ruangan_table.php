<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMRuanganTable extends Migration
{
    public function up(): void
    {
        Schema::create('m_ruangan', function (Blueprint $table) {
            $table->id('id_ruangan');
            $table->unsignedBigInteger('id_gedung');
            $table->string('kode', 10)->unique();
            $table->string('nama', 100);
            $table->integer('lantai')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
            $table->foreign('id_gedung')
                    ->references('id_gedung')
                    ->on('m_gedung')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('m_ruangan');
    }
}