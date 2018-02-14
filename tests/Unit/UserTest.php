<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\{
    User, Wine, Address, RatingVisibility, Winery
};
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
    public function a_user_has_many_addresses()
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
    public function a_user_can_be_employed_at_a_winery()
    {
        // Given we have a winery
        $winery = factory(Winery::class)->create();
        // Add a user as a employee of the given winery
        $this->user->employTo($winery);
        // Assert that the pivot table has the user_id and the winery_id
        $this->assertDatabaseHas('user_winery', [
            'user_id' => $this->user->id,
            'winery_id' => $winery->id
        ]);
        // Assert that the user is employed at a Winery::class
        $this->assertInstanceOf(Winery::class, $this->user->employedAt()->first());
    }

    /** @test
     * @throws \Exception
     */
    public function a_user_can_be_employed_at_many_wineries()
    {
        // Given we have a bunch of wineries
        $wineries = factory(Winery::class, 5)->create();
        // Foreach winery, employ the user to that winery
        $wineries->each(function ($winery) {
            $this->user->employTo($winery);
        });
        // Assert that the user works at 5 wineries
        $this->assertCount(5, $this->user->employedAt()->get());
        // Quit from the wineries where the id is an even number
        $wineries->filter(function ($winery) {
            return $winery->id % 2 === 0;
        })->each(function ($winery) {
            $this->user->quitFrom($winery);
        });
        // assert that the user is only working in 3 wineries [id = 1, 3, 5]
        $this->assertTrue($this->user->employedAt->count() === 3);
    }

    /** @test
     * @throws \Exception
     */
    public function a_user_can_quit_from_a_winery()
    {
        // Given we have a winery
        $winery = factory(Winery::class)->create();
        // Add a user as a employee of the given winery
        $this->user->employTo($winery);
        // Assert that the user is employed
        $this->assertTrue($this->user->employedAt()->get()->isNotEmpty());
        // Quit from the winery
        $this->user->quitFrom($winery);
        // Assert that the pivot table has the user_id and the winery_id
        $this->assertDatabaseMissing('user_winery', [
            'user_id' => $this->user->id,
            'winery_id' => $winery->id
        ]);
    }

    /** @test
     * @throws \Exception
     */
    public function a_user_can_have_multiple_addresses()
    {
        // Add 5 addresses to the user
        $addresses = factory(Address::class, 5)
            ->create()
            ->each(function ($address, $key) {
                $this->user->addresses()->save($address);
            });

        // Assert that there is only five address in the addresses collection
        $this->assertCount(5, $this->user->addresses);

        // Assert that the addresses match
        $this->user->addresses()->each(function ($address, $key) use ($addresses) {
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

    /** @test */
    public function a_wine_can_be_attached_to_a_user()
    {
        // Given we have a wine
        $wine = factory(Wine::class)->create();
        // Attach this wine to a user
        $this->user->wishlist()->attach($wine->id);
        // Assert that the pivot table has the user_id and wine_id
        $this->assertDatabaseHas('user_wine', [
            'user_id' => $this->user->id,
            'wine_id' => $wine->id
        ]);
    }
}