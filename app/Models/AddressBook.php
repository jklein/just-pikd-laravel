<?php namespace Pikd\Models;

use Illuminate\Database\Eloquent\Model;

class AddressBook extends Model {

    protected $primaryKey = 'adr_id';
    protected $connection = 'customer';
    public $timestamps = false;
}
