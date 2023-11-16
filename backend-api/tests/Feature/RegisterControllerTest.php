<?php

namespace Tests\Browser;

use Tests\TestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Testa o registro de usuários.
     *
     * @return void
     * @covers RegisterController@store
     */
    public function testUserRegistration()
    {
        $data = [
            'name' => 'Ramon',
            'email' => 'teste@email.com',
            'password' => 'password',
        ];

        $response = $this->post('/api/register', $data);

        $response->assertStatus(200);

    }
}
