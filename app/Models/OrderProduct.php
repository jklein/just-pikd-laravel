<?php namespace Pikd\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model {

    protected $primaryKey = 'op_id';
    protected $connection = 'customer';
    public $timestamps = false;

    protected $fillable = [
        'op_or_id',
        'op_pr_sku',
        'op_qty',
        'op_product_name',
        'op_manufacturer_name',
        'op_list_cost',
        'op_date_added',
        'op_date_updated',
    ];
}
