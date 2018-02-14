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
    public function a_winery_has_many_employees()
    {
        $this->assertInstanceOf(Collection::class, $this->winery->employees);
    }

    /** @test
     * @throws \Exception
     */
    public function a_winery_has_many_wines()
    {
        $this->assertInstanceOf(Collection::class, $this->winery->wines);
    }

    /** @test */
    public function a_winery_can_employ_a_user()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Employ this user to a given winery
        $this->winery->employ($user);
        // Assert that the pivot table has the user_id and the winery_id
        $this->assertDatabaseHas('user_winery', [
            'user_id' => $user->id,
            'winery_id' => $this->winery->id
        ]);
    }

    /** @test
     * @throws \Exception
     */
    public function a_winery_can_fire_a_user()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Employ this user to a given winery
        $this->winery->employ($user);
        // Assert that the winery has employees
        $this->assertTrue($this->winery->employees()->get()->isNotEmpty());
        // Fire the user
        $this->winery->fire($user);
        // Assert that the pivot table does not has the user_id and the winery_id
        $this->assertDatabaseMissing('user_winery', [
            'user_id' => $user->id,
            'winery_id' => $this->winery->id
        ]);
    }

    /** @test
     * @throws \Exception
     */
    public function a_winery_has_an_address()
    {
        // Given we have an address
        $address = factory(Address::class)->create();
        // Add the address to the winery
        $this->winery->address()->save($address);
        // Assert that the address is an instance of Address::class
        $this->assertInstanceOf(Address::class, $this->winery->address);
    }

    /** @test
     * @throws \Exception
     */
    public function the_winery_name_is_always_well_constructed()
    {
        // Given we have a Winery with a poorly formatted name
        $winery = factory(Winery::class)->create(['name' => ' PoorLy ConstruCted naMe ']);
        // Assert that the winery name is well presented
        $this->assertEquals('Poorly Constructed Name', $winery->name);
    }

    /** @test
     * @throws \Exception
     */
    public function the_returned_name_from_the_database_is_all_capitalized()
    {
        // Given we have a winery where the name is not capitalised
        $winery = factory(Winery::class)->create(['name' => 'winE NaMe']);
        // Assert that the name is capitalised after fetching it from the database
        $this->assertEquals('Wine Name', $winery->name);
    }
}
