<?php namespace Pikd\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsStore extends Model {

    protected $primaryKey = 'sku';
    protected $connection = 'product';
    public $timestamps = false;

}