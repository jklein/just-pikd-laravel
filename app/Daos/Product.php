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

    public static function getProductData($so_id, $sku) {
        $sql = 'SELECT * from products 
                    join products_stores on pr_sku = sku
                    join categories on pr_cat_id = cat_id
                    join manufacturers on pr_ma_id = ma_id
                    where store_id = ?
                    and pr_sku = ?';

        // TODO handle null case
        return DB::select($sql, [$so_id, $sku])[0];
    }
}