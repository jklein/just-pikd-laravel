<?php namespace Pikd\Daos;

use \DB;

class Product {

    // This should not get called in production 
    public static function getRandomProducts($so_id, $num) {
        $sql = 'SELECT * from products 
                    join products_stores on pr_sku = sku
                    join categories on pr_cat_id = cat_id
                    where store_id = ?
                    order by random()
                    limit ?';


        return DB::select($sql, [$so_id, $num]);
    }
}