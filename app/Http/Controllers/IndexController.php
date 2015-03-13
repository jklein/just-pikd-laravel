<?php namespace Pikd\Http\Controllers;

class IndexController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function handleGet() {
        $controller = new \Pikd\Controllers\Base($app->user);

        $conn = $app->connections->getRead('product');
        $products = \Pikd\Model\Product::getRandomProducts($conn, $app->so_id, 8);

        $product_info_for_display = [];
        foreach ($products as $p) {
            $product_info_for_display[] = array_merge($p, [
                "image_url" => \Pikd\Image::product($p['pr_ma_id'], $p['pr_gtin']),
                "list_cost" => \Pikd\Util::formatPrice($p['list_cost']),
                "link"      => \Pikd\Controllers\Product::getLink($p['pr_sku'], $p['pr_name']),
            ]);
        }

        $data = [];
        $data['products'] = new \ArrayIterator($product_info_for_display);

        return view('index', $data);
    }

}
