<?php namespace Pikd\Http\Controllers;

use \Pikd\Models\Order;
use \Pikd\Models\OrderProduct;
use \Pikd\Models\Product;
use \Pikd\Daos\Customer;
use \Illuminate\Http\Request;
use Auth;

class CartController extends Controller {

    public function handleGet() {
        $data['title'] = sprintf("%s | Pikd", 'Shopping Cart');

        $cart_products = Customer::fetchOrderAndProducts([
            'cu_id' => \Auth::user()->cu_id,
            'so_id' => config('soid'),
            'status' => \Pikd\Enums\ORDER_STATUS::BASKET,
        ]);

        if (empty($cart_products)) {
            return view('cart_empty');
        }

        $cart = new Order($cart_products[0]);
        foreach ($cart_products as $product) {
            $cart->products[] = new OrderProduct($product);
        }

        $product_info_for_display = [];
        foreach ($cart->products as $p) {
            $product_info_for_display[] = array_merge($p->getAttributes(), [
                "image_url" => \Pikd\Image::productFromSKU($p->op_pr_sku),
                "list_cost" => \Pikd\Util::formatPrice($p->op_list_cost),
                "link"      => \Pikd\Util::productLink($p->op_pr_sku, $p->op_product_name),
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
        $data['or_id'] = $cart->or_id;

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

    public function checkout(Request $request) {
        // Get the details submitted by the form
        $token = $request->input('stripeToken');
        $amt   = $request->input('amount');
        $email = $request->input('stripeEmail');
        $or_id = $request->input('or_id');

        // Create the charge on Stripe's servers - this will charge the user's card
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        // Create the charge on Stripe's servers - this will charge the user's card
        try {
            // $charge = \Stripe\Charge::create([
            //     "amount"      => $amt,
            //     "currency"    => "usd",
            //     "source"      => $token,
            //     "description" => $email,
            // ]);
        } catch (\Stripe\Error\Card $e) {
            \Session::flash('failure', 'Your card was declined');
        }

        // Convert the basket to a pending pickup
        $order                  = Order::find($or_id);
        $order->or_status       = \Pikd\Enums\ORDER_STATUS::PROCESSING;
        $order->or_submitted_at = new \DateTime;
        $order->or_updated_at   = new \DateTime;
        $order->or_total_cost   = $amt;
        $order->or_first_name   = \Auth::user()->cu_first_name;
        $order->or_email        = $email;
        $order->save();

        \Session::flash('success', 'Order Placed!');

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
