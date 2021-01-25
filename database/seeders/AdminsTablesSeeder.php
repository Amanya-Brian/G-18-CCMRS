<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminsTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'username'    => 'Amanya Brian',
            'password'   =>  Hash::make('laravel')
        ]);
        DB::table('admins')->insert([
            'username'    => 'Nangeso Roy',
            'password'   =>  Hash::make('makerere')
        ]);
    }
}
