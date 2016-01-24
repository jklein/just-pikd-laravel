<?php namespace Pikd\Http\Controllers;

use Pikd\Http\Requests;
use Pikd\Http\Controllers\Controller;
use Pikd\Daos\Product;
use Pikd\Models\FavoriteProduct;
use Pikd\Models\Category;


use Illuminate\Http\Request;

class CategoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($cat_id)
    {
        $categories = Category::where('cat_id', 1)->get();
        dd($categories);

        $products = Product::getProductsForCategory($cat_id);

        $data['products'] = $this->formatProductDataForDisplay($products);

        return view('category', $data);
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
