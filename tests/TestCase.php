<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp()
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /**
     * Signs in a user.
     *
     * @param mixed $user
     * @return $this
     */
    protected function signIn($user = null)
    {
        // if no admin is given, just wip up a new one
        $user = $user ?: create(User::class);
        // Act as this user
        $this->actingAs($user);
        // Return this instance so we can continuing chaining functions
        return $this;
    }

    /**
     * Signs in a user as an Admin.
     *
     * @param mixed $admin
     * @return $this
     */
    protected function signInAdmin($admin = null)
    {
        // if no admin is given, just wip up a new one
        $admin = $admin ?: create(User::class);
        // Set the administrators array on the 'config/wine-and-vine.php' as the user we just created email
        config(['wine-and-vine.administrators' => [$admin->email]]);
        // Act as this user
        $this->actingAs($admin);
        // Return this instance so we can continuing chaining functions
        return $this;
    }
}
