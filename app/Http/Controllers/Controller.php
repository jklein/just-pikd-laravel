<?php namespace Pikd\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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

            $product_info_for_display[] = [
                "pr_sku"          => $p['pr_sku'],
                "pr_name"         => 'A Demo Product',
                "cat_name"        => $p['cat_name'],
                "image_url"       => \Pikd\Image::product($prod->pr_ma_id, $prod->pr_gtin),
                "list_cost_cents" => $prod->pr_list_cost,
                "list_cost_fmt"   => \Pikd\Util::formatPrice($prod->pr_list_cost),
                "link"            => $prod->getLink(),
                "inventory"       => 100, //TODO: Make this not fake
            ];
        }

        return new \ArrayIterator($product_info_for_display);
    }

    public function jsonifyProductData($data) {
        $output = [];
        foreach ($data as $product) {
            $output[$product['pr_sku']] = $product;
        }

        return json_encode($output);
    }

    /**
     * {@inheritdoc}
     */
    protected function formatValidationErrors(Validator $validator) {
        $errors = $validator->errors()->all();

        \Session::flash('danger', $errors);

        return $errors;
    }
}
