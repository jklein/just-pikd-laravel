<?php namespace Pikd\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model {

    protected $primaryKey = 'so_id';
    protected $connection = 'product';
    public $timestamps = false;

}