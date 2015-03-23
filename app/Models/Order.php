<?php namespace Pikd\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $primaryKey = 'or_id';
    protected $connection = 'customer';
    public $timestamps = false;

    public $products = [];

    protected $fillable = [
        'or_id',
        'or_so_id',
        'or_cu_id',
        'or_status',
        'or_created_at',
        'or_updated_at',
        'or_submitted_at',
        'or_total_cost',
        'or_first_name',
        'or_middle_name',
        'or_last_name',
        'or_email',
        'or_address1',
        'or_address2',
        'or_city',
        'or_state',
        'or_zip_code',
        'or_phone',
    ];
}
