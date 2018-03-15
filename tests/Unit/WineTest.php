<?php

namespace Tests\Unit;

use App\{
    Address, User, Wine, WineAcidity, WineBody, WineColor, WineOriginDenomination, Winery, WineType
};
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WineTest extends TestCase
{
    use RefreshDatabase;

    private $wine;

    public function setUp()
    {
        parent::setUp();

        $this->wine = factory(Wine::class)->create();
    }

    /** @test */
    public function a_wine_belongs_to_many_castes()
    {
        $this->assertInstanceOf(Collection::class, $this->wine->castes);
    }

    /** @test */
    public function a_wine_belongs_to_an_acidity()
    {
        $this->assertInstanceOf(WineAcidity::class, $this->wine->acidity);
    }

    /** @test */
    public function a_wine_belongs_to_a_body()
    {
        $this->assertInstanceOf(WineBody::class, $this->wine->body);
    }

    /** @test */
    public function a_wine_belongs_to_a_color()
    {
        $this->assertInstanceOf(WineColor::class, $this->wine->color);
    }

    /** @test */
    public function a_wine_belongs_to_a_origin_denomination()
    {
        $this->assertInstanceOf(WineOriginDenomination::class, $this->wine->denomination);
    }

    /** @test */
    public function a_wine_belongs_to_many_food_pairings()
    {
        $this->assertInstanceOf(Collection::class, $this->wine->food_pairing);
    }

    /** @test */
    public function a_wine_belongs_to_a_type()
    {
        $this->assertInstanceOf(WineType::class, $this->wine->type);
    }

    /** @test */
    public function a_wine_belongs_to_a_winery()
    {
        $this->assertInstanceOf(Winery::class, $this->wine->winery);
    }

    /** @test
     * @throws Exception
     */
    public function a_wine_belongs_to_many_users_wishlists()
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

    /** @test */
    public function a_wine_has_a_name()
    {
        $this->assertEquals('Wine Name', factory(Wine::class)->create(['name' => 'wine name'])->name);
    }

    /** @test */
    public function a_wine_has_a_description()
    {
        $this->assertEquals('Wine Description', factory(Wine::class)->create(['description' => 'Wine Description'])->description);
    }

    /** @test */
    public function a_wine_can_access_its_region_directly()
    {
        $wine = factory(Wine::class)->create([
            'winery_id' => ($winery = factory(Winery::class)->create())->id
        ]);

        $winery->address()->save($address = factory(Address::class)->create());

        $this->assertEquals($address->region, $wine->region);
    }

    /** @test */
    public function a_wine_can_access_its_region_name_directly()
    {
        $wine = factory(Wine::class)->create([
            'winery_id' => ($winery = factory(Winery::class)->create())->id
        ]);

        $winery->address()->save($address = factory(Address::class)->create());

        $this->assertEquals($address->region->name, $wine->region_name);
    }

    /** @test */
    public function a_wine_can_access_its_country_directly()
    {
        $wine = factory(Wine::class)->create([
            'winery_id' => ($winery = factory(Winery::class)->create())->id
        ]);

        $winery->address()->save($address = factory(Address::class)->create());

        $this->assertEquals($address->country, $wine->country);
    }

    /** @test */
    public function a_wine_can_access_its_country_name_directly()
    {
        $wine = factory(Wine::class)->create([
            'winery_id' => ($winery = factory(Winery::class)->create())->id
        ]);

        $winery->address()->save($address = factory(Address::class)->create());

        $this->assertEquals($address->country->name, $wine->country_name);
    }

    /** @test */
    public function a_wine_has_a_rating()
    {
        $this->assertTrue(is_float($this->wine->rating));

        $wine = factory(Wine::class)->create([
            'rating_sum' => 25,
            'rating_count' => 5
        ]);

        $this->assertEquals(5.0, $wine->rating);
    }
}
