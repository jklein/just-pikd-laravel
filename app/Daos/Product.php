<?php namespace Pikd\Daos;

use \DB;

class Product {

    // This should not get called in production
    public static function getRandomProducts($num) {
        $sql = 'SELECT * from products
                    join categories on pr_cat_id = cat_id
                    order by RAND()
                    limit ?';


        return DB::select($sql, [$num]);
    }

    public static function getProductData($sku) {
        $sql = 'SELECT * from products
                    join categories on pr_cat_id = cat_id
                    and pr_sku = ?';

        return DB::select($sql, [$sku])[0];
    }

    public static function getFavoriteProductsForCustomer($cu_id) {
        $sql = "SELECT * from favorite_products fp
                    join products p on fp.fp_pr_sku = p.pr_sku
                    join categories on pr_cat_id = cat_id
                    where fp_cu_id = ?";

        return DB::select($sql, [$cu_id]);
    }

    public static function getProductsForCategory($cat_id) {
        $sql = 'SELECT * from products
                    join categories on pr_cat_id = cat_id
                    where cat_id = ?
                    limit 40';


        return DB::select($sql, [$cat_id]);
    }
}
