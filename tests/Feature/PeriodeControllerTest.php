<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\PeriodeModel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PeriodeControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function user_dapat_melihat_halaman_index()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/periode');

        $response->assertStatus(200);
        $response->assertViewIs('periode.index');
    }

    /** @test */
    public function user_dapat_melihat_halaman_create()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/periode/create');

        $response->assertStatus(200);
        $response->assertViewIs('periode.create');
    }

    /** @test */
    public function user_dapat_menyimpan_periode_baru()
    {
        $user = User::factory()->create();

        $data = [
            'nama' => 'Periode Ganjil 2025',
            'tanggal_mulai' => '2025-08-01',
            'tanggal_selesai' => '2025-12-31',
        ];

        $response = $this->actingAs($user)->postJson('/periode/store', $data);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Data berhasil disimpan.',
                'redirect' => url('/periode')
            ]);

        $this->assertDatabaseHas('periode', $data);
    }

    /** @test */
    public function validasi_store_gagal_jika_field_kosong()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/periode/store', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['nama', 'tanggal_mulai', 'tanggal_selesai']);
    }

    /** @test */
    public function user_dapat_melihat_detail_periode()
    {
        $user = User::factory()->create();
        $periode = PeriodeModel::factory()->create();

        $response = $this->actingAs($user)->get("/periode/{$periode->id}");

        $response->assertStatus(200);
    }

    /** @test */
    public function user_dapat_melihat_halaman_edit()
    {
        $user = User::factory()->create();
        $periode = PeriodeModel::factory()->create();

        $response = $this->actingAs($user)->get("/periode/{$periode->id_periode}/edit");

        $response->assertStatus(200)
            ->assertViewIs('periode.edit')
            ->assertViewHas('periode');
    }

    /** @test */
    public function user_dapat_update_periode()
    {
        $user = User::factory()->create();
        $periode = PeriodeModel::factory()->create();

        $data = [
            'nama' => 'Periode Genap 2025',
            'tanggal_mulai' => '2025-01-01',
            'tanggal_selesai' => '2025-06-30',
        ];

        $response = $this->actingAs($user)->putJson("/periode/{$periode->id_periode}/update", $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('periode', [
            'id_periode' => $periode->id_periode,
            'nama' => 'Periode Genap 2025'
        ]);
    }

    /** @test */
    public function validasi_update_gagal_jika_field_kosong()
    {
        $user = User::factory()->create();
        $periode = PeriodeModel::factory()->create();

        $response = $this->actingAs(user: $user)->putJson("/periode/{$periode->id_periode}/update", []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['nama', 'tanggal_mulai', 'tanggal_selesai']);
    }
}
