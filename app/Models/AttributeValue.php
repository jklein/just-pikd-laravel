<?php namespace Pikd\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model {

    protected $primaryKey = 'atv_id';
    protected $connection = 'product';
    public $timestamps = false;
}
