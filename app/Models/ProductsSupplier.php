<?php namespace Pikd\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsSupplier extends Model {

    protected $primaryKey = 'psl_id';
    protected $connection = 'product';
    public $timestamps = false;

}