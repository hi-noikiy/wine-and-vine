<?php

namespace Tests\Unit;

use App\WineColor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class WineColorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_color_has_many_wines()
    {
        $color = factory(WineColor::class)->create();

        $this->assertInstanceOf(Collection::class, $color->wines);
    }

    /** @test */
    public function a_color_has_a_name()
    {
        $color = factory(WineColor::class)->create(['name' => 'some name']);

        $this->assertEquals('Some Name', $color->name);
    }
}
