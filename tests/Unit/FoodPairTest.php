<?php

namespace Tests\Unit;

use App\FoodPair;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

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
