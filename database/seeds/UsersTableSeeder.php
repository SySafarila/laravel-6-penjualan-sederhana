<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        // generating admin
        DB::table('users')->insert([
            'name' => 'Seller',
            'email' => 'seller@seller.com',
            'password' => Hash::make('password'),
            'role_id' => '1', // seller
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // generating buyer
        DB::table('users')->insert([
            'name' => 'Buyer',
            'email' => 'buyer@buyer.com',
            'password' => Hash::make('password'),
            'role_id' => '2', // buyer
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
