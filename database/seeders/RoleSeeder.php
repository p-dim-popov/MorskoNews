<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            User::ROLES['ADMIN'],
            User::ROLES['REGULAR'],
        ])->each(fn ($roleName) => Role::create(['name' => $roleName]));
    }
}
