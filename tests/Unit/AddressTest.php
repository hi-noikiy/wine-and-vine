<?php

namespace Tests\Unit;

use App\{
    Address, City, Country, Region, User, Winery
};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    protected $address;

    protected function setUp()
    {
        parent::setUp();
        $this->address = factory(Address::class)->create();
    }

    /** @test */
    public function an_address_can_belong_to_a_user()
    {
        $address = factory(Address::class)->create([
            'addressable_id' => factory(User::class)->create()->id,
            'addressable_type' => User::class
        ]);
        $this->assertInstanceOf(User::class, $address->addressable);
    }

    /** @test */
    public function an_address_has_a_type()
    {
        $address = factory(Address::class)->create(['type' => 'work address']);
        $this->assertEquals('Work Address', $address->type);
    }

    /** @test */
    public function an_address_can_belong_to_a_winery()
    {
        $address = factory(Address::class)->create([
            'addressable_id' => factory(Winery::class)->create()->id,
            'addressable_type' => Winery::class
        ]);
        $this->assertInstanceOf(Winery::class, $address->addressable);
    }

    /** @test */
    public function an_address_belongs_to_a_city()
    {
        $this->assertInstanceOf(City::class, $this->address->city);
    }

    /** @test */
    public function an_address_can_access_the_city_name_directly()
    {
        $address = factory(Address::class)->create([
            'city_id' => ($city = factory(City::class)->create())->id
        ]);
        $this->assertEquals($city->name, $address->cityName);
    }

    /** @test */
    public function an_address_belongs_to_a_region()
    {
        $this->assertInstanceOf(Region::class, $this->address->region);
    }

    /** @test */
    public function an_address_can_access_the_region_name_directly()
    {
        $address = factory(Address::class)->create([
            'city_id' => factory(City::class)->create([
                'region_id' => ($region = factory(Region::class)->create())->id
            ])->id
        ]);
        $this->assertEquals($region->name, $address->regionName);
    }

    /** @test */
    public function an_address_belongs_to_a_country()
    {
        $this->assertInstanceOf(Country::class, $this->address->country);
    }

    /** @test */
    public function an_address_can_access_the_country_name_directly()
    {
        $address = factory(Address::class)->create([
            'city_id' => factory(City::class)->create([
                'region_id' => factory(Region::class)->create([
                    'country_id' => ($country = factory(Country::class)->create())->id
                ])->id
            ])->id
        ]);
        $this->assertEquals($country->name, $address->countryName);
    }

    /** @test */
    public function an_address_can_access_the_full_address_directly()
    {
        $address = factory(Address::class)->create([
            'city_id' => ($city = factory(City::class)->create([
                'region_id' => ($region = factory(Region::class)->create([
                    'country_id' => ($country = factory(Country::class)->create())->id
                ]))->id
            ]))->id
        ]);
        $full_address = "$address->street_name, $address->postcode $city->name, $region->name, $country->name";
        $this->assertEquals($full_address, $address->fullAddress);
    }
}