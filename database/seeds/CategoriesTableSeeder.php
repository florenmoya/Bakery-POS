<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
             DB::table('categories')->insert([
  array('id' => '1','title' => 'Bread','created_at' => '2019-06-18 03:39:12','updated_at' => '2019-06-18 03:39:12'),
  array('id' => '2','title' => 'Cigarettes','created_at' => '2019-06-18 03:39:12','updated_at' => '2019-06-18 03:39:12'),
  array('id' => '3','title' => 'Cake','created_at' => '2019-06-18 03:39:12','updated_at' => '2019-06-18 03:39:12'),
  array('id' => '4','title' => 'Biscuits','created_at' => '2019-06-18 03:39:12','updated_at' => '2019-06-18 03:39:12'),
  array('id' => '5','title' => 'Candy','created_at' => '2019-06-18 03:39:12','updated_at' => '2019-06-18 03:39:12'),
  array('id' => '6','title' => 'Canton','created_at' => '2019-06-18 03:39:12','updated_at' => '2019-06-18 03:39:12'),
  array('id' => '7','title' => 'Cigarettes Pack','created_at' => '2019-06-18 03:39:12','updated_at' => '2019-06-18 03:39:12'),
  array('id' => '8','title' => 'Coffee','created_at' => '2019-06-18 03:39:12','updated_at' => '2019-06-18 03:39:12'),
  array('id' => '9','title' => 'Drinks','created_at' => '2019-06-18 03:39:12','updated_at' => '2019-06-18 03:39:12'),
  array('id' => '10','title' => 'Softdrinks','created_at' => '2019-06-18 03:39:12','updated_at' => '2019-06-18 03:39:12'),
  array('id' => '11','title' => 'Hygine','created_at' => '2019-06-18 03:39:12','updated_at' => '2019-06-18 03:39:12'),
  array('id' => '12','title' => 'Others','created_at' => '2019-06-18 03:39:12','updated_at' => '2019-06-18 03:39:12'),
  array('id' => '13','title' => 'Palaman','created_at' => '2019-06-18 03:39:12','updated_at' => '2019-06-18 03:39:12'),
  array('id' => '14','title' => 'Powdered Drinks','created_at' => '2019-06-18 03:39:12','updated_at' => '2019-08-20 05:06:35'),
  array('id' => '15','title' => 'Snacks','created_at' => '2019-06-18 03:39:12','updated_at' => '2019-06-18 03:39:12'),
  array('id' => '16','title' => 'Soap','created_at' => '2019-06-18 03:39:12','updated_at' => '2019-06-18 03:39:12'),
  array('id' => '17','title' => 'Washing Liquid','created_at' => '2019-06-18 03:39:12','updated_at' => '2019-06-18 03:39:12'),
  array('id' => '18','title' => 'Load','created_at' => '2019-06-25 12:33:42','updated_at' => '2019-06-25 12:33:42'),
  array('id' => '19','title' => 'Others','created_at' => '2019-07-03 14:32:17','updated_at' => '2019-07-03 14:32:18'),
  array('id' => '20','title' => 'test','created_at' => '2019-08-21 02:59:43','updated_at' => '2019-08-21 02:59:43')
        ]);
    }
}
