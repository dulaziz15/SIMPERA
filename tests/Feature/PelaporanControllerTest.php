<?php

namespace Tests\Feature;

use App\Models\FasilitasModel;
use App\Models\LaporanPerbaikanModel;
use App\Models\PeranModel;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PelaporanControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function user_dapat_melihat_halaman_index()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/pelaporan');

        $response->assertStatus(200);
        $response->assertViewIs('pelaporan.index');
    }

    /** @test */
    public function user_dapat_melihat_halaman_create()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/pelaporan/create');

        $response->assertStatus(200);
        $response->assertViewIs('pelaporan.create');
        $response->assertViewHas('fasilitas');
    }

    /** @test */
    public function user_dapat_menyimpan_pelaporan()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $fasilitas = FasilitasModel::factory()->create();

        $data = [
            'id_pengguna' => $user->id_pengguna,
            'id_fasilitas' => $fasilitas->id_fasilitas,
            'deskripsi' => 'Kerusakan AC',
            'url_foto' => UploadedFile::fake()->image('foto.jpg'),
            'status' => 'diverifikasi',
            'waktu_pelaporan' => now(),
            'waktu_perubahan' => now(),
        ];

        $response = $this->actingAs($user)->postJson('/pelaporan/store', $data);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Data berhasil Disimpan.',
                'redirect' => url('/pelaporan')
            ]);

        $this->assertDatabaseHas('m_laporan_perbaikan', [
            'id_pengguna' => $user->id_pengguna,
            'id_fasilitas' => $fasilitas->id_fasilitas,
            'deskripsi' => 'Kerusakan AC',
        ]);
    }

    /** @test */
    public function validasi_store_gagal_jika_field_kosong()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/pelaporan/store', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['id_pengguna', 'id_fasilitas', 'deskripsi', 'status', 'waktu_pelaporan']);
    }

    /** @test */
    public function user_dapat_melihat_detail_pelaporan()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $pelaporan = LaporanPerbaikanModel::factory()->create();

        $response = $this->actingAs($user)->get("/pelaporan/{$pelaporan->id_laporan}/show");

        $response->assertStatus(200)
            ->assertViewIs('pelaporan.show')
            ->assertViewHas('pelaporan');
    }

    /** @test */
    public function user_dapat_melihat_halaman_edit()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $pelaporan = LaporanPerbaikanModel::factory()->create();

        $response = $this->actingAs($user)->get("/pelaporan/{$pelaporan->id_laporan}/edit");

        $response->assertStatus(200)
            ->assertViewIs('pelaporan.edit')
            ->assertViewHas('pelaporan');
    }

    /** @test */
    public function user_dapat_update_pelaporan()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $pelaporan = LaporanPerbaikanModel::factory()->create();

        $data = [
            'id_pengguna' => $user->id_pengguna,
            'id_fasilitas' => $pelaporan->id_fasilitas,
            'deskripsi' => 'Update deskripsi kerusakan',
            'url_foto' => UploadedFile::fake()->image('foto.jpg'),
            'status' => 'diverifikasi',
            'waktu_pelaporan' => now(),
            'waktu_perubahan' => now()
        ];

        $response = $this->actingAs($user)->putJson("/pelaporan/{$pelaporan->id_laporan}/update", $data);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Data berhasil Diupdate.',
                'redirect' => url('/pelaporan')
            ]);

        $this->assertDatabaseHas('m_laporan_perbaikan', [
            'id_laporan' => $pelaporan->id_laporan,
            'deskripsi' => 'Update deskripsi kerusakan'
        ]);
    }

    /** @test */
    public function validasi_update_gagal_jika_field_kosong()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $pelaporan = LaporanPerbaikanModel::factory()->create();

        $response = $this->actingAs($user)->putJson("/pelaporan/{$pelaporan->id_laporan}/update", []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['id_pengguna', 'id_fasilitas', 'deskripsi', 'status', 'waktu_pelaporan']);
    }

    /** @test */
    public function user_dapat_melihat_halaman_confirm()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $pelaporan = LaporanPerbaikanModel::factory()->create();

        $response = $this->actingAs($user)->get("/pelaporan/{$pelaporan->id_laporan}/confirm");

        $response->assertStatus(200)
            ->assertViewIs('pelaporan.confirm')
            ->assertViewHas('pelaporan');
    }

    /** @test */
    public function user_dapat_delete_pelaporan()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $pelaporan = LaporanPerbaikanModel::factory()->create();

        $response = $this->actingAs($user)->deleteJson("/pelaporan/{$pelaporan->id_laporan}/delete");

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Data berhasil Dihapus.',
                'redirect' => url('/pelaporan')
            ]);

        $this->assertDatabaseMissing('m_laporan_perbaikan', [
            'id_laporan' => $pelaporan->id_laporan
        ]);
    }
}
