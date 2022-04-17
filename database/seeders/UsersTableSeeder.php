<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_role = Role::admin()->first();

        User::firstOrCreate([
            'name' => 'Denys',
            'surname' => 'Admin',
            'birthdate' => '1996-02-06',
            'email' => 'admin@admin.com',
            'phone' => '+0939955555',
            'password' => Hash::make('test1234'),
            'role_id' => $admin_role->id
        ]);
        User::factory(10)->create();
    }
}
