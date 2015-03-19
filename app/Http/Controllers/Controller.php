<?php namespace Pikd\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

    public function getFlashData() {
        $ret = [];
        foreach (\Session::get('flash.old') as $key) {
            $ret[$key] = \Session::get($key);
        }

        return $ret;
    }

    public function formatProductDataForDisplay($products) {
        $product_info_for_display = [];
        foreach ($products as $p) {
            $prod = new \Pikd\Models\Product($p);

            $product_info_for_display[] = array_merge($p, [
                "image_url" => \Pikd\Image::product($prod->pr_ma_id, $prod->pr_gtin),
                "list_cost" => \Pikd\Util::formatPrice($p['list_cost']),
                "link"      => $prod->getLink(),
            ]);
        }

        return new \ArrayIterator($product_info_for_display);
    }
}
