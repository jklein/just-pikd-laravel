<?php namespace Pikd\Http\Controllers;

use \Pikd\Daos\Product;

class IndexController extends Controller {

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function handleGet(\Auth $auth) {
        if ($auth::user()) {
            $fav_products = Product::getFavoriteProductsForCustomer($auth::user()->cu_id, config('soid'));
            $data['favorite_products'] = $this->formatProductDataForDisplay($fav_products);
        }

        $random_products = Product::getRandomProducts(config('soid'), 8);
        $data['random_products'] = $this->formatProductDataForDisplay($random_products);

        return view('index', $data);
    }
}
