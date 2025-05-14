<?php

namespace Tests\Feature;

use App\Models\KategoriFasilitasModel;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KategoriControllerTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     */
    /** @test */
    public function user_dapat_melihat_halaman_index()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/kategori');

        $response->assertStatus(200);
        $response->assertViewIs('kategori.index');
    }

    /** @test */
    public function user_dapat_melihat_halaman_create()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/kategori/create');

        $response->assertStatus(200);
        $response->assertViewIs('kategori.create');
    }

    /** @test */
    public function user_dapat_menyimpan_kategori_baru()
    {
        $user = User::factory()->create();

        $data = [
            'kode' => 'Pendukung',
            'nama' => 'Papan tulis'
        ];

        $response = $this->actingAs($user)->postJson('/kategori/store', $data);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Data berhasil disimpan.',
                'redirect' => url('/kategori')
            ]);

        $this->assertDatabaseHas('kategori_fasilitas', $data);
    }

    /** @test */
    public function validasi_store_gagal_jika_field_kosong()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/kategori/store', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['kode', 'nama']);
    }

    /** @test */
    public function user_dapat_melihat_detail_kategori()
    {
        $user = User::factory()->create();
        $kategori = KategoriFasilitasModel::factory()->create();

        $response = $this->actingAs($user)->get("/kategori/{$kategori->id}");

        $response->assertStatus(200);
    }

    /** @test */
    public function user_dapat_melihat_halaman_edit()
    {
        $user = User::factory()->create();
        $kategori = KategoriFasilitasModel::factory()->create();

        $response = $this->actingAs($user)->get("/kategori/{$kategori->id_kategori}/edit");

        $response->assertStatus(200)
            ->assertViewIs('kategori.edit')
            ->assertViewHas('kategori');
    }

    /** @test */
    public function user_dapat_update_kategori()
    {
        $user = User::factory()->create();
        $kategori = KategoriFasilitasModel::factory()->create();

        $data = [
            'kode' => 'Pendukung',
            'nama' => 'Papan tulis'
        ];

        $response = $this->actingAs($user)->putJson("/kategori/{$kategori->id_kategori}/update", $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('kategori_fasilitas', [
            'id_kategori' => $kategori->id_kategori,
            'nama' => 'Papan tulis'
        ]);
    }

    /** @test */
    public function validasi_update_gagal_jika_field_kosong()
    {
        $user = User::factory()->create();
        $kategori = KategoriFasilitasModel::factory()->create();

        $response = $this->actingAs(user: $user)->putJson("/kategori/{$kategori->id_kategori}/update", []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['kode', 'nama']);
    }

    /** @test */
    public function user_dapat_melihat_halaman_confirm()
    {
        $user = User::factory()->create();
        $kategori = KategoriFasilitasModel::factory()->create();

        $response = $this->actingAs($user)->get("/kategori/{$kategori->id_kategori}/confirm");

        $response->assertStatus(200)
            ->assertViewIs('kategori.confirm')
            ->assertViewHas('kategori');
    }

    /** @test */
    public function user_dapat_delete_kategori()
    {
        $user = User::factory()->create();
        $kategori = KategoriFasilitasModel::factory()->create([
            'nama' => 'Penunjang'
        ]);

        $response = $this->actingAs($user)->deleteJson("/kategori/{$kategori->id_kategori}/delete");

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Data berhasil Dihapus.',
                'redirect' => url('/kategori')
            ]);

        $this->assertDatabaseMissing('kategori_fasilitas', [
            'id_kategori' => $kategori->id_kategori
        ]);
    }
}
