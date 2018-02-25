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
    public function a_grape_has_many_wines()
    {
        $this->assertInstanceOf(Collection::class, $this->grape->wines);
    }
}