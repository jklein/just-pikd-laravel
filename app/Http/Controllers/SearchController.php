<?php namespace Pikd\Http\Controllers;

use Pikd\Http\Requests;
use Pikd\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SearchController extends Controller {

	public function handleSearch(Request $r) {
        $query = $r->input('q');

        $products = \Pikd\Daos\Product::search($query);
        $product_data = $this->formatProductDataForDisplay($products);

        // Now we need to break the products up into their categories
        // This could probably be done in a smarter way, but it works for now
        $categories = [];
        foreach ($product_data as $product) {
            $categories[$product['cat_name']][] = $product;
        }

        $cats_for_display = [];
        foreach ($categories as $key => $value) {
            $cats_for_display[] = [
                'name' => $key,
                'products' => $value,
            ];
        }

        $data['categories'] = new \ArrayIterator($cats_for_display);

        return view('search_results', $data);
    }

}
