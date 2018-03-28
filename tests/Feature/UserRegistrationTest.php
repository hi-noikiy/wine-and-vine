<?php

namespace Tests\Feature;

use App\User;
use App\Country;
use Tests\TestCase;
use App\RatingVisibility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_can_register_an_account()
    {
        // Register a user
        $response = $this->post(route('register'), $this->validForm([
            'country' => ($country = factory(Country::class)->create())->id,
            'rating-visibility' => ($rating = factory(RatingVisibility::class)->create())->id
        ]));
        // Assert that there are no errors on session
        $response->assertSessionMissing([
            'first-name', 'last-name', 'email', 'password', 'country', 'rating-visibility', 'newsletter', 'email-offers'
        ]);
        // Assert that the user is redirected /home
        $response->assertRedirect(route('welcome'));
        // Assert that the user is logged in
        $this->assertTrue(Auth::check());
        // Assert that the user was created
        $this->assertCount(1, User::all());
        // Assert the values on the database are correct
        tap(User::first(), function ($user) use ($country, $rating) {
            $this->assertEquals('John', $user->first_name);
            $this->assertEquals('Doe', $user->last_name);
            $this->assertEquals('john_doe', $user->username);
            $this->assertEquals('john@example.com', $user->email);
            $this->assertEquals($country->id, $user->country_id);
            $this->assertEquals($rating->id, $user->rating_visibility_id);
            $this->assertEquals($rating->id, $user->rating_visibility_id);
            $this->assertEquals(1, $user->newsletter);
            $this->assertEquals(1, $user->email_offers);
            $this->assertTrue(Hash::check('secret', $user->password));
        });
    }

    /** @test */
    public function a_user_is_not_registered_if_validation_fails()
    {
        // Enable exception handling so laravel catches the error and redirect back
        $this->withExceptionHandling();
        // Simulate that the user was on /register page
        $this->from(route('register'));
        // Post the data with empty data
        $response = $this->post(route('register'), []);
        // Assert that the user is redirected back
        $response->assertRedirect(route('register'));
        // Assert that there is an error on session
        $response->assertSessionHasErrors([
            'first-name', 'last-name', 'email', 'password', 'country', 'rating-visibility', 'newsletter', 'email-offers'
        ]);
        // Assert that the user is not logged in
        $this->assertFalse(Auth::check());
        // Assert that the database has no users
        $this->assertCount(0, User::all());
    }

    /** @test */
    public function first_name_cannot_exceed_25_chars()
    {
        // Enable exception handling so laravel catches the error and redirect back
        $this->withExceptionHandling();
        // Simulate that the user was on /register page
        $this->from(route('register'));
        // Post the data with a first name breaking validation
        $response = $this->post(route('register'), $this->validForm([
            'first-name' => str_repeat('a', 26)
        ]));
        // Assert that the user is redirected back
        $response->assertRedirect(route('register'));
        // Assert that there is an error on session
        $response->assertSessionHasErrors('first-name');
        // Assert that the user is not logged in
        $this->assertFalse(Auth::check());
        // Assert that the database has no users
        $this->assertCount(0, User::all());
    }

    /** @test */
    public function last_name_cannot_exceed_25_chars()
    {
        // Enable exception handling so laravel catches the error and redirect back
        $this->withExceptionHandling();
        // Simulate that the user was on /register page
        $this->from(route('register'));
        // Create a user instance
        $response = $this->post(route('register'), $this->validForm([
            'last-name' => str_repeat('a', 26)
        ]));
        // Assert that the user is redirected back
        $response->assertRedirect(route('register'));
        // Assert that there is an error on session
        $response->assertSessionHasErrors('last-name');
        // Assert that the user is not logged in
        $this->assertFalse(Auth::check());
        // Assert that the database has no users
        $this->assertCount(0, User::all());
    }

    /** @test */
    public function email_must_be_unique()
    {
        // Enable exception handling so laravel catches the error and redirect back
        $this->withExceptionHandling();
        // Persist a user to the database with a specific email
        create(User::class, ['email' => 'example@example.com']);
        // Simulate that the user was on /register page
        $this->from(route('register'));
        // Post the data with a taken email, breaking validation
        $response = $this->post(route('register'), $this->validForm([
            'email' => 'example@example.com'
        ]));
        // Assert that the user is redirected back
        $response->assertRedirect(route('register'));
        // Assert that there is an error on session
        $response->assertSessionHasErrors('email');
        // Assert that the user is not logged in
        $this->assertFalse(Auth::check());
        // Assert that the database has only one user
        $this->assertCount(1, User::all());
    }

    /** @test */
    public function password_and_its_confirmation_must_match()
    {
        // Enable exception handling so laravel catches the error and redirect back
        $this->withExceptionHandling();
        // Simulate that the user was on /register page
        $this->from(route('register'));
        // Post the data with a mismatched passwords, breaking validation
        $response = $this->post(route('register'), $this->validForm([
            'password' => 'secret',
            'password_confirmation' => 'another-secret'
        ]));
        // Assert that the user is redirected back
        $response->assertRedirect(route('register'));
        // Assert that there is an error on session
        $response->assertSessionHasErrors('password');
        // Assert that the user is not logged in
        $this->assertFalse(Auth::check());
        // Assert that the database has no users
        $this->assertCount(0, User::all());
    }

    /** @test */
    public function a_country_is_required_and_must_exist_on_countries_table()
    {
        // Enable exception handling so laravel catches the error and redirect back
        $this->withExceptionHandling();
        // Simulate that the user was on /register page
        $this->from(route('register'));
        // This country does not exist on countries table, thus breaks validation
        $data = $this->validForm(['country' => 555]);
        // Post the data with a country that does exist
        $response = $this->post(route('register'), $data);
        // Assert that the user is redirected /home
        $response->assertRedirect(route('register'));
        // Assert that there are no errors on session
        $response->assertSessionHasErrors('country');
        // Assert that the user is logged in
        $this->assertFalse(Auth::check());
        // Assert that the database has no users
        $this->assertCount(0, User::all());
        // Assert that the error message matches
        $this->assertEquals('The selected country is invalid.', Session::get('errors')->first());
    }

    /** @test */
    public function a_rating_visibility_is_required_and_must_exist_on_ratings_table()
    {
        // Enable exception handling so laravel catches the error and redirect back
        $this->withExceptionHandling();
        // Simulate that the user was on /register page
        $this->from(route('register'));
        // This Rating does not exist on rating_visibilities table, thus breaks validation
        $data = $this->validForm(['rating-visibility' => 2]);
        // Post the data with a country that does exist
        $response = $this->post(route('register'), $data);
        // Assert that the user is redirected /home
        $response->assertRedirect(route('register'));
        // Assert that there are no errors on session
        $response->assertSessionHasErrors('rating-visibility');
        // Assert that the user is logged in
        $this->assertFalse(Auth::check());
        // Assert that the database has no users
        $this->assertCount(0, User::all());
        // Assert that the error message matches
        $this->assertEquals('The selected rating-visibility is invalid.', Session::get('errors')->first());
    }

    /** @test */
    public function a_newsletter_is_required_and_must_be_a_boolean()
    {
        // Enable exception handling so laravel catches the error and redirect back
        $this->withExceptionHandling();
        // Simulate that the user was on /register page
        $this->from(route('register'));
        // This newsletter value is invalid, thus breaks validation
        $data = $this->validForm(['newsletter' => 2]);
        // Post the data with a country that does exist
        $response = $this->post(route('register'), $data);
        // Assert that the user is redirected /home
        $response->assertRedirect(route('register'));
        // Assert that there are no errors on session
        $response->assertSessionHasErrors('newsletter');
        // Assert that the user is logged in
        $this->assertFalse(Auth::check());
        // Assert that the database has no users
        $this->assertCount(0, User::all());
        // Assert that the error message matches
        $this->assertEquals('The newsletter field must be true or false.', Session::get('errors')->first());
    }

    /** @test */
    public function a_username_is_not_repeated_even_when_there_are_two_users_with_the_same_name()
    {
        // Register a John Doe user with a default email
        $this->post(route('register'), $this->validForm());
        // Assert that the user was created
        $this->assertCount(1, User::all());
        // logout the current user
        Auth::logout();
        // Register another John Doe with different email
        $this->post(route('register'), $this->validForm(['email' => 'foo@bar.com']));
        // Assert that the user was created
        $this->assertCount(2, User::all());
        // Assert that their username's are different
        tap(User::all(), function ($users) {
            /* @see https://laravel.com/docs/5.6/collections#method-diff */
            $this->assertEmpty(
                $users->pluck('username', 'id')
                    ->diff(['john_doe', 'john_doe_1'])
            );
        });
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
            'first-name' => 'John',
            'last-name' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'country' => factory(Country::class)->create()->id,
            'rating-visibility' => factory(RatingVisibility::class)->create()->id,
            'newsletter' => 1,
            'email-offers' => 1
        ], $overrides);
    }
}
