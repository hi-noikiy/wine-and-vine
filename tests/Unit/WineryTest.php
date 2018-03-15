<?php

namespace Tests\Unit;

use App\{
    Address, City, Country, Region, User, Winery
};
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WineryTest extends TestCase
{
    use RefreshDatabase;

    protected $winery;

    public function setUp()
    {
        parent::setUp();

        $this->winery = factory(Winery::class)->create();
    }

    /** @test
     * @throws Exception
     */
    public function a_winery_has_many_wines()
    {
        $this->assertInstanceOf(Collection::class, $this->winery->wines);
    }

    /** @test
     * @throws Exception
     */
    public function a_winery_belongs_to_a_owner()
    {
        $this->assertInstanceOf(User::class, $this->winery->owner);
    }

    /** @test
     * @throws Exception
     */
    public function a_winery_belongs_to_many_employees()
    {
        $this->assertInstanceOf(Collection::class, $this->winery->employees);
    }

    /** @test
     * @throws Exception
     */
    public function a_winery_can_have_one_address()
    {
        // Add one address to the winery
        $this->winery->address()->save(factory(Address::class)->create());
        // Assert that the address is an instance of Address::class
        $this->assertInstanceOf(Address::class, $this->winery->address);
    }

    /** @test */
    public function a_winery_can_access_the_address_instance_directly()
    {
        // Save an address into a winery
        $this->winery->address()->save($address = factory(Address::class)->create());
        $this->assertEquals($address->id, $this->winery->address->id);
    }

    /** @test */
    public function a_winery_can_access_the_address_name_directly()
    {
        // Save an address into a winery
        $this->winery->address()->save($address = factory(Address::class)->create());
        $this->assertEquals($address->street_name, $this->winery->addressName);
    }

    /** @test */
    public function a_winery_can_access_the_city_instance_directly()
    {
        // Save an address into a winery
        $this->winery->address()->save(factory(Address::class)->create([
            'city_id' => ($city = factory(City::class)->create())->id
        ]));
        $this->assertEquals($city->id, $this->winery->city->id);
    }

    /** @test */
    public function a_winery_can_access_the_city_name_directly()
    {
        // Save an address into a winery
        $this->winery->address()->save(factory(Address::class)->create([
            'city_id' => ($city = factory(City::class)->create())->id
        ]));
        $this->assertEquals($city->name, $this->winery->cityName);
    }

    /** @test */
    public function a_winery_can_access_the_region_instance_directly()
    {
        // Save an address into a winery
        $this->winery->address()->save(factory(Address::class)->create([
            'city_id' => factory(City::class)->create([
                'region_id' => ($region = factory(Region::class)->create())->id
            ])->id
        ]));
        $this->assertEquals($region->id, $this->winery->region->id);
    }

    /** @test */
    public function a_winery_can_access_the_region_name_directly()
    {
        // Save an address into a winery
        $this->winery->address()->save(factory(Address::class)->create([
            'city_id' => factory(City::class)->create([
                'region_id' => ($region = factory(Region::class)->create())->id
            ])->id
        ]));
        $this->assertEquals($region->name, $this->winery->regionName);
    }

    /** @test */
    public function a_winery_can_access_the_country_instance_directly()
    {
        // Save an address into a winery
        $this->winery->address()->save(factory(Address::class)->create([
            'city_id' => factory(City::class)->create([
                'region_id' => factory(Region::class)->create([
                    'country_id' => ($country = factory(Country::class)->create())->id
                ])->id
            ])->id
        ]));
        $this->assertEquals($country->id, $this->winery->country->id);
    }

    /** @test */
    public function a_winery_can_access_the_country_name_directly()
    {
        // Save an address into a winery
        $this->winery->address()->save(factory(Address::class)->create([
            'city_id' => factory(City::class)->create([
                'region_id' => factory(Region::class)->create([
                    'country_id' => ($country = factory(Country::class)->create())->id
                ])->id
            ])->id
        ]));
        $this->assertEquals($country->name, $this->winery->countryName);
    }

    /** @test */
    public function a_winery_can_access_the_full_address_directly()
    {
        // Save an address into a winery
        $this->winery->address()->save($address = factory(Address::class)->create());
        $this->assertEquals($address->fullAddress, $this->winery->fullAddress);
    }

    /** @test */
    public function a_winery_can_employ_a_user()
    {
        // Employ one user to a given winery
        $this->winery->employ($user = factory(User::class)->create());
        // Assert that the pivot table has the user_id and the winery_id
        $this->assertDatabaseHas('user_winery', [
            'user_id' => $user->id,
            'winery_id' => $this->winery->id
        ]);
    }

    /** @test
     * @throws Exception
     */
    public function a_winery_can_fire_a_user()
    {
        // Employ one user to a given winery
        $this->winery->employ($user = factory(User::class)->create());
        // Assert that the winery has employees
        $this->assertTrue($this->winery->employees->isNotEmpty());
        // Fire the user
        $this->winery->fire($user);
        // Assert that the pivot table does not has the user_id and the winery_id
        $this->assertDatabaseMissing('user_winery', [
            'user_id' => $user->id,
            'winery_id' => $this->winery->id
        ]);
    }

    /** @test
     * @throws Exception
     */
    public function the_winery_name_is_always_well_constructed()
    {
        // Given we have a Winery with a poorly formatted name
        $winery = factory(Winery::class)->create(['name' => ' PoorLy ConstruCted naMe ']);
        // Assert that the winery name is well presented
        $this->assertEquals('Poorly Constructed Name', $winery->name);
    }

    /** @test
     * @throws Exception
     */
    public function the_returned_name_from_the_database_is_all_capitalized()
    {
        // Given we have a winery where the name is not capitalised
        $winery = factory(Winery::class)->create(['name' => 'winE NaMe']);
        // Assert that the name is capitalised after fetching it from the database
        $this->assertEquals('Wine Name', $winery->name);
    }

    /** @test */
    public function a_winery_has_an_email_address()
    {
        $this->winery->update(['email' => 'wine@winery.com']);

        $this->assertEquals('wine@winery.com', $this->winery->email);
    }

    /** @test */
    public function a_winery_has_a_phone_number()
    {
        $this->winery->update(['phone_number' => '123-98765']);

        $this->assertEquals('123-98765', $this->winery->phone_number);
    }

    /** @test */
    public function a_winery_has_a_mobile_phone_number()
    {
        $this->winery->update(['mobile_number' => '756-98765']);

        $this->assertEquals('756-98765', $this->winery->mobile_number);
    }
}