<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert(array(
        	array(
                'name' => "Steve",
                'email' => 'steve@gmail.com',
                'password' => bcrypt('secret'),
        	),
        	array(
                'name' => "admin",
                'email' => 'admin@digiso.com',
                'password' => bcrypt('admin1234'),
        	)
        ));
    }
}
