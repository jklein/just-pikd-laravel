<?php namespace Pikd\Http\Controllers;

use \Pikd\Daos\Product;

class IndexController extends Controller {

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function handleGet(\Auth $auth) {
        $random_products = Product::getRandomProducts(16);
        $data['random_products'] = $this->formatProductDataForDisplay($random_products);
        $data['random_products_json'] = $this->jsonifyProductData($data['random_products']);

        return view('index', $data);
    }
}
