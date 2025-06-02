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
            Schema::create('m_laporan_perbaikan', function (Blueprint $table) {
                $table->id('id_laporan');
                $table->unsignedBigInteger('id_pengguna');
                $table->unsignedBigInteger('id_fasilitas');
                $table->text('deskripsi')->nullable();
                $table->string('url_foto', 255)->nullable();
                $table->string('status')->default('baru');
                $table->unsignedBigInteger('id_periode');
                $table->timestamp('waktu_pelaporan')->useCurrent();
                $table->timestamp('waktu_perubahan')->nullable();
                $table->foreign('id_pengguna')
                    ->references('id_pengguna')
                    ->on('m_user')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
                $table->foreign('id_fasilitas')
                    ->references('id_fasilitas')
                    ->on('m_fasilitas')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
                $table->foreign('id_periode')
                    ->references('id_periode')
                    ->on('periode')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('m_laporan_perbaikan');
        }
    };