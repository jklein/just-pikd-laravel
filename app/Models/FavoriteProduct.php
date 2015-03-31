<?php namespace Pikd\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteProduct extends Model {

    protected $primaryKey = 'fp_id';
    protected $connection = 'product';
    public $timestamps = false;

    protected $fillable = [
        'fp_id',
        'fp_pr_sku',
        'fp_cu_id',
        'last_updated',
    ];
}
