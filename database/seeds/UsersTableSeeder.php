<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	        DB::table('users')->insert([

  array('id' => '1','name' => 'kyawkyaw','username' => 'kyawkyaw','password' => '$2y$10$0RBIEoury6di6WXlE1dTNOY/CZfosLMD1Bg9.SKfDwPKpmAWTvgRO','remember_token' => NULL,'created_at' => '2019-08-06 22:38:01','updated_at' => '2019-08-06 22:38:01')
]);
    }
}
