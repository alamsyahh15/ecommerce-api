<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        User::create([
            'role_id' => Role::IS_ADMIN,
            'name' => 'Admin Test',
            'email' => 'admin@ecommerce.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'role_id' => Role::IS_USER,
            'name' => 'User Test',
            'email' => 'user@ecommerce.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'role_id' => Role::IS_MERCHANT,
            'name' => 'Merchant Test',
            'email' => 'merchant@ecommerce.com',
            'password' => Hash::make('password'),
        ]);
    }
}
