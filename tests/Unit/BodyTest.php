<?php

namespace Tests\Unit;

use App\WineBody;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BodyTest extends TestCase
{
    use RefreshDatabase;

    protected $body;

    protected function setUp()
    {
        parent::setUp();
        $this->body = factory(WineBody::class)->create();
    }

    /** @test */
    public function a_body_has_many_wines()
    {
        $this->assertInstanceOf(Collection::class, $this->body->wines);
    }
}
