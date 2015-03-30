<?php namespace Pikd\Http\Controllers;

use \Pikd\Daos\Product;

class IndexController extends Controller {

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function handleGet(\Auth $auth) {
        $fav_products = Product::getFavoriteProductsForCustomer($auth::user()->cu_id, config('soid'));
        $random_products = Product::getRandomProducts(config('soid'), 8);

        $data['favorite_products'] = $this->formatProductDataForDisplay($fav_products);
        $data['random_products'] = $this->formatProductDataForDisplay($random_products);

        return view('index', $data);
    }
}
