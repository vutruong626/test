<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
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
        User::truncate();
        DB::table('role_user')->truncate();
        
        $adminRole = Role::where('name','admin')->first();
        $manageRole = Role::where('name','manage')->first();
        $userRole = Role::where('name','user')->first();
        $clientRole = Role::where('name','client')->first();

        $admin = User::create([
            'username' =>'Admin',
            'fullname' => 'Nguyen va a',
            'phone' => 9452456546,
            'address' => '777',
            'email' =>'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $manage = User::create([
            'username' =>'Manage',
            'fullname' => 'Nguyen va b',
            'phone' => 9452456546,
            'address' => '777',
            'email' =>'manage@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $user = User::create([
            'username' =>'User',
            'fullname' => 'Nguyen va c',
            'phone' => 9442334,
            'address' => '777',
            'email' =>'user@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $client = User::create([
            'username' =>'Client',
            'fullname' => 'Nguyen va d',
            'phone' => 945243232,
            'address' => '777',
            'email' =>'client@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $admin->roles()->attach($adminRole);
        $manage->roles()->attach($manageRole);
        $user->roles()->attach($userRole);
        $client->roles()->attach($clientRole);
    }
}
