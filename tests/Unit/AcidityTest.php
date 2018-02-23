<?php

namespace Tests\Unit;

use App\Acidity;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcidityTest extends TestCase
{
    use RefreshDatabase;

    protected $acidity;

    protected function setUp()
    {
        parent::setUp();
        $this->acidity = factory(Acidity::class)->create();
    }

    /** @test */
    public function an_acidity_has_many_grapes()
    {
        $this->assertInstanceOf(Collection::class, $this->acidity->grapes);
    }
}
