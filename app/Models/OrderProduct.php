<?php namespace Pikd\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model {

    protected $primaryKey = 'op_id';
    protected $connection = 'customer';
    public $timestamps = false;

}