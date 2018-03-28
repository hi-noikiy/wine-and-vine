<?php

namespace Tests\Unit;

use App\Country;
use App\Currency;
use Tests\TestCase;
use PragmaRX\Countries\Package\Countries;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryTest extends TestCase
{
    use RefreshDatabase;

    private $country;

    protected function setUp()
    {
        parent::setUp();

        $this->country = create(Country::class);
    }

    /** @test */
    public function a_country_has_many_addresses()
    {
        $this->assertInstanceOf(Collection::class, $this->country->addresses);
    }

    /** @test */
    public function a_country_can_be_fetched_by_name()
    {
        $this->country->update(['name' => 'Portugal']);

        $this->assertEquals('Portugal', Country::whereName('portugal')->first()->name);
    }

    /** @test */
    public function a_country_has_a_currency()
    {
        $portugal = Countries::whereCca2('PT')->first();

        $portugal = create(Country::class, [
            'name' => $portugal->name->common,
            'cca2' => $portugal->cca2,
            'cca3' => $portugal->cca3,
            'emoji' => $portugal['extra']['emoji'] ?? null,
            'address_format' => $portugal['extra']['address_format'] ?? null,
            'continent' => collect($portugal['geo']['continent'])->first(),
            'eu_member' =>  $portugal['extra']['eu_member'] ?? false,
            'svg_path' => $portugal['flag']['svg_path'] ?? null
        ]);

        $portugal->currencies()->sync(create(Currency::class, ['name' => 'Euro'])->id);

        $this->assertEquals('Euro', $portugal->currencies->first()->name);
    }
}
