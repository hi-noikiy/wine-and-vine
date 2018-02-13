<?php

namespace Tests\Unit;

use App\User;
use App\Address;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test
     * @throws \Exception
     */
    public function a_user_can_have_one_address()
    {
        // Given we have a user
        $user = factory(User::class)->create();

        // Add an address to the user
        $user->addresses()->save($address = factory(Address::class)->create());

        // Assert that there is only one address in the addresses collection
        $this->assertCount(1, $user->addresses);

        // Assert that the addresses match
        $this->assertEquals($address->fullname, $user->addresses()->first()->fullname);
    }

    /** @test
     * @throws \Exception
     */
    public function a_user_can_have_multiple_addresses()
    {
        // Given we have a user
        $user = factory(User::class)->create();

        // Add 5 addresses to the user
        $addresses = factory(Address::class, 5)->create()->each(function ($address, $key) use ($user) {
            $user->addresses()->save($address);
        });

        // Assert that there is only five address in the addresses collection
        $this->assertCount(5, $user->addresses);

        // Assert that the addresses match
        $user->addresses()->each(function ($address, $key) use ($addresses) {
            $this->assertTrue($addresses->contains($address));
        });
    }
}