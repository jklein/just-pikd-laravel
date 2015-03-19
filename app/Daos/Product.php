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

    public static function search($query) {
        // TODO - Injection potential. 
        // For some reason the binding didn't work for multi-word queries
        // So I just did the naiive thing for now
        $sql = "SELECT p.pr_name, pr_ma_id, pr_gtin, 
                cat_name, list_cost
                from search_index 
                join products p on search_index.pr_sku = p.pr_sku
                join products_stores ps on search_index.pr_sku = ps.sku
                join categories on p.pr_cat_id = cat_id
                join manufacturers on p.pr_ma_id = ma_id
                where document @@ plainto_tsquery('english', '" . $query . "')
                order by ts_rank(document, plainto_tsquery('english', '" . $query . "')) desc;";

        return DB::select($sql);
    }
}