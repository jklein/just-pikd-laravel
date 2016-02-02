<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    private $product_names = [
        'Apples',
        'Corn',
        'Molasses',
        'Sauerkraut',
        'Applesauce',
        'Cornmeal',
        'Muffins',
        'Sausage',
        'BabyFood',
        'Cornstarch',
        'Mushrooms',
        'Seafood',
        'BabyFormula',
        'Cornsyrup',
        'Mustard',
        'Seasoningmix',
        'Bacon',
        'Crackers',
        'Noodles/Pasta',
        'Shortening',
        'Bagels',
        'Creamcheese',
        'Cream',
        'Nuts',
        'Soup',
        'Baking Powder',
        'Whipped Cream',
        'Oatmeal',
        'Baking Soda',
        'Croutons',
        'Oil',
        'Sourcream',
        'Bananas',
        'Cucumber',
        'Olives',
        'Spaghetti',
        'Beans',
        'Cake',
        'Onion',
        'Spices',
        'Refried Beans',
        'Dips',
        'Onion Rings',
        'Stew',
        'Hamburgers',
        'Oranges',
        'Stuffing',
        'Beef Jerky',
        'Eggs',
        'Pancake Mix',
        'Brown Sugar',
        'Roast Beef',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $num_products = 100000;


        $skus = [];
        for ($i=0; $i < $num_products; $i++) {
            $skus[] = $this->makeProduct();
        }


        DB::table('categories')->insert([
            'cat_id' => 1,
            'cat_name' => 'First category',
            'cat_active' => 1,
        ]);

        for ($i=0; $i < 40; $i++) {
            $this->seedFavorite($skus[rand(0, $num_products - 1)]);
        }
    }

    private function makeProduct(){
        $sku = str_random(10);

        DB::table('products')->insert([
            'pr_sku' => $sku,
            'pr_sku_is_real_upc' => 0,
            'pr_status' => 'Active',
            'pr_ma_id' => 1,
            'pr_cat_id' => 1,
            'pr_list_cost' => rand(1000, 10000),
            'pr_description' => 'This is a test product',
            'pr_name' => $this->product_names[rand(0, count($this->product_names)-1)],
        ]);

        return $sku;
    }

    private function seedFavorite($sku) {
        DB::table('favorite_products')->insert([
            'fp_pr_sku' => $sku,
            'fp_cu_id'  => 1,
        ]);
    }
}
