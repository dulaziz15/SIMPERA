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
        Schema::create('m_user', function (Blueprint $table) {
            $table->id('id_pengguna');
            $table->string('nama_pengguna', 50)->unique();
            $table->string('hash_kata_sandi', 255);
            $table->unsignedBigInteger('id_peran');
            $table->string('surel', 100)->unique();
            $table->string('nama_lengkap', 100);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('id_peran')
                  ->references('id_peran')
                  ->on('m_peran')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_user');
    }
};
