<?php

namespace Tests\Unit;

use App\User;
use App\Address;
use Tests\TestCase;
use App\RatingVisibility;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /** @test
     * @throws \Exception
     */
    function a_user_has_addresses()
    {
        $this->assertInstanceOf(Collection::class, $this->user->addresses);
    }

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

    /** @test
     * @throws \Exception
     */
    public function a_user_may_change_between_rating_visibilities()
    {
        // Given we have 3 types of rating visibilities
        $visibilities = factory(RatingVisibility::class, 2)->create();

        // And a we have a user with the first visibility
        $user = factory(User::class)->create(['rating_visibility_id' => $id = $visibilities->pop()->id]);

        // Assert that the visibility was persisted
        $this->assertEquals($id, $user->rating->id);

        // Update the user rating visibility option
        $user->update(['rating_visibility_id' => $id = $visibilities->pop()->id]);

        // Assert that the visibility was persisted
        $this->assertEquals($id, $user->fresh()->rating->id);
    }
}