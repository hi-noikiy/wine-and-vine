<?php

namespace Tests\Unit;

use App\{
    City, Country, Region
};
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CityTest extends TestCase
{
    use RefreshDatabase;

    protected $city;

    protected function setUp()
    {
        parent::setUp();
        $this->city = factory(City::class)->create();
    }

    /** @test */
    public function a_city_belongs_to_a_region()
    {
        $this->assertInstanceOf(Region::class, $this->city->region);
    }

    /** @test */
    public function a_city_can_access_the_region_name_directly()
    {
        // Given we have a city with a region
        $city = factory(City::class)->create([
            'region_id' => ($region = factory(Region::class)->create())->id
        ]);
        // Assert that the region name is the same in both instances
        $this->assertEquals($region->name, $city->regionName);
    }

    /** @test */
    public function a_city_has_many_addresses()
    {
        $this->assertInstanceOf(Collection::class, $this->city->addresses);
    }

    /** @test */
    public function a_city_can_access_the_country_name_directly()
    {
        // Given we have a city with a country
        $city = factory(City::class)->create([
            'region_id' => ($region = factory(Region::class)->create([
                'country_id' => ($country = factory(Country::class)->create())->id
            ]))->id
        ]);
        // Assert that the country name is the same in both instances
        $this->assertEquals($country->name, $city->countryName);
    }

    /** @test */
    public function a_city_can_access_its_country_directly()
    {
        $this->assertInstanceOf(Country::class, $this->city->country);
    }

    /** @test */
    public function a_city_can_access_its_full_name_directly()
    {
        // Given we have a city with a country
        $city = factory(City::class)->create([
            'region_id' => ($region = factory(Region::class)->create([
                'country_id' => ($country = factory(Country::class)->create())->id
            ]))->id
        ]);
        // Assert that the full name is the same in both instances
        $this->assertEquals("$city->name, $region->name, $country->name", $city->fullName);
    }
}