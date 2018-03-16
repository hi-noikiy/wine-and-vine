<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Collection;
use App\{
    WineOriginDenomination
};
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

    /** @test */
    public function a_wine_has_a_name_and_short_name()
    {
        $this->denomination->update([
            'name' => 'some big fancy name',
            'short_name' => 'short name'
        ]);

        $this->assertEquals(
            ['Some Big Fancy Name', 'Short Name'],
            [$this->denomination->name, $this->denomination->short_name]);
    }
}
