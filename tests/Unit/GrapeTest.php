<?php

namespace Tests\Unit;

use App\{
    Grape
};
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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