<?php namespace Pikd\Http\Controllers;

class IndexController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('guest');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function handleGet() {
        $products = \Pikd\Daos\Product::getRandomProducts(config('soid'), 8);

        $data['products'] = $this->formatProductDataForDisplay($products);

        return view('index', $data);
    }
}
