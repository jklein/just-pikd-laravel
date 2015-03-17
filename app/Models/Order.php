<?php namespace Pikd\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $primaryKey = 'or_id';
    protected $connection = 'customer';
    public $timestamps = false;

}