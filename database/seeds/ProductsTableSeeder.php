<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'pr_sku' => str_random(10),
            'pr_sku_is_real_upc' => 0,
            'pr_status' => 'Active',
            'pr_ma_id' => 1,
            'pr_cat_id' => 1,
            'pr_list_cost' => rand(1000, 10000),
            'pr_description' => 'This is a test product',
            'pr_name' => str_random(10),
        ]);


        DB::table('categories')->insert([
            'cat_id' => 1,
            'cat_name' => 'First category',
            'cat_active' => 1,
        ]);
    }
}
