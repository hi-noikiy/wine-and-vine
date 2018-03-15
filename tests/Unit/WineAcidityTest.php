<?php

namespace Tests\Unit;

use App\WineAcidity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WineAcidityTest extends TestCase
{
    use RefreshDatabase;

    protected $acidity;

    protected function setUp()
    {
        parent::setUp();

        $this->acidity = factory(WineAcidity::class)->create();
    }

    /** @test */
    public function an_acidity_has_many_wines()
    {
        $this->assertInstanceOf(Collection::class, $this->acidity->wines);
    }

    /** @test */
    public function an_acidity_has_a_name()
    {
        $acidity = factory(WineAcidity::class)->create(['name' => 'some name']);

        $this->assertEquals('Some Name', $acidity->name);
    }
}