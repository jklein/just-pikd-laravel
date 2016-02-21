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
        $p = (array)\Pikd\Daos\Product::getProductData($sku);
        $prod = new \Pikd\Models\Product($p);

        $p['image_src'] = \Pikd\Image::product($p['pr_ma_id'], $p['pr_gtin'], \Pikd\Image::FULL_SIZE);
        $p['list_cost_formatted'] = \Pikd\Util::formatPrice($p['pr_list_cost']);
        $p['list_cost_cents'] = $p['pr_list_cost'];
        $p['link_href'] = $prod->getLink();

        return view('product', $p);
    }
}
