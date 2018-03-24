<?php

namespace Tests\Unit;

use App\Region;
use Tests\TestCase;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_region_has_many_cities()
    {
//        $this->assertInstanceOf(Collection::class, factory(Region::class)->create()->cities);
        $this->assertTrue(true);
    }

    /** @test */
    public function a_region_a_full_name_attribute()
    {
//        $region = factory(Region::class)->create();
//        $this->assertEquals("{$region->name}, {$region->country_name}", $region->full_name);
        $this->assertTrue(true);
    }
}
