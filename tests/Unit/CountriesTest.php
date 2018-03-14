<?php

namespace Tests\Unit;

use App\Country;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CountriesTest extends TestCase
{
    use RefreshDatabase;

    private $country;

    protected function setUp()
    {
        parent::setUp();

        $this->country = factory(Country::class)->create();
    }

    /** @test */
    public function a_country_has_many_regions()
    {
        $this->assertInstanceOf(Collection::class, $this->country->regions);
    }

    /** @test */
    public function a_country_can_be_fetched_by_name()
    {
        $this->country->update(['name' => 'Portugal']);

        $this->assertEquals('Portugal', Country::whereName('Portugal')->first()->name);
    }
}