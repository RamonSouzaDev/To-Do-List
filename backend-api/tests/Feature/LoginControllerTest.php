<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Testa o login com senhas incorretas.
     *
     * @return void
     * @covers LoginController@login
     */
    public function testCannotLoginWithInvalidPassword()
    {
        $user = User::factory()->create();

        $data = [
            'email' => $user->email,
            'password' => 'wrong_password',
        ];

        $response = $this->post('/api/login', $data);

        $response->assertStatus(401);

    }
}
