<?php namespace Pikd\Http\Controllers;

use Pikd\Http\Requests;
use Pikd\Http\Controllers\Controller;
use Pikd\Models\Order;

use Illuminate\Http\Request;

class OrderController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $data['title'] = sprintf("%s | Pikd", 'Order History');

        $orders = Order::where('or_cu_id', '=', \Auth::user()->cu_id)->get();
        
        foreach ($orders as $order) {
            if (empty($order->or_submitted_at)) {
                $date = $order->or_updated_at;
            } else {
                $date = $order->or_submitted_at;
            }

            $data['orders'][] = [
                'id'     => $order->or_id,
                'date'   => date('Y-m-d H:i:s', strtotime($date)),
                'status' => $order->or_status,
                'cost'   => \Pikd\Util::formatPrice($order->or_total_cost),
            ];
        }

        return view('orders', $data);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $order = Order::find($id);
        $data['order'] = $order->getAttributes();

        $products = \Pikd\Daos\Customer::fetchOrderAndProducts([
        	'or_id' => $id,
        ]);

        $order = new Order($products[0]);
        foreach ($products as $product) {
            $order->products[] = new OrderProduct($product);
        }

        return view('order', $data);
	}

}
