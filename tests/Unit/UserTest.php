<?php

namespace Tests\Unit;

use App\User;
use App\Wine;
use Exception;
use App\Winery;
use App\Address;
use App\Country;
use Tests\TestCase;
use App\RatingVisibility;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = create(User::class);
    }

    /** @test */
    public function a_user_may_have_a_shipping_address()
    {
        $this->assertInstanceOf(Address::class, $this->user->shipping);
    }

    /** @test */
    public function a_user_belongs_to_a_country()
    {
        $this->assertInstanceOf(Country::class, $this->user->country);
    }

    /** @test
     * @throws Exception
     */
    public function a_user_has_many_addresses()
    {
        $this->assertInstanceOf(Collection::class, $this->user->addresses);
    }

    /** @test
     * @throws Exception
     */
    public function a_user_can_have_one_address()
    {
        // Given we have a user
        $user = factory(User::class)->create(['shipping_address_id' => null]);
        // Add an address to the user
        $user->addresses()->save($address = factory(Address::class)->create());
        // Assert that there is only one address in the addresses collection
        $this->assertCount(1, $user->addresses);
        // Assert that the addresses match
        $this->assertEquals($address->fullAddress, $user->addresses()->first()->fullAddress);
    }

    /** @test
     * @throws Exception
     */
    public function a_user_can_be_employed_at_a_winery()
    {
        // Given we have a winery
        $winery = factory(Winery::class)->create();
        // Add a user as a employee of the given winery
        $this->user->employTo($winery);
        // Assert that the pivot table has the user_id and the winery_id
        $this->assertDatabaseHas('user_winery', [
            'user_id' => $this->user->id,
            'winery_id' => $winery->id
        ]);
        // Assert that the user is employed at a Winery::class
        $this->assertInstanceOf(Winery::class, $this->user->employedAt()->first());
    }

    /** @test
     * @throws Exception
     */
    public function a_user_can_be_employed_at_many_wineries()
    {
        // Given we have a bunch of wineries
        $wineries = factory(Winery::class, 5)->create();
        // Foreach winery, employ the user to that winery
        $wineries->each(function ($winery) {
            $this->user->employTo($winery);
        });
        // Assert that the user works at 5 wineries
        $this->assertCount(5, $this->user->employedAt);
    }

    /** @test
     * @throws Exception
     */
    public function a_user_can_quit_from_a_winery()
    {
        // Given we have a winery
        $winery = factory(Winery::class)->create();
        // Add a user as a employee of the given winery
        $this->user->employTo($winery);
        // Assert that the user is employed
        $this->assertTrue($this->user->employedAt()->get()->isNotEmpty());
        // Quit from the winery
        $this->user->quitFrom($winery);
        // Assert that the pivot table has the user_id and the winery_id
        $this->assertDatabaseMissing('user_winery', [
            'user_id' => $this->user->id,
            'winery_id' => $winery->id
        ]);
    }

    /** @test
     * @throws Exception
     */
    public function a_user_can_have_multiple_addresses()
    {
        // Given we have a user
        $user = factory(User::class)->create(['shipping_address_id' => null]);
        // Add 5 addresses to the user
        $addresses = factory(Address::class, 5)
            ->create()
            ->each(function ($address, $key) use ($user) {
                $user->addresses()->save($address);
            });

        // Assert that there is only five address in the addresses collection
        $this->assertCount(5, $user->addresses);

        // Assert that the addresses match
        $user->addresses()
            ->each(function ($address, $key) use ($user, $addresses) {
                $this->assertTrue($addresses->contains($address));
            });
    }

    /** @test
     * @throws Exception
     */
    public function a_user_may_change_between_rating_visibilities()
    {
        // Given we have 2 types of rating visibilities
        $visibilities = factory(RatingVisibility::class, 2)->create();
        // And a we have a user with the first visibility
        $user = factory(User::class)->create(['rating_visibility_id' => $id = $visibilities->pop()->id]);
        // Assert that the visibility was persisted
        $this->assertEquals($id, $user->rating->id);
        // Update the user rating visibility option
        $user->update(['rating_visibility_id' => $id = $visibilities->pop()->id]);
        // Assert that the visibility was persisted
        $this->assertEquals($id, $user->fresh()->rating->id);
    }

    /** @test */
    public function a_wine_can_be_attached_to_a_user()
    {
        // Given we have a wine
        $wine = factory(Wine::class)->create();
        // Attach this wine to a user
        $this->user->wishlist()->attach($wine->id);
        // Assert that the pivot table has the user_id and wine_id
        $this->assertDatabaseHas('user_wine', [
            'user_id' => $this->user->id,
            'wine_id' => $wine->id
        ]);
    }

    /** @test */
    public function a_user_can_fetch_his_full_name()
    {
        $this->user->update([
            'first_name' => 'Rafael',
            'last_name' => 'Macedo'
        ]);
        $this->assertEquals('Rafael Macedo', $this->user->fullName);
    }

    /** @test */
    public function a_user_can_fetch_his_country_name()
    {
        $this->user->update(['country_id' => ($country = factory(Country::class)->create())->id]);

        $this->assertEquals($country->name, $this->user->countryName);
    }

    /** @test */
    public function a_user_may_change_shipping_address()
    {
        // Given I have a user with no shipping address
        $user = factory(User::class)->create([
            'shipping_address_id' => null
        ]);
        // Assert that the user has no shipping address
        $this->assertNull($user->shipping);
        // Given I have a collection of addresses
        $addresses = factory(Address::class, 5)->create([
            'addressable_id' => $user->id,
            'addressable_type' => User::class
        ]);
        // foreach address
        $addresses->each(function ($address) use ($user) {
            // Associate to the user the current address
            $user->shipping()->associate($address);
            // Assert that the user shipping address is the current address
            $this->assertEquals($address, $user->shipping);
        });
        // Finally disassociate any shipping addresses from the user
        $user->shipping()->dissociate();
        // And lastly, check that the user has no shipping addresses
        $this->assertNull($user->shipping);
    }

    /** @test */
    public function a_user_may_own_many_wineries()
    {
        $this->assertInstanceOf(Collection::class, $this->user->wineries);

        $this->assertCount(0, $this->user->wineries);

        $this->user
            ->wineries()
            ->save(create(Winery::class));

        $this->assertCount(1, $this->user->fresh()->wineries);
    }

    /** @test */
    public function a_user_may_access_his_shipping_address()
    {
        $address = $this->user->shipping;
        $this->assertEquals(
            "$address->street_name, $address->postcode $address->city, $address->countryName",
            $this->user->shipping_address
        );
    }

    /** @test */
    public function a_user_can_have_a_role()
    {
        // Create a role
        $role = create(Role::class);
        // Assert that there is a role on the database
        $this->assertCount(1, Role::all());
        // Assign the role to the user
        $this->user->assignRole($role);
        // Assert that the user has only one role
        $this->assertCount(1, $this->user->roles);
    }

    /** @test */
    public function a_role_can_be_removed_from_a_user_by_its_reference()
    {
        // Create a role with the name 'reference'
        $role_by_reference = Role::create(['name' => 'reference']);
        // Assign the role by reference
        $this->user->assignRole($role_by_reference);
        // Assert that the user has one role
        $this->assertCount(1, $this->user->roles);
        // Remove this role by reference
        $this->user->removeRole($role_by_reference);
        // Assert that the user has bo roles
        $this->assertCount(0, $this->user->fresh()->roles);
    }

    /** @test */
    public function a_role_can_be_removed_from_a_user_by_its_name()
    {
        // Create a role with the name 'name'
        Role::create(['name' => 'name']);
        // Assign the role by name
        $this->user->assignRole('name');
        // Assert that the user has one role
        $this->assertCount(1, $this->user->roles);
        // Remove this role by name
        $this->user->removeRole('name');
        // Assert that the user has bo roles
        $this->assertCount(0, $this->user->fresh()->roles);
    }

    /** @test */
    public function roles_can_be_removed_from_a_user_when_syncing_roles()
    {
        // Create a collection of two roles
        $roles_by_collection = create(Role::class, [], 2);
        // Assign the role by collection
        $this->user->assignRole($roles_by_collection);
        // Assert that the user has two roles
        $this->assertCount(2, $this->user->roles);
        // Remove this role by collection
        $this->user->syncRoles([]);
        // Assert that the user has bo roles
        $this->assertCount(0, $this->user->fresh()->roles);
    }

    /** @test */
    public function a_user_can_have_multiple_roles()
    {
        // Create five roles
        $roles = create(Role::class, [], 5);
        // Assert that there is five roles on the database
        $this->assertCount(5, Role::all());
        // Assign the roles to the user
        $this->user->assignRole($roles);
        // Assert that the user has five roles
        $this->assertCount(5, $this->user->roles);
    }

    /** @test */
    public function a_user_can_have_a_permission_inherited_via_a_role()
    {
        // Create a role with a specific permission
        $role = create(Role::class)->givePermissionTo(
            create(Permission::class, ['name' => 'create wineries'])
        );
        // Assert that there is a role on the database
        $this->assertCount(1, Role::all());
        // Assert that there is a permission on the database
        $this->assertCount(1, Permission::all());
        // Assign the role to the user
        $this->user->assignRole($role);
        // Assert that the user has only one role
        $this->assertCount(1, $this->user->roles);
        // Assert that the user has only one permission
        $this->assertCount(1, $this->user->getPermissionsViaRoles());
        // Assert that the user can 'create wineries'
        $this->assertTrue($this->user->can('create wineries'));
    }

    /** @test */
    public function a_user_can_have_a_permission_inherited_from_a_role_or_directly()
    {
        // Create a direct permission
        $permission = create(Permission::class, ['name' => 'invite wine makers']);
        // Create a role with an inherited permission
        $role = create(Role::class)->givePermissionTo(
            create(Permission::class, ['name' => 'create wineries'])
        );
        // Assert that there is a role on the database
        $this->assertCount(1, Role::all());
        // Assert that there are two permissions on the database
        $this->assertCount(2, Permission::all());
        // Assign the permission directly to the user
        $this->user->givePermissionTo($permission);
        // Give the role to this user, which inherits it's permission
        $this->user->assignRole($role);
        // Assert that the user has only one role
        $this->assertCount(1, $this->user->roles);
        // Assert that the user has only one permission that was given directly
        $this->assertCount(1, $this->user->getDirectPermissions());
        // Assert that the user has only one permission from it's roles
        $this->assertCount(1, $this->user->getPermissionsViaRoles());
        // Assert that the user has two permissions in total
        $this->assertCount(2, $this->user->getAllPermissions());
        // Assert that the user can 'create wineries' and 'invite wine makers'
        $this->assertTrue($this->user->can(['create wineries', 'invite wine makers']));
    }

    /** @test */
    public function a_user_can_detach_all_roles()
    {
        // Assign 5 roles to the user
        $this->user->assignRole($role = create(Role::class, [], 5));
        // Assert the user has 5 roles
        $this->assertCount(5, $this->user->roles);
        // Detach all roles
        $this->user->roles()->detach();
        // Assert that the user has no roles
        $this->assertCount(0, $this->user->fresh()->roles);
    }
}
