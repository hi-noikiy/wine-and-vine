<?php

namespace Tests\Feature;

use App\Wine;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WinesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_can_browse_wines()
    {
        $wine = create(Wine::class);

        $this->get(route('wines.index'))
            ->assertSee($wine->name);
    }

    /** @test */
    public function a_guest_can_browse_a_specific_wine()
    {
        $wine = create(Wine::class);

        $this->get(route('wine.show', $wine))
            ->assertSee($wine->name);
    }
}
