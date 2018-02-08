<?php

namespace Tests\Unit;

use Tests\TestCase;

class EndpointsTest extends TestCase
{
    /** @test */
    public function anyone_can_load_welcome_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertViewIs('pages.welcome');
    }

    /** @test */
    public function anyone_can_load_browsing_wines_page() {
        $response = $this->get('explore');

        $response->assertStatus(200);

        $response->assertViewIs('pages.explore');
    }

    /** @test */
    public function an_authenticated_user_cant_load_the_login_page_and_is_redirected_home() {
        $anAuthenticatedUser = factory('App\User')->make();

        $this->actingAs($anAuthenticatedUser);

        $response = $this->get('login');

        $response->assertStatus(302);

        $response->assertRedirect('home');
    }

    /** @test */
    public function an_authenticated_user_cant_load_the_register_page_and_is_redirected_home() {
        $anAuthenticatedUser = factory('App\User')->make();

        $this->actingAs($anAuthenticatedUser);

        $response = $this->get('register');

        $response->assertStatus(302);

        $response->assertRedirect('home');
    }

    /** @test */
    public function a_guest_can_load_the_login_page() {
        $response = $this->get('login');

        $response->assertStatus(200);

        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function a_guest_can_load_the_register_page() {
        $response = $this->get('register');

        $response->assertStatus(200);

        $response->assertViewIs('auth.register');
    }
}
