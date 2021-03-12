<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     *
     * @return void
     */
    public function run()
    {
        $contentCreators = collect([
            'notadmin@localhost',
            'admin@localhost',
        ])->map(fn ($email) => User::factory()->state(['email' => $email])->create());

        $contentCreators
            ->first(fn ($user) => $user->email === 'admin@localhost')
            ->assignRole(User::ROLES['ADMIN']);

        User::factory()->count(10)->create();

    }
}
