<?php namespace Pikd\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model {

    protected $primaryKey = 'supplier_id';
    protected $connection = 'product';
    public $timestamps = false;
}
