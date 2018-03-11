<?php

namespace Tests\Unit;

use App\{
    Wine, WineOriginDenomination
};
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WineOriginDenominationTest extends TestCase
{
    use RefreshDatabase;

    protected $denomination;

    public function setUp()
    {
        parent::setUp();

        $this->denomination = factory(WineOriginDenomination::class)->create();
    }

    /** @test */
    public function a_wine_origin_denomination_has_many_wines()
    {
        $this->assertInstanceOf(Collection::class, $this->denomination->wines);
    }
}
