<?php namespace Pikd\Http\Controllers;

use \Pikd\Models\Product;

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
        //$products = Product::first();
        $products = Product::all()->random(8);

        $product_info_for_display = [];
       foreach ($products as $p) {
           $product_info_for_display[] = array_merge((array)$p->getAttributes(), [
               "image_url" => \Pikd\Image::product($p->pr_ma_id, $p->pr_gtin),
               "list_cost" => \Pikd\Util::formatPrice($p->pr_list_cost),
               "link"      => $p->getLink(),
            ]);
       }

        $data = [];
        $data['products'] = new \ArrayIterator($product_info_for_display);

        return view('index', $data);
    }

}
