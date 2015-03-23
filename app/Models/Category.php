<?php namespace Pikd\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $primaryKey = 'cat_id';
    protected $connection = 'product';
    public $timestamps = false;
}
