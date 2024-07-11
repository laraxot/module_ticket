<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Ticket\Models\User;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (0 == User::where('email', 'john.doe@helper.app')->count()) {
            $user = User::create([
                'name' => 'John DOE',
                'email' => 'john.doe@helper.app',
                'password' => bcrypt('Passw@rd'),
                'email_verified_at' => now(),
            ]);
            $user->creation_token = null;
            $user->save();
        }
    }
}
