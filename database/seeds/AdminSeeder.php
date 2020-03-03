<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use Carbon\Carbon;
use Faker\Factory as Faker;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('en_US');


        // Super Administrator (Role)
        $superR = Role::create([
            'name'       => 'super-admin',
            'label'       => 'Super Administrator'
        ]);

        // Administrator (Role)
        $adminR = Role::create([
            'name'       => 'admin',
            'label'       => 'Administrator'
        ]);
        
    }
}