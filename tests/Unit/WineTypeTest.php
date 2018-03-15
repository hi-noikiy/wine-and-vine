<?php

namespace Tests\Unit;

use App\WineType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WineTypeTest extends TestCase
{
    use RefreshDatabase;

    private $wine_type;

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

    /** @test */
    public function a_wine_type_has_a_name()
    {
        $this->wine_type->update(['name' => 'different name']);

        $this->assertEquals('Different Name', $this->wine_type->name);
    }
}
