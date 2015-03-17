<?php namespace Pikd\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $primaryKey = 'img_id';
    protected $connection = 'product';
    protected $dates = ['img_date_added'];

    public $timestamps = false;

    protected $casts = [
        'img_id'           => 'integer',
        'img_ma_id'        => 'integer',
        'img_rank'         => 'integer',
        'img_show_on_site' => 'boolean',
        'img_width'        => 'integer',
        'img_height'       => 'integer',
        'img_file_size'    => 'integer',
    ];


    public function getDates()
    {
        return ['last_updated'];
    }
}