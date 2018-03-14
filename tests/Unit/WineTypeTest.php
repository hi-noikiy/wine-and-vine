<?php

namespace Tests\Unit;

use App\WineType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WineTypeTest extends TestCase
{
    use RefreshDatabase;

    protected $wine_type;

    protected function setUp()
    {
        parent::setUp();
        $this->wine_type = factory(WineType::class)->create();
    }

    /** @test */
    public function a_wine_type_has_many_wines()
    {
        $this->assertInstanceOf(Collection::class, $this->wine_type->wines);
    }
}
