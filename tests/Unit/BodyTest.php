<?php

namespace Tests\Unit;

use App\Body;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BodyTest extends TestCase
{
    use RefreshDatabase;

    protected $body;

    protected function setUp()
    {
        parent::setUp();
        $this->body = factory(Body::class)->create();
    }

    /** @test */
    public function a_body_has_many_grapes()
    {
        $this->assertInstanceOf(Collection::class, $this->body->grapes);
    }
}
