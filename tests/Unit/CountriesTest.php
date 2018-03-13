<?php

namespace Tests\Unit;

use Tests\TestCase;
use PragmaRX\Countries\Package\Countries;

class CountriesTest extends TestCase
{
    /** @test */
    public function a_country_name_can_be_fetched()
    {
        $this->assertEquals('Portugal', Countries::where('name.common', 'Portugal')->first()->name->common);
    }
}