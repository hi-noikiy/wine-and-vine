<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('wine-and-vine.data.roles') as $data) {
            $role = create(Role::class, [
                'name' => $data['name'],
                'guard_name' => $data['guard_name'],
                'created_at' => Carbon::now(),
                'updated_at' => null
            ]);

            foreach ($data['permissions'] as $permission) {
                $role->givePermissionTo(
                    create(Permission::class, [
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                        'created_at' => Carbon::now(),
                        'updated_at' => null
                    ])
                );
            }
        }
    }
}
