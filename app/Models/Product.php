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
        'pr_list_cost',
    ];

    public function getLink() {
        return \Pikd\Util::productLink($this->pr_sku, $this->pr_name);
    }
}
