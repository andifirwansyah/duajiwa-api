<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Andi Firwansyah',
            'phone' => '089674462657',
            'email' => 'andifirwansyah@duajiwa.com',
            'password' => Hash::make('12345'),
            'is_admin' => true
        ]);
    }
}
