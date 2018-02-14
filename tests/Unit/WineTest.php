<?php

namespace Tests\Unit;

use App\{
    User, Wine
};
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WineTest extends TestCase
{
    use RefreshDatabase;

    protected $wine;

    public function setUp()
    {
        parent::setUp();

        $this->wine = factory(Wine::class)->create();
    }

    /** @test
     * @throws \Exception
     */
    public function a_wine_belongs_to_many_users_wishlist()
    {
        $this->assertInstanceOf(Collection::class, $this->wine->wishlists);
    }

    /** @test */
    public function a_user_can_be_attached_to_a_wine()
    {
        // Given we have a user
        $user = factory(User::class)->create();

        // Assert that the wines table has a wine
        $this->assertDatabaseHas('wines', [
            'id' => $this->wine->id
        ]);

        // Assert that the users table has the early created user
        $this->assertDatabaseHas('users', [
            'id' => $user->id
        ]);

        // Assert that the pivot table is empty
        $this->assertDatabaseMissing('user_wine', [
            'wine_id' => $this->wine->id,
            'user_id' => $user->id
        ]);

        // Add a user_id and wine_id to the pivot table
        $this->wine->wishlists()->attach($user->id);

        // Finally assert that the pivot table has the user_id and the wine_id
        $this->assertDatabaseHas('user_wine', [
            'wine_id' => $this->wine->id,
            'user_id' => $user->id
        ]);
    }
}
