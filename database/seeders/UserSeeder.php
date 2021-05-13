<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::factory()
            ->state([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'phone' => '09000000000',
            ])
            ->hasCategory(5)
            ->count(1)
            ->create();
    }
}
