<?php

namespace Tests\Feature;

use App\Models\PeranModel;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function pengguna_dapat_melihat_halaman_index()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $pengguna = User::factory()->create();

        $response = $this->actingAs($pengguna)->get('/user');

        $response->assertStatus(200);
        $response->assertViewIs('user.index');
    }

    /** @test */
    public function pengguna_dapat_melihat_halaman_create()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $pengguna = User::factory()->create();

        $response = $this->actingAs($pengguna)->get('/user/create');

        $response->assertStatus(200);
        $response->assertViewIs('user.create');
    }

    /** @test */
    public function pengguna_dapat_menyimpan_pengguna_baru()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $pengguna = User::factory()->create();

        $data = [
            'nama_pengguna' => 'andi123',
            'hash_kata_sandi' => 'password',
            'id_peran' => 1,
            'surel' => 'andi@example.com',
            'nama_lengkap' => 'Andi Setiawan'
        ];

        $response = $this->actingAs($pengguna)->postJson('/user/store', $data);

        $response->assertStatus(200)
                 ->assertJson([
                    'status' => true,
                    'message' => 'Data berhasil disimpan.',
                    'redirect' => url('/user')
                 ]);

        $this->assertDatabaseHas('m_user', [
            'nama_pengguna' => 'andi123',
            'surel' => 'andi@example.com'
        ]);
    }

    /** @test */
    public function validasi_store_gagal_jika_field_kosong()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $pengguna = User::factory()->create();

        $response = $this->actingAs($pengguna)->postJson('/user/store', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['nama_pengguna', 'hash_kata_sandi', 'id_peran', 'surel', 'nama_lengkap']);
    }

    /** @test */
    public function pengguna_dapat_melihat_detail_pengguna()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $pengguna = User::factory()->create();
        $target = User::factory()->create();

        $response = $this->actingAs($pengguna)->get("/user/{$target->id_pengguna}");

        $response->assertStatus(200);
    }

    /** @test */
    public function pengguna_dapat_melihat_halaman_edit()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $pengguna = User::factory()->create();
        $target = User::factory()->create();

        $response = $this->actingAs($pengguna)->get("/user/{$target->id_pengguna}/edit");

        $response->assertStatus(200)
                 ->assertViewIs('user.edit')
                 ->assertViewHas('user');
    }

    /** @test */
    public function pengguna_dapat_update_data_pengguna()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $pengguna = User::factory()->create();
        $target = User::factory()->create();

        $data = [
            'nama_pengguna' => 'budi456',
            'hash_kata_sandi' => bcrypt('newpass'),
            'id_peran' => 1,
            'surel' => 'budi@example.com',
            'nama_lengkap' => 'Budi Santoso'
        ];

        $response = $this->actingAs($pengguna)->putJson("/user/{$target->id_pengguna}/update", $data);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'message' => 'Data berhasil Diupdate.',
                     'redirect' => url('/user')
                 ]);

        $this->assertDatabaseHas('m_user', [
            'id_pengguna' => $target->id_pengguna,
            'nama_pengguna' => 'budi456'
        ]);
    }

    /** @test */
    public function validasi_update_gagal_jika_field_kosong()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $pengguna = User::factory()->create();
        $target = User::factory()->create();

        $response = $this->actingAs($pengguna)->putJson("/user/{$target->id_pengguna}/update", []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['nama_pengguna', 'hash_kata_sandi', 'id_peran', 'surel', 'nama_lengkap']);
    }

    /** @test */
    public function pengguna_dapat_melihat_halaman_konfirmasi_hapus()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $pengguna = User::factory()->create();
        $target = User::factory()->create();

        $response = $this->actingAs($pengguna)->get("/user/{$target->id_pengguna}/confirm");

        $response->assertStatus(200)
                 ->assertViewIs('user.confirm')
                 ->assertViewHas('user');
    }

    /** @test */
    public function pengguna_dapat_menghapus_data_pengguna()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $pengguna = User::factory()->create();
        $target = User::factory()->create([
            'nama_pengguna' => 'hapusini'
        ]);

        $response = $this->actingAs($pengguna)->deleteJson("/user/{$target->id_pengguna}/delete");

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'message' => 'Data berhasil Dihapus.',
                     'redirect' => url('/user')
                 ]);

        $this->assertDatabaseMissing('m_user', [
            'id_pengguna' => $target->id_pengguna
        ]);
    }
}
