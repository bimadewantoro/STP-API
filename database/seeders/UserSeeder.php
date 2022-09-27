<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(1)
            ->has(UserProfile::factory(1))
            ->create()
            ->each(function ($user) {
                $user->assignRole('super-admin');
            });

        User::factory()->count(1)
            ->has(UserProfile::factory(1))
            ->create()
            ->each(function ($admin) {
                $admin->assignRole('admin');
            });

        User::factory()->count(2)
        ->has(UserProfile::factory(1))
            ->create()
            ->each(function ($tenant) {
                $tenant->assignRole('tenant');
            });
        
        User::factory()->count(1)
        ->has(UserProfile::factory(1))
            ->create()
            ->each(function ($juri) {
                $juri->assignRole('juri');
            });
        
        User::factory()->count(1)
        ->has(UserProfile::factory(1))
            ->create()
            ->each(function ($mentor) {
                $mentor->assignRole('mentor');
            });
    }
}
