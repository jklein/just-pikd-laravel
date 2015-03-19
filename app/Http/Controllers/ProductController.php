<?php namespace Pikd\Http\Controllers;

use \Pikd\Models\Product;

class ProductController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
    }

    public function handleGet($sku, $slug) {
        $p = (array)\Pikd\Daos\Product::getProductData(config('soid'), $sku);

        $p['image_src'] = \Pikd\Image::product($p['pr_ma_id'], $p['pr_gtin'], \Pikd\Image::FULL_SIZE);
        $p['list_cost_formatted'] = \Pikd\Util::formatPrice($p['list_cost']);
        $p['list_cost_cents'] = $p['list_cost'];

        return view('product', $p);
    }

}