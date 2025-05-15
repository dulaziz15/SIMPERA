<?php

namespace Tests\Feature;

use App\Models\Peran;
use App\Models\PeranModel;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogActivityControllerTest extends TestCase
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
        $response = $this->actingAs($user)->get('/log');

        $response->assertStatus(200);
        $response->assertViewIs('log.index');
    }

    /** @test */
    public function test_user_dapat_menyimpan_log_baru()
    {
        // Buat peran dulu
        PeranModel::factory()->create(['id_peran' => 1]);

        // Buat user dengan peran tersebut
        $user = User::factory()->create(['id_peran' => 1]);

        $data = [
            'id_pengguna' => $user->id_pengguna,
            'jenis_aktivitas' => 'Login',
            'deskripsi' => 'Login System',
            'waktu' => now()->format('Y-m-d H:i:s'),
        ];

        $response = $this->actingAs($user)->postJson('/log/store', $data);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Log berhasil disimpan.',
            ]);

        $this->assertDatabaseHas('m_log_aktivitas', [
            'id_pengguna' => $user->id_pengguna,
            'jenis_aktivitas' => 'Login',
            'deskripsi' => 'Login System',
        ]);
    }



    /** @test */
    public function user_dapat_melihat_detail_log()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();
        $log = PeranModel::factory()->create();

        $response = $this->actingAs($user)->get("/log/{$log->id}");

        $response->assertStatus(200);
    }
}
