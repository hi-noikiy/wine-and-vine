<?php

namespace Tests\Feature;

use App\{
    RatingVisibility
};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Countries\Package\Countries;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /** @test */
    public function a_user_is_not_registered_if_validation_fails()
    {
        $this->post(route('register'), [])
            ->assertSessionHasErrors([
                'first-name',
                'last-name',
                'email',
                'password',
                'country',
                'rating-visibility',
                'newsletter',
                'email-offers',
            ]);
    }

    /** @test */
    public function validation_fails_if_the_users_dont_respect_name_validation()
    {
        $this->post(route('register'), $this->validForm([
            'first-name' => str_repeat('a', 26)
        ]))->assertSessionHasErrors(['first-name']);

        $this->post(route('register'), $this->validForm([
            'last-name' => str_repeat('b', 26)
        ]))->assertSessionHasErrors(['last-name']);
    }

    /** @test */
    public function a_user_is_not_created_if_the_country_value_is_bigger_than_two()
    {
        $this->post(route('register'), $this->validForm(['country' => 'FakeCountry']))
            ->assertSessionHasErrors(['country']);

        $this->post(route('register'), $this->validForm(['country' => 'Portugal']))
            ->assertSessionMissing(['country']);
    }

    /** @test */
    public function a_username_is_not_repeated_even_when_there_are_two_users_with_the_same_name()
    {
        $this->post('/register', $this->validForm([
            'email' => 'email@example.com'
        ]))->assertStatus(302)
            ->assertHeader('Location', url('home'));

        Auth::logout();

        $this->post('/register', $this->validForm(['email' => 'another_email@example.com']))->assertStatus(302)
            ->assertHeader('Location', url('home'));

        $this->assertDatabaseHas('users', ['username' => 'john_doe']);
        $this->assertDatabaseHas('users', ['username' => 'john_doe_1']);
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
            "first-name" => "John",
            "last-name" => "Doe",
            "email" => "john@example.com",
            "password" => "secret",
            "password_confirmation" => "secret",
            "country" => Countries::all()->random()->name->common,
            "rating-visibility" => factory(RatingVisibility::class)->create()->id,
            "newsletter" => "1",
            "email-offers" => "1"
        ], $overrides);
    }
}
