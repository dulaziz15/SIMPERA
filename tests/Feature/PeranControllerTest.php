<?php

namespace Tests\Feature;

use App\Models\PeranModel;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PeranControllerTest extends TestCase
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
        $response = $this->actingAs($user)->get('/peran');

        $response->assertStatus(200);
        $response->assertViewIs('peran.index');
    }

    /** @test */
    public function user_dapat_melihat_halaman_create()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/peran/create');

        $response->assertStatus(200);
        $response->assertViewIs('peran.create');
    }

    /** @test */
    public function user_dapat_menyimpan_peran_baru()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();

        $data = [
            'kode_peran' => 'ADM',
            'nama' => 'Admin'
        ];

        $response = $this->actingAs($user)->postJson('/peran/store', $data);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Data berhasil disimpan.',
                'redirect' => url('/peran')
            ]);

        $this->assertDatabaseHas('m_peran', $data);
    }

    /** @test */
    public function validasi_store_gagal_jika_field_kosong()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/peran/store', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['kode_peran', 'nama']);
    }

    /** @test */
    public function user_dapat_melihat_detail_peran()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $peran = PeranModel::factory()->create();

        $response = $this->actingAs($user)->get("/peran/{$peran->id}");

        $response->assertStatus(200);
    }

    /** @test */
    public function user_dapat_melihat_halaman_edit()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $peran = PeranModel::factory()->create();

        $response = $this->actingAs($user)->get("/peran/{$peran->id_peran}/edit");

        $response->assertStatus(200)
            ->assertViewIs('peran.edit')
            ->assertViewHas('peran');
    }

    /** @test */
    public function user_dapat_update_peran()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $peran = PeranModel::factory()->create();

        $data = [
            'kode_peran' => 'ADM',
            'nama' => 'Admin'
        ];

        $response = $this->actingAs($user)->putJson("/peran/{$peran->id_peran}/update", $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('m_peran', [
            'id_peran' => $peran->id_peran,
            'nama' => 'Admin'
        ]);
    }

    /** @test */
    public function validasi_update_gagal_jika_field_kosong()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $peran = PeranModel::factory()->create();

        $response = $this->actingAs(user: $user)->putJson("/peran/{$peran->id_peran}/update", []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['kode_peran', 'nama']);
    }

    /** @test */
    public function user_dapat_melihat_halaman_confirm()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $peran = PeranModel::factory()->create();

        $response = $this->actingAs($user)->get("/peran/{$peran->id_peran}/confirm");

        $response->assertStatus(200)
            ->assertViewIs('peran.confirm')
            ->assertViewHas('peran');
    }

    /** @test */
    public function user_dapat_delete_peran()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $peran = PeranModel::factory()->create([
            'nama' => 'Penunjang'
        ]);

        $response = $this->actingAs($user)->deleteJson("/peran/{$peran->id_peran}/delete");

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Data berhasil Dihapus.',
                'redirect' => url('/peran')
            ]);

        $this->assertDatabaseMissing('m_peran', [
            'id_peran' => $peran->id_peran
        ]);
    }
}
