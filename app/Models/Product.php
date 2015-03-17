<?php namespace Pikd\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $primaryKey = 'pr_sku';
    protected $connection = 'product';
    public $timestamps = false;

    protected $fillable = [
        'pr_sku',
        'pr_sku_is_real_upc',
        'pr_status',
        'pr_default_img_id',
        'pr_case_upc',
        'pr_units_per_case',
        'pr_measurement_unit',
        'pr_measurement_value',
        'pr_upc_commodity',
        'pr_upc_vendor',
        'pr_upc_case',
        'pr_upc_item',
        'pr_length',
        'pr_width',
        'pr_height',
        'pr_cubic_volume',
        'pr_weight',
        'pr_gtin',
        'pr_temperature_zone',
        'pr_ma_id',
        'pr_cat_id',
        'pr_description',
        'pr_shelf_life_days',
        'pr_qc_check_interval_days',
        'pr_bnd_id',
        'pr_name',
        'pr_pfl_id',
        'pr_case_length',
        'pr_case_width',
        'pr_case_height',
        'pr_case_weight',
        'pr_expiration_class',
    ];

    protected $casts = [
        'pr_sku_is_real_upc'        => 'boolean',
        'pr_default_img_id'         => 'integer',
        'pr_units_per_case'         => 'integer',
        'pr_measurement_value'      => 'integer',
        'pr_upc_commodity'          => 'integer',
        'pr_upc_vendor'             => 'integer',
        'pr_upc_case'               => 'integer',
        'pr_upc_item'               => 'integer',
        'pr_ma_id'                  => 'integer',
        'pr_cat_id'                 => 'integer',
        'pr_shelf_life_days'        => 'integer',
        'pr_qc_check_interval_days' => 'integer',
        'pr_bnd_id'                 => 'integer',
        'pr_pfl_id'                 => 'integer',
        'pr_length'                 => 'double',
        'pr_width'                  => 'double',
        'pr_cubic_volume'           => 'double',
        'pr_weight'                 => 'double',
        'pr_case_length'            => 'double',
        'pr_case_width'             => 'double',
        'pr_case_height'            => 'double',
        'pr_case_weight'            => 'double',
    ];

    // Stub
    public function getLink() {
        return '/products/' . $this->pr_sku . '/' . urlencode($this->pr_name);
    }
}