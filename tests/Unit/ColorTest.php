<?php

namespace Tests\Unit;

use App\Color;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ColorTest extends TestCase
{
    use RefreshDatabase;

    protected $color;

    protected function setUp()
    {
        parent::setUp();
        $this->color = factory(Color::class)->create();
    }

    /** @test */
    public function a_color_has_many_grapes()
    {
        $this->assertInstanceOf(Collection::class, $this->color->grapes);
    }
}
