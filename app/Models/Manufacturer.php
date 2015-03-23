<?php namespace Pikd\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model {

    protected $primaryKey = 'ma_id';
    protected $connection = 'product';
    public $timestamps = false;
}
