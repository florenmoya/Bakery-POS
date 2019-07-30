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
  array('id' => '1','category_name' => 'Bread','created_at' => '2019-06-18 11:39:12','updated_at' => '2019-06-18 11:39:12'),
  array('id' => '2','category_name' => 'Cigarettes','created_at' => '2019-06-18 11:39:12','updated_at' => '2019-06-18 11:39:12'),
  array('id' => '3','category_name' => 'Cake','created_at' => '2019-06-18 11:39:12','updated_at' => '2019-06-18 11:39:12'),
  array('id' => '4','category_name' => 'Biscuits','created_at' => '2019-06-18 11:39:12','updated_at' => '2019-06-18 11:39:12'),
  array('id' => '5','category_name' => 'Candy','created_at' => '2019-06-18 11:39:12','updated_at' => '2019-06-18 11:39:12'),
  array('id' => '6','category_name' => 'Canton','created_at' => '2019-06-18 11:39:12','updated_at' => '2019-06-18 11:39:12'),
  array('id' => '7','category_name' => 'Cigarettes Pack','created_at' => '2019-06-18 11:39:12','updated_at' => '2019-06-18 11:39:12'),
  array('id' => '8','category_name' => 'Coffee','created_at' => '2019-06-18 11:39:12','updated_at' => '2019-06-18 11:39:12'),
  array('id' => '9','category_name' => 'Drinks','created_at' => '2019-06-18 11:39:12','updated_at' => '2019-06-18 11:39:12'),
  array('id' => '10','category_name' => 'Softdrinks','created_at' => '2019-06-18 11:39:12','updated_at' => '2019-06-18 11:39:12'),
  array('id' => '11','category_name' => 'Hygine','created_at' => '2019-06-18 11:39:12','updated_at' => '2019-06-18 11:39:12'),
  array('id' => '12','category_name' => 'Others','created_at' => '2019-06-18 11:39:12','updated_at' => '2019-06-18 11:39:12'),
  array('id' => '13','category_name' => 'Palaman','created_at' => '2019-06-18 11:39:12','updated_at' => '2019-06-18 11:39:12'),
  array('id' => '14','category_name' => 'Powdered Juice','created_at' => '2019-06-18 11:39:12','updated_at' => '2019-06-18 11:39:12'),
  array('id' => '15','category_name' => 'Snacks','created_at' => '2019-06-18 11:39:12','updated_at' => '2019-06-18 11:39:12'),
  array('id' => '16','category_name' => 'Soap','created_at' => '2019-06-18 11:39:12','updated_at' => '2019-06-18 11:39:12'),
  array('id' => '17','category_name' => 'Washing Liquid','created_at' => '2019-06-18 11:39:12','updated_at' => '2019-06-18 11:39:12'),
  array('id' => '18','category_name' => 'Load','created_at' => '2019-06-25 20:33:42','updated_at' => '2019-06-25 20:33:42'),
  array('id' => '19','category_name' => 'Others','created_at' => '2019-07-03 22:32:17','updated_at' => '2019-07-03 22:32:18')
        ]);
    }
}
