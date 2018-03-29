<?php

namespace Tests\Unit;

use App\User;
use App\Wine;
use Exception;
use App\Region;
use App\Winery;
use App\Address;
use App\Currency;
use App\WineBody;
use App\WineType;
use App\WineColor;
use Tests\TestCase;
use App\WineAcidity;
use App\WineOriginDenomination;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
    public function a_wine_belongs_to_a_currency()
    {
        $this->assertInstanceOf(Currency::class, $this->wine->currency);
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
        $wine = create(Wine::class, [
            'winery_id' => ($winery = create(Winery::class, [
                'region_id' => $region = create(Region::class)
            ]))->id
        ]);

        $this->assertEquals($region->id, $wine->region->id);
    }

    /** @test */
    public function a_wine_can_access_its_region_name_directly()
    {
        $wine = create(Wine::class, [
            'winery_id' => ($winery = create(Winery::class, [
                'region_id' => create(Region::class, ['name' => 'region name'])
            ]))->id
        ]);

        $this->assertEquals('Region Name', $wine->regionName);
    }

    /** @test */
    public function a_wine_can_access_its_country_directly()
    {
        $wine = create(Wine::class, [
            'winery_id' => ($winery = create(Winery::class))->id
        ]);

        $winery->address()->save($address = create(Address::class));

        $this->assertEquals($address->country->id, $wine->country->id);
    }

    /** @test */
    public function a_wine_can_access_its_country_name_directly()
    {
        $wine = create(Wine::class, [
            'winery_id' => ($winery = create(Winery::class))->id
        ]);

        $winery->address()->save($address = create(Address::class));

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

    /** @test */
    public function a_wine_can_be_rated_by_many_users()
    {
        $this->assertInstanceOf(Collection::class, $this->wine->ratings);
    }

    /** @test */
    public function a_wine_can_be_rated()
    {
        $this->assertEmpty($this->wine->ratings);

        $user = create(User::class);

        $this->wine->ratings()
             ->attach($user, ['rate' => 3]);

        $this->assertEquals(3, $this->wine->fresh()->ratings->first()->pivot->rate);
    }

    /** @test */
    public function a_wine_can_be_rated_by_multiple_users()
    {
        $this->assertEmpty($this->wine->ratings);

        $number = 1;
        create(User::class, [], 5)
              ->each(function ($user) use (&$number) {
                  $this->wine->ratings()->attach($user, ['rate' => $number++]);
              });

        $assertionNumber = 1;
        $this->wine->fresh()->ratings->each(function ($user) use (&$assertionNumber) {
            $this->assertEquals($assertionNumber++, $user->pivot->rate);
        });
    }
}
