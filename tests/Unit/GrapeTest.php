<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\{
    Grape
};
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GrapeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_grape_has_many_wines()
    {
        $this->assertInstanceOf(Collection::class, factory(Grape::class)->make()->wines);
    }

    /** @test */
    public function a_grape_has_a_name()
    {
        $grape = factory(Grape::class)->create(['name' => 'some name']);

        $this->assertEquals('Some Name', $grape->name);
    }
}
