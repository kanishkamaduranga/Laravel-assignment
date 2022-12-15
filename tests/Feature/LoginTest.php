<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_page_render()
    {
        $response = $this->get('/login');
       // $response->assertStatus(200); //TODO need to recheck
    }

    public function test_web_users_can_auth()
    {
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        //dd($user->password);
        $this->assertAuthenticated();
        $response->assertRedirect(route('home'));
    }

     public function test_user_can_login_with_empty_email(){

        $user = User::factory()->create();

        $response = $this->post('/login' , [
            'email' => '',
            'password' => 'password',
        ]);

        $response->assertStatus(302)->assertSessionHasErrors('email');
        $response->assertStatus(302);

        $this->withoutMiddleware()->assertGuest();
    }
}
