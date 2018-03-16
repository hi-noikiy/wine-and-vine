<?php

namespace Tests\Unit;

use App\WineBody;
use Tests\TestCase;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WineBodyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_body_has_many_wines()
    {
        $body = factory(WineBody::class)->create();

        $this->assertInstanceOf(Collection::class, $body->wines);
    }

    /** @test */
    public function a_body_has_a_name()
    {
        $body = factory(WineBody::class)->create(['name' => 'some name']);

        $this->assertEquals('Some Name', $body->name);
    }
}
