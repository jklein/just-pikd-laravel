<?php namespace Pikd\Daos;

use \DB;
use \Pikd\Models\Order;

class Customer {

    public static function fetchOrderAndProducts($cu_id, $so_id, $status) {
        $sql = 'SELECT * FROM orders 
                join order_products on or_id = op_or_id 
                where or_cu_id = ? 
                and or_so_id = ?
                and or_status = ?';

        return DB::connection('customer')->select($sql, [$cu_id, $so_id, $status]);
    }

    public static function createOrFetchOrder($cu_id, $so_id, $status) {
        $order = Order::firstOrNew([
            'or_cu_id' => $cu_id,
            'or_so_id' => $so_id,
            'or_status' => $status,
        ]);

        if ($order->exists === false) {
            // Create the order
            $order->save();
        }

        return $order;
    }
}