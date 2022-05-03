<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

	$role1 = Role::create(['name' => 'super-admin']);
	$role2 = Role::create(['name' => 'admin']);
	$role3 = Role::create(['name' => 'packer']);
	$role4 = Role::create(['name' => 'reciever']);

	$perm1 = Permission::create(['name' => 'read']);
	$perm2 = Permission::create(['name' => 'write']);
	$perm3 = Permission::create(['name' => 'limited-read']);
	$perm4 = Permission::create(['name' => 'god']);

	$role1->givePermissionTo($perm1);	
	$role1->givePermissionTo($perm2);	
	$role1->givePermissionTo($perm3);	
	$role1->givePermissionTo($perm4);	

	$role1->syncPermissions([$perm1, $perm2, $perm3, $perm4]);
	$role2->syncPermissions([$perm1, $perm2, $perm3]);
	$role4->syncPermissions([$perm3]);

	
	$user = \App\Models\User::factory()->create([
	    'name' => 'superadmin',
	    'email' => 'sa@example.com',
        ]);
        $user->assignRole($role1);


        $user = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'a@example.com',
        ]);
        $user->assignRole($role2);

	 $user = \App\Models\User::factory()->create([
            'name' => 'packer',
            'email' => 'p@example.com',
        ]);

        $user->assignRole($role3);

        $user = \App\Models\User::factory()->create([
            'name' => 'reciever',
            'email' => 'r@example.com',
        ]);
        $user->assignRole($role4);
    }
}
