<?php

namespace Tests\Unit;

use App\User;
use App\Winery;
use App\Address;
use App\Country;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    private $address;

    protected function setUp()
    {
        parent::setUp();
        $this->address = create(Address::class);
    }

    /** @test */
    public function an_address_can_belong_to_a_user()
    {
        $address = create(Address::class, [
            'addressable_id' => create(User::class)->id,
            'addressable_type' => User::class
        ]);
        $this->assertInstanceOf(User::class, $address->addressable);
    }

    /** @test */
    public function an_address_has_a_type()
    {
        $address = create(Address::class, ['type' => 'work address']);

        $this->assertEquals('Work Address', $address->type);
    }

    /** @test */
    public function an_address_can_belong_to_a_winery()
    {
        $address = create(Address::class, [
            'addressable_id' => create(Winery::class)->id,
            'addressable_type' => Winery::class
        ]);
        $this->assertInstanceOf(Winery::class, $address->addressable);
    }

    /** @test */
    public function an_country_belongs_to_a_city()
    {
        $this->assertInstanceOf(Country::class, $this->address->country);
    }

    /** @test */
    public function an_address_can_access_the_country_name_directly()
    {
        $address = create(Address::class, [
            'country_id' => ($country = create(Country::class))->id
        ]);
        $this->assertEquals($country->name, $address->countryName);
    }

    /** @test */
    public function an_address_belongs_to_a_country()
    {
        $this->assertInstanceOf(Country::class, $this->address->country);
    }

    /** @test */
    public function an_address_can_access_the_full_address_directly()
    {
        $address = create(Address::class, [
            'country_id' => ($country = create(Country::class))->id
        ]);

        $full_address = "$address->street_name, $address->postcode $address->city, $country->name";
        $this->assertEquals($full_address, $address->fullAddress);
    }
}
