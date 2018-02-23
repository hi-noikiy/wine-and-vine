<?php

namespace Tests\Unit;

use App\{
    Acidity, Body, Color, Grape
};
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GrapeTest extends TestCase
{
    use RefreshDatabase;

    private $grape;

    public function setUp()
    {
        parent::setUp();
        $this->grape = factory(Grape::class)->create();
    }

    /** @test */
    public function a_grape_has_a_acidity()
    {
        $this->assertInstanceOf(Acidity::class, $this->grape->acidity);
    }

    /** @test */
    public function a_grape_has_a_body()
    {
        $this->assertInstanceOf(Body::class, $this->grape->body);
    }

    /** @test */
    public function a_grape_has_a_color()
    {
        $this->assertInstanceOf(Color::class, $this->grape->color);
    }

    /** @test */
    public function a_grape_has_many_wines()
    {
        $this->assertInstanceOf(Collection::class, $this->grape->wines);
    }
}