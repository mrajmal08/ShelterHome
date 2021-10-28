<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $admin = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'permissions' => [
                'admin' => true,
            ]
        ]);
        $volunter = Role::create([
            'name' => 'Volunter',
            'slug' => 'volunter',
            'permissions' => [
                'volunter' => true,
            ]
        ]);
    }
}
