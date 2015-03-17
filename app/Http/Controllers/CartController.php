<?php namespace Pikd\Http\Controllers;

use \Pikd\Models\Order;
use \Pikd\Models\OrderProduct;
use \Pikd\Models\Product;
use \Pikd\Daos\Customer;
use \Illuminate\Http\Request;
use Auth;

class CartController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function handleGet() {
        $data['title'] = sprintf("%s | Pikd", 'Shopping Cart');

        $cart_products = Customer::fetchOrderAndProducts(
            \Auth::user()->cu_id, 
            config('soid'),
            \Pikd\Enums\ORDER_STATUS::BASKET
        );

        $cart = new Order((array)$cart_products[0]);
        foreach ($cart_products as $product) {
            $cart->products[] = new OrderProduct((array)$product);
        }

        $product_info_for_display = [];
        foreach ($cart->products as $p) {
            $product_info_for_display[] = array_merge($p->getAttributes(), [
                "image_url" => \Pikd\Image::productFromSKU($p->op_pr_sku),
                "list_cost" => \Pikd\Util::formatPrice($p->op_list_cost),
                "link"      => \Pikd\Util::productLink($p['op_pr_sku'], $p['op_product_name']),
                "sub_total" => \Pikd\Util::formatPrice($p->op_list_cost * $p->op_qty),
            ]);
        }

        $total_price = $this->getTotalPriceInCents($cart->products);

        $data['cart_products'] = new \ArrayIterator($product_info_for_display);
        $data['cart_totals'] = [
            'display_price' => \Pikd\Util::formatPrice($total_price),
            'numeric_price' => $total_price,
            'num_products'  => count($cart_products),
        ];
        $data['stripe_config'] = config('services.stripe');


        return view('cart', $data);
    }

    public function handlePost(Request $request) {
        $pr_sku    = $request->input('pr_sku');
        $pr_name   = $request->input('pr_name');
        $list_cost = $request->input('list_cost');
        $ma_name   = $request->input('ma_name');
        $qty       = $request->input('qty');
        $cu_id     = Auth::user()->cu_id;

        $cart = Customer::createOrFetchOrder(
            $cu_id, 
            config('soid'), 
            \Pikd\Enums\ORDER_STATUS::BASKET
        );

        $product = OrderProduct::firstOrNew([
            'op_or_id'             => $cart->or_id,
            'op_pr_sku'            => $pr_sku,
            'op_product_name'      => $pr_name,
            'op_list_cost'         => $list_cost,
            'op_manufacturer_name' => $ma_name,
        ]);
        $product->op_qty += $qty;
        $product->save();

        return redirect('cart');
    }

    public function getTotalPriceInCents($products){
        $total = 0;
        foreach ($products as $p) {
            $total += $p['op_list_cost'] * $p['op_qty'];
        }

        return $total;
    }

}