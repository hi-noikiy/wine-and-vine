<?php

namespace Tests\Unit;

use App\{
    Address, User, Winery
};
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WineryTest extends TestCase
{
    use RefreshDatabase;

    protected $winery;

    public function setUp()
    {
        parent::setUp();
        $this->winery = factory(Winery::class)->create();
    }

    /** @test
     * @throws \Exception
     */
    public function a_winery_has_a_owner()
    {
        $this->assertInstanceOf(User::class, $this->winery->owner);
    }

    /** @test
     * @throws \Exception
     */
    public function a_winery_has_many_wines()
    {
        $this->assertInstanceOf(Collection::class, $this->winery->wines);
    }

    /** @test
     * @throws \Exception
     */
    public function a_winery_has_an_address()
    {
        $this->winery->address()->save(
            factory(Address::class)->create()
        );
        $this->assertInstanceOf(Address::class, $this->winery->address);
    }

    /** @test
     * @throws \Exception
     */
    public function the_winery_name_is_always_well_constructed()
    {
        // Given we have a Winery
        $winery = factory(Winery::class)->create(['name' => ' PoorLy ConstruCted naMe ']);

        $this->assertTrue($winery->name === 'Poorly Constructed Name');
    }

    /** @test
     * @throws \Exception
     */
    public function the_returned_name_from_the_database_is_all_capitalized()
    {
        // Given we have a Winery
        $winery = factory(Winery::class)->create();

        // If the name is changed to a irregular snake case
        $winery->name = 'wine Name';

        // After saving
        $winery->save();

        $this->assertTrue($winery->name === 'Wine Name');
    }
}
