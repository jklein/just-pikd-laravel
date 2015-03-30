<?php namespace Pikd\Http\Controllers;

use Pikd\Http\Requests;
use Pikd\Http\Controllers\Controller;
use Pikd\Daos\Product;

use Illuminate\Http\Request;

class FavoriteController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(\Auth $auth)
    {
        $products = Product::getFavoriteProductsForCustomer($auth::user()->cu_id, config('soid'));

        $data['products'] = $this->formatProductDataForDisplay($products);

        return view('favorites', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $req, \Auth $auth)
    {
        $pr_sku = $req->input('pr_sku');
        $cu_id  = $auth::user()->cu_id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
