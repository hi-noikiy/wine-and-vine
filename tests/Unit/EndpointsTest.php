<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EndpointsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anyone_can_load_welcome_page()
    {
        $response = $this->get(route('welcome'));

        $response->assertStatus(200);

        $response->assertViewIs('pages.welcome');
    }

    /** @test */
    public function anyone_can_load_browse_wines_page()
    {
        $response = $this->get(route('wines.index'));

        $response->assertStatus(200);

        $response->assertViewIs('pages.wines.index');
    }

    /** @test */
    public function an_authenticated_user_cant_load_the_register_page_and_is_redirected_to_the_welcome_page()
    {
        $anAuthenticatedUser = make(User::class);

        $this->actingAs($anAuthenticatedUser);

        $this->get(route('register'))
            ->assertStatus(302)
            ->assertRedirect(route('welcome'));
    }

    /** @test */
    public function a_guest_can_load_the_login_page()
    {
        $this->get(route('login'))
            ->assertStatus(200)
            ->assertViewIs('auth.login');
    }

    /** @test */
    public function a_guest_can_load_the_register_page()
    {
        $this->get(route('register'))
            ->assertStatus(200)
            ->assertViewIs('auth.register');
    }
}
