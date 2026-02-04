<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $moderator = Role::create(['name' => 'moderator']);
        $user = Role::create(['name' => 'user']);


        Permission::create(['name' => 'view.users'])->syncRoles([$moderator]);
        Permission::create(['name' => 'edit.users']);
        Permission::create(['name' => 'delete.users']);

        Permission::create(['name' => 'create.posts'])->syncRoles([$moderator, $user]);
        Permission::create(['name' => 'view.posts'])->syncRoles([$moderator, $user]);
        Permission::create(['name' => 'edit.posts']);
        Permission::create(['name' => 'delete.posts']);

        Permission::create(['name' => 'create.comments'])->syncRoles([$moderator, $user]);
        Permission::create(['name' => 'view.comments'])->syncRoles([$moderator, $user]);
        Permission::create(['name' => 'edit.comments']);
        Permission::create(['name' => 'delete.comments']);

        $admin->givePermissionTo(Permission::all());
        
    }
}
