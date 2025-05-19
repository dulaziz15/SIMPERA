<?php

namespace Tests\Feature;

use App\Models\GedungModel;
use App\Models\PeranModel;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GedungControllerTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     */
    /** @test */
    public function user_dapat_melihat_halaman_index()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/gedung');

        $response->assertStatus(200);
        $response->assertViewIs('gedung.index');
    }

    /** @test */
    public function user_dapat_melihat_halaman_create()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/gedung/create');

        $response->assertStatus(200);
        $response->assertViewIs('gedung.create');
    }

    /** @test */
    public function user_dapat_menyimpan_gedung_baru()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();

        $data = [
            'kode' => 'AX',
            'nama' => 'Gedung AX',
            'deskripsi' => 'Parkiran dan Kantin',
        ];

        $response = $this->actingAs($user)->postJson('/gedung/store', $data);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Data berhasil disimpan.',
                'redirect' => url('/gedung')
            ]);

        $this->assertDatabaseHas('m_gedung', $data);
    }

    /** @test */
    public function validasi_store_gagal_jika_field_kosong()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/gedung/store', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['kode', 'nama', 'deskripsi']);
    }

    /** @test */
    public function user_dapat_melihat_detail_gedung()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $gedung = GedungModel::factory()->create();

        $response = $this->actingAs($user)->get("/gedung/{$gedung->id}");

        $response->assertStatus(200);
    }

    /** @test */
    public function user_dapat_melihat_halaman_edit()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $gedung = GedungModel::factory()->create();

        $response = $this->actingAs($user)->get("/gedung/{$gedung->id_gedung}/edit");

        $response->assertStatus(200)
            ->assertViewIs('gedung.edit')
            ->assertViewHas('gedung');
    }

    /** @test */
    public function user_dapat_update_gedung()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $gedung = GedungModel::factory()->create();

        $data = [
            'kode' => 'AX',
            'nama' => 'Gedung AX',
            'deskripsi' => 'Parkiran dan Kantin',
        ];

        $response = $this->actingAs($user)->putJson("/gedung/{$gedung->id_gedung}/update", $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('m_gedung', [
            'id_gedung' => $gedung->id_gedung,
            'nama' => 'gedung AX'
        ]);
    }

    /** @test */
    public function validasi_update_gagal_jika_field_kosong()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $gedung = GedungModel::factory()->create();

        $response = $this->actingAs(user: $user)->putJson("/gedung/{$gedung->id_gedung}/update", []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['kode', 'nama', 'deskripsi']);
    }

    /** @test */
    public function user_dapat_melihat_halaman_confirm()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $gedung = GedungModel::factory()->create();

        $response = $this->actingAs($user)->get("/gedung/{$gedung->id_gedung}/confirm");

        $response->assertStatus(200)
            ->assertViewIs('gedung.confirm')
            ->assertViewHas('gedung');
    }

    /** @test */
    public function user_dapat_delete_gedung()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $gedung = GedungModel::factory()->create([
            'nama' => 'gedung Genap 2025'
        ]);

        $response = $this->actingAs($user)->deleteJson("/gedung/{$gedung->id_gedung}/delete");

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Data berhasil Dihapus.',
                'redirect' => url('/gedung')
            ]);

        $this->assertDatabaseMissing('gedung', [
            'id_gedung' => $gedung->id_gedung
        ]);
    }
}
