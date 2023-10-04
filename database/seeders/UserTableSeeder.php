<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->insert([
            'name'=>'mgkyawn',
            'email'=>'kyawntharmdy@gmail.com',
            'password'=>bcrypt('123123')
        ]);
    }
}
