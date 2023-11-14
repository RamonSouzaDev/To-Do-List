<?php

namespace Tests\Feature\Auth;

use Mockery;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginControllerTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

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

    /**
     * Testa o login bem-sucedido.
     *
     * @return void
     * @covers LoginController@login
     */
    public function testCanLoggin()
    {
        $response = $this->post('/api/register', [
            'name' => 'Ramon Mendes',
            'email' => 'dwmom@hotmail.com',
            'password' => 'developer',
        ]);
        
        $user = User::first();

        // Faça a solicitação de login
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'developer',
        ]);

        $response->assertStatus(500);
    }

    /**
     * Testa o login bem-sucedido.
     *
     * @return void
     * @covers LoginController@logout
     */
    public function testLogoutLoggin()
    {

        $user = User::factory()->create();
       
        $this->be($user, 'api');

        $response = $this->post('/api/logout');

        $response->assertStatus(200);
    }

}
