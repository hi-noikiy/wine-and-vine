<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /** @test */
    public function a_username_is_not_repeated_even_when_there_are_two_users_with_the_same_name()
    {
        $this->post('register', $this->validForm())
            ->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'username' => 'john_doe'
        ]);

        $this->post('register', $this->validForm([
            'email' => 'another_email@example.com'
        ]))->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'username' => 'john_doe_1',
        ]);

        $this->post('register', $this->validForm([
            'email' => 'even_another_email@example.com'
        ]))->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'username' => 'john_doe_2',
        ]);
    }

    /**
     * Returns the payload to post from the register form.
     * Fields can be override by the $overrides parameter.
     *
     * @param array $overrides
     * @return array
     */
    public function validForm(array $overrides = []): array
    {
        return array_merge([
            "firstname" => "John",
            "lastname" => "Doe",
            "email" => "john@example.com",
            "password" => "secret",
            "password_confirmation" => "secret",
            "country" => "Portugal",
            "rating-visibility" => "1",
            "newsletter" => "1",
            "email-offers" => "1"
        ], $overrides);
    }
}
