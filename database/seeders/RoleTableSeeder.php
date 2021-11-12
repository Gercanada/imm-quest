<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'description' => 'CP admin'
        ])->givePermissionTo(Permission::all());

        Role::create([
            'name' => 'client',
            'description' => 'CP user'
        ]);
    }
}
