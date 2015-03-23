<?php namespace Pikd\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model {

    protected $primaryKey = 'udt_catalog';
    protected $connection = 'product';
    public $timestamps = false;
}
