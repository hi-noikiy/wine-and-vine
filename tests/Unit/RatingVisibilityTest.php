<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\RatingVisibility;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RatingVisibilityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_rating_visibility_has_many_users()
    {
        $this->assertInstanceOf(Collection::class, factory(RatingVisibility::class)->create()->users);
    }
}
