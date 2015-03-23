<?php namespace Pikd\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model {

    protected $primaryKey = 'bnd_id';
    protected $connection = 'product';
    public $timestamps = false;
}
