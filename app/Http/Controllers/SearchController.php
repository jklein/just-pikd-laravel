<?php namespace Pikd\Http\Controllers;

use Pikd\Http\Requests;
use Pikd\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SearchController extends Controller {

	public function handleSearch(Request $r) {
        $query = $r->input('q');

        $products = \Pikd\Daos\Product::search($query);

        $data['products'] = $this->formatProductDataForDisplay($products);

        return view('search_results', $data);
    }

}
