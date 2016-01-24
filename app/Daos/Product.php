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

        // TODO handle null case
        return DB::select($sql, [$sku])[0];
    }

    public static function search($query) {
        // TODO - Injection potential.
        // TODO - This is what we should tweak to improve search quality
        // For some reason the binding didn't work for multi-word queries
        // So I just did the naiive thing for now
        $sql = "SELECT p.pr_sku, p.pr_name, pr_ma_id, pr_gtin,
                cat_name, ps_list_cost
                from search_index
                join products p on search_index.pr_sku = p.pr_sku
                join products_stores ps on search_index.pr_sku = ps.ps_pr_sku
                join categories on p.pr_cat_id = cat_id
                join manufacturers on p.pr_ma_id = ma_id
                where document @@ plainto_tsquery('english', '" . $query . "')
                and ts_rank(document, plainto_tsquery('english', '" . $query . "')) > 0.5
                order by ts_rank(document, plainto_tsquery('english', '" . $query . "')) desc, cat_name;";

        return DB::select($sql);
    }

    public static function getFavoriteProductsForCustomer($cu_id) {
        $sql = "SELECT * from favorite_products
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
