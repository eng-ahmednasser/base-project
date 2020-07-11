<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions[] = Permission::create(['name' => 'access dashboard']);
        $permissions[] = Permission::create(['name' => 'show users']);
        $permissions[] = Permission::create(['name' => 'edit users']);
        $permissions[] = Permission::create(['name' => 'create users']);
        $permissions[] = Permission::create(['name' => 'delete users']);
        $permissions[] = Permission::create(['name' => 'show roles']);
        $permissions[] = Permission::create(['name' => 'create roles']);
        $permissions[] = Permission::create(['name' => 'edit roles']);
        $permissions[] = Permission::create(['name' => 'delete roles']);
        $permissions[] = Permission::create(['name' => 'show tickets']);
        $permissions[] = Permission::create(['name' => 'create tickets']);
        $permissions[] = Permission::create(['name' => 'edit tickets']);
        $permissions[] = Permission::create(['name' => 'delete tickets']);

        $admin = Role::create(['name' => 'admin']);
        $user = User::create([
            'name' => 'Admin',
            'email' => 'ahmed@admin.com',
            'isSuperAdmin' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
        ]);
        $admin->syncPermissions($permissions);
        $user->assignRole($admin);
        $user->givePermissionTo($permissions);

    }
}
