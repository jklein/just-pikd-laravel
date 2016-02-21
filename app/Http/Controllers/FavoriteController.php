<?php namespace Pikd\Http\Controllers;

use Pikd\Http\Requests;
use Pikd\Http\Controllers\Controller;
use Pikd\Daos\Product;
use Pikd\Models\FavoriteProduct;

use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;

class FavoriteController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($user_id)
    {
        $redis = Redis::connection();

        // $cached_products = $redis->get('favorites:' . $user_id);
        $cached_products = false;

        if (!$cached_products) {
            $products_for_display = Product::getFavoriteProductsForCustomer($user_id);
            $redis->set('favorites:' . $user_id, json_encode($products_for_display));
        } else {
            $products_for_display = json_decode($cached_products, true);
        }

        $data['products'] = $this->formatProductDataForDisplay($products_for_display);

        return view('favorites', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $req, \Auth $auth)
    {
        $p = FavoriteProduct::firstOrNew([
            'fp_pr_sku' => $req->input('pr_sku'),
            'fp_cu_id'  => $auth::user()->cu_id,
        ]);

        if ($p->exists === false) {
            $p->save();
        }

        return $p->fp_id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $fp = FavoriteProduct::find($id);
        $fp->delete();
    }
}
