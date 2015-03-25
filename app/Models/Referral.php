<?php namespace Pikd\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model {

    protected $primaryKey = 'ref_id';
    protected $connection = 'customer';
    public $timestamps = false;

    protected $fillable = [
        'ref_id',
        'ref_cu_id',
        'ref_email',
        'ref_status',
        'ref_updated_at',
    ];
}
