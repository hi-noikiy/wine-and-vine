<?php

namespace Tests\Unit;

use App\WineColor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ColorTest extends TestCase
{
    use RefreshDatabase;

    protected $color;

    protected function setUp()
    {
        parent::setUp();
        $this->color = factory(WineColor::class)->create();
    }

    /** @test */
    public function a_color_has_many_wines()
    {
        $this->assertInstanceOf(Collection::class, $this->color->wines);
    }
}