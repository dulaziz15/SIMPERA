<?php

namespace Tests\Feature;

use App\Models\FasilitasModel;
use App\Models\GedungModel;
use App\Models\KategoriFasilitasModel;
use App\Models\PeranModel;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class FasilitasControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function user_dapat_melihat_halaman_index()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/fasilitas');

        $response->assertStatus(200);
        $response->assertViewIs('fasilitas.index');
    }

    /** @test */
    public function user_dapat_melihat_halaman_create()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/fasilitas/create');

        $response->assertStatus(200);
        $response->assertViewIs('fasilitas.create');
    }

    /** @test */
    public function user_dapat_menyimpan_fasilitas_baru()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();

        $kategori = KategoriFasilitasModel::factory()->create();
        $gedung = GedungModel::factory()->create();

        $data = [
            'nama' => 'AC',
            'id_kategori' => $kategori->id_kategori,
            'lokasi' => 'RPL 1',
            'id_gedung' => $gedung->id_gedung,
            'status' => 'berfungsi'
        ];

        $response = $this->actingAs($user)->postJson('/fasilitas/store', $data);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Data berhasil disimpan.',
                'redirect' => url('/fasilitas')
            ]);

        $this->assertDatabaseHas('m_fasilitas', $data);
    }

    /** @test */
    public function validasi_store_gagal_jika_field_kosong()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/fasilitas/store', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['nama', 'id_kategori', 'lokasi', 'id_gedung', 'status']);
    }

    /** @test */
    public function user_dapat_melihat_detail_fasilitas()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();

        $kategori = KategoriFasilitasModel::factory()->create();
        $gedung = GedungModel::factory()->create();

        $fasilitas = FasilitasModel::factory()->create([
            'id_kategori' => $kategori->id_kategori,
            'id_gedung' => $gedung->id_gedung,
        ]);

        $response = $this->actingAs($user)->get("/fasilitas/{$fasilitas->id_fasilitas}/show");

        $response->assertStatus(200);
        $response->assertViewIs('fasilitas.show');
        $response->assertViewHas('fasilitas');
    }


    /** @test */
    public function user_dapat_melihat_halaman_edit()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();

        $kategori = KategoriFasilitasModel::factory()->create();
        $gedung = GedungModel::factory()->create();

        $fasilitas = FasilitasModel::factory()->create([
            'id_kategori' => $kategori->id_kategori,
            'id_gedung' => $gedung->id_gedung,
        ]);

        $response = $this->actingAs($user)->get("/fasilitas/{$fasilitas->id_fasilitas}/edit");

        $response->assertStatus(200)
            ->assertViewIs('fasilitas.edit')
            ->assertViewHas('fasilitas');
    }

    /** @test */
    public function user_dapat_update_fasilitas()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();

        $kategoriAwal = KategoriFasilitasModel::factory()->create();
        $gedungAwal = GedungModel::factory()->create();

        $fasilitas = FasilitasModel::factory()->create([
            'id_kategori' => $kategoriAwal->id_kategori,
            'id_gedung' => $gedungAwal->id_gedung,
        ]);

        $data = [
            'nama' => 'AC Updated',
            'id_kategori' => $kategoriAwal->id_kategori,
            'lokasi' => 'RPL 2',
            'id_gedung' => $gedungAwal->id_gedung,
            'status' => 'berfungsi'
        ];

        $response = $this->actingAs($user)->putJson("/fasilitas/{$fasilitas->id_fasilitas}/update", $data);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Data berhasil Diupdate.',
                'redirect' => url('/fasilitas')
            ]);

        $this->assertDatabaseHas('m_fasilitas', [
            'id_fasilitas' => $fasilitas->id_fasilitas,
            'nama' => 'AC Updated'
        ]);
    }


    /** @test */
    public function validasi_update_gagal_jika_field_kosong()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();

        $kategori = KategoriFasilitasModel::factory()->create();
        $gedung = GedungModel::factory()->create();

        $fasilitas = FasilitasModel::factory()->create([
            'id_kategori' => $kategori->id_kategori,
            'id_gedung' => $gedung->id_gedung,
        ]);

        $response = $this->actingAs($user)->putJson("/fasilitas/{$fasilitas->id_fasilitas}/update", []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['nama', 'id_kategori', 'lokasi', 'id_gedung', 'status']);
    }

    /** @test */
    public function user_dapat_melihat_halaman_confirm()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();

        $kategori = KategoriFasilitasModel::factory()->create();
        $gedung = GedungModel::factory()->create();

        $fasilitas = FasilitasModel::factory()->create([
            'id_kategori' => $kategori->id_kategori,
            'id_gedung' => $gedung->id_gedung,
        ]);

        $response = $this->actingAs($user)->get("/fasilitas/{$fasilitas->id_fasilitas}/confirm");

        $response->assertStatus(200)
            ->assertViewIs('fasilitas.confirm')
            ->assertViewHas('fasilitas');
    }

    /** @test */
    public function user_dapat_delete_fasilitas()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();

        $kategori = KategoriFasilitasModel::factory()->create();
        $gedung = GedungModel::factory()->create();

        $fasilitas = FasilitasModel::factory()->create([
            'id_kategori' => $kategori->id_kategori,
            'id_gedung' => $gedung->id_gedung,
        ]);

        $response = $this->actingAs($user)->deleteJson("/fasilitas/{$fasilitas->id_fasilitas}/delete");

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Data berhasil Dihapus.',
                'redirect' => url('/fasilitas')
            ]);

        $this->assertDatabaseMissing('m_fasilitas', [
            'id_fasilitas' => $fasilitas->id_fasilitas,
            'nama' => 'fasilitas Genap 2025',
        ]);
    }
}
