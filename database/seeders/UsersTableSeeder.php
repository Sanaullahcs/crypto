<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')
        ->where('email', 'CryptoWizGuy@gmail.com')
        ->update(['is_superadmin' => 1]);

        // DB::table('users')->insert([
        //     'first_name' => 'admin',
        //     'last_name' => 'admin',
        //     'email' => 'info@cryptowizguy.com',
        //     'password' => Hash::make('password'),
        //     'is_admin' => 1,
        //     'email_verified_at' => now(),
        // ]);
    }

}
