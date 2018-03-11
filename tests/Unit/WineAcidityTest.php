<?php

namespace Tests\Unit;

use App\WineAcidity;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
}