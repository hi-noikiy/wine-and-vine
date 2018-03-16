<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_role_can_be_created()
    {
        $role = Role::create(['name' => 'admin']);

        $this->assertDatabaseHas('roles', $role->toArray());

        $this->assertEquals('admin', $role->name);
    }

    /** @test */
    public function a_role_can_have_a_permission()
    {
        // create a Role
        $role = create(Role::class);
        // Create a Permission
        $permission = create(Permission::class);
        // Add a permission to the role
        $role->givePermissionTo($permission);
        // Assert that the role has one permission
        $this->assertCount(1, $role->permissions);
        // Assert that the role's permission is that specific permission
        $this->assertEquals($permission->name, $role->permissions->first()->name);
    }

    /** @test */
    public function a_role_can_have_many_permissions()
    {
        // create a Role
        $role = create(Role::class);
        // Create a Permission
        $permissions = create(Permission::class, [], 5);
        // Add a permission to the role
        $role->givePermissionTo($permissions);
        // Assert that the role has one permission
        $this->assertCount(5, $role->permissions);
        // Assert that the collection only has Permissions
        $this->assertContainsOnlyInstancesOf(Permission::class, $role->permissions);
    }

    /** @test */
    public function a_role_can_revoke_a_permission()
    {
        // Create a role with 5 permissions attached
        $role = create(Role::class)->givePermissionTo([
            $permissions = create(Permission::class, [], 5)
        ]);
        // Assert that the role has 5 permissions
        $this->assertCount(5, $role->permissions);
        // Grab 1 of the 5 permissions
        $permission_to_remove = $permissions->take(1);
        // Remove that permission
        $role->revokePermissionTo($permission_to_remove);
        // Assert that the role only has 1 permission
        $this->assertCount(4, $role->fresh()->permissions);
    }

    /** @test */
    public function a_role_can_revoke_many_permissions()
    {
        // Create a role with 5 permissions attached
        $role = create(Role::class)->givePermissionTo([
            $permissions = create(Permission::class, [], 5)
        ]);
        // Assert that the role has 5 permissions
        $this->assertCount(5, $role->permissions);
        // Grab 3 of the 5 permissions
        $permission_to_remove = $permissions->take(3);
        // Remove these 3 permissions
        $role->revokePermissionTo($permission_to_remove);
        // Assert that the role only has 2 permissions
        $this->assertCount(2, $role->fresh()->permissions);
    }

    /** @test */
    public function a_role_can_drop_every_permissions_and_sync_the_new_ones()
    {
        // Create a role with 5 permissions attached
        $role = create(Role::class)->givePermissionTo([
            create(Permission::class, [], 5)
        ]);
        // Assert that the role has 5 permissions
        $this->assertCount(5, $role->permissions);
        // Create 2 permissions to substitute the role's permissions
        $permissions = create(Permission::class, [], 2);
        // Sync the role's permissions
        $role->syncPermissions($permissions);
        // Assert that the role has the 2 newest permissions
        $this->assertCount(2, $role->fresh()->permissions);
    }
}