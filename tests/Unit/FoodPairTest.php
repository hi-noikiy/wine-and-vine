<?php

namespace Tests\Unit;

use App\FoodPair;
use Tests\TestCase;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FoodPairTest extends TestCase
{
    use RefreshDatabase;

    protected $food_pair;

    public function setUp()
    {
        parent::setUp();

        $this->food_pair = factory(FoodPair::class)->create();
    }

    /** @test */
    public function a_food_pair_belongs_to_many_wines()
    {
        $this->assertInstanceOf(Collection::class, $this->food_pair->wines);
    }
}
