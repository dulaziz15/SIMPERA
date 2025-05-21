<?php

namespace Tests\Feature;

use App\Models\PeranModel;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function guest_dapat_melihat_halaman_login()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function user_yang_sudah_login_diarahkan_ke_home()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/');
    }

    /** @test */
    public function user_dapat_login_dengan_credential_yang_benar()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $hash_kata_sandi = '12345';
        $user = User::factory()->create([
            'surel' => 'user_test',
            'hash_kata_sandi' => $hash_kata_sandi,
        ]);

        $response = $this->postJson('/login', [
            'surel' => 'user_test',
            'hash_kata_sandi' => $hash_kata_sandi
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Login Berhasil',
                'redirect' => url('/')
            ]);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function login_gagal_jika_credential_salah()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        User::factory()->create([
            'surel' => 'user_test',
            'hash_kata_sandi' => bcrypt('correct_hash_kata_sandi'),
        ]);

        $response = $this->postJson('/login', [
            'surel' => 'user_test',
            'hash_kata_sandi' => 'wrong_hash_kata_sandi',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Login Berhasil',
                'redirect' => url('/')
            ]);

        $this->assertGuest();
    }

    /** @test */
    public function user_dapat_logout_dan_di_redirect_ke_login()
    {
        PeranModel::factory()->create(['id_peran' => 1]);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/logout');

        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
