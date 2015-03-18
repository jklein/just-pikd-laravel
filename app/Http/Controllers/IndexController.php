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

        $product_info_for_display = [];
        foreach ($products as $p) {
            $prod = new \Pikd\Models\Product($p);

            $product_info_for_display[] = array_merge($p, [
                "image_url" => \Pikd\Image::product($prod->pr_ma_id, $prod->pr_gtin),
                "list_cost" => \Pikd\Util::formatPrice($p['list_cost']),
                "link"      => $prod->getLink(),
            ]);
        }

        $data = [];
        $data['products'] = new \ArrayIterator($product_info_for_display);

        return view('index', $data);
    }

}
