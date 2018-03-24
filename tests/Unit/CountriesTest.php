<?php

namespace Tests\Unit;

use App\Country;
use Tests\TestCase;
use PragmaRX\Countries\Package\Countries;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountriesTest extends TestCase
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

//    /** @test */
//    public function test()
//    {
//        $cities = Countries::where('cca2', 'IT')
//            ->first()
//            ->hydrateCities()
//            ->cities;
//
//        $collection = [];
//        foreach ($cities as $city) {
//            array_push($collection, [
//                'cca2' => $city['cca2'],
//                'cca3' => $city['cca3'],
//                'country' => $city['adm0name'],
//                'city' => $city['gn_ascii'],
//                'timezone' => $city['timezone']
//            ]);
//        }
//        dd($collection);
//        $juice = collect($cities)
//            ->only(['adm0name', 'adm1name', 'timezone', 'cca2', 'cca3']);
//
//        dd($juice);
//        $countries = collect(Countries::all())
//            ->reject(function ($country) {
//                return strpos($country['name']['common'], 'Europe') !== false;
//            })
//            ->filter(function ($country) { return $country['extra']['eu_member'] ?? false; })
//            ->pluck('name.common');
//
//        dump($countries);
//        dump('Countries: ' . $countries->count());
//        dd("All: 267");
//    }
}
