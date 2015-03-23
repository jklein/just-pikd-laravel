<?php namespace Pikd\Daos;

use \DB;
use \Pikd\Models\Order;

class Customer {

    public static function fetchOrderAndProducts($input) {
        $sql = 'SELECT * FROM orders 
                join order_products on or_id = op_or_id ';

        if (isset($input['or_id'])) {
            $where = 'WHERE or_id = ?';
            $sql .= $where;
            return DB::connection('customer')->select($sql, [$input['or_id']]);
        } else {
            if (!(isset($input['cu_id']) && isset($input['so_id']) && isset($input['status']))) {
                Log::error('Invalid input to fetchOrderAndProducts: ' . serialize($input));
                throw new Exception('Invalid Input');
            }
            $where = 'where or_cu_id = ? 
                        and or_so_id = ?
                        and or_status = ?';

            $sql .= $where;
            $bind = [$input['cu_id'], $input['so_id'], $input['status']];
            return DB::connection('customer')->select($sql, $bind);
        }
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
