# Converted with pg2mysql-1.9
# Converted on Mon, 18 Jan 2016 10:29:31 -0500
# Lightbox Technologies Inc. http://www.lightbox.ca

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone="+00:00";

CREATE TABLE attribute_values (
    atv_id int(11) NOT NULL,
    atv_pr_sku int(11) NOT NULL,
    atv_at_id int(11) NOT NULL,
    atv_value bool NOT NULL,
    last_updated timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL
) TYPE=MyISAM;

CREATE TABLE attributes (
    at_id int(11) NOT NULL,
    at_name varchar(255) NOT NULL,
    last_updated timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL
) TYPE=MyISAM;

CREATE TABLE brands (
    bnd_id int(11) NOT NULL,
    bnd_name text NOT NULL,
    bnd_logo_image_url text,
    bnd_marketing_description text,
    last_updated timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL
) TYPE=MyISAM;

CREATE TABLE candsproducts (
    item_code int(11),
    item_upc varchar(50),
    database varchar(100),
    description text,
    pack int(11),
    size_number double precision,
    unit_of_measure varchar(10),
    list_cost money,
    upc_commodity int(11),
    upc_vendor int(11),
    upc_case int(11),
    upc_item int(11),
    case_full_upc varchar(50),
    item_full_upc varchar(50),
    destination text,
    gl text,
    category text,
    vendor_name text,
    length double precision,
    width double precision,
    height double precision,
    cube double precision,
    weight double precision,
    qc_spec int(11),
    type_of_qc text,
    rank_by_category int(11),
    total_rank money,
    retail_mult int(11),
    assumed_case_volume double precision,
    assumed_item_volume money,
    assumed_cogs money,
    valid_item_upc bool,
    jp_category text,
    jp_subcategory text
) TYPE=MyISAM;

CREATE TABLE categories (
    cat_id int(11) NOT NULL,
    cat_name text NOT NULL,
    cat_third_party_identifier text,
    cat_parent_cat_id int(11),
    cat_active int(11),
    last_updated timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL
);

CREATE TABLE favorite_products (
    fp_id int NOT NULL AUTO_INCREMENT,
    fp_pr_sku varchar(255) NOT NULL,
    fp_cu_id int(11) NOT NULL,
    last_updated timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL
);

CREATE TABLE im_items (
    item_upc varchar(50),
    id int(11),
    upc varchar(50),
    description text,
    manufacturer text,
    brand text,
    distributor text,
    gs1_category text,
    pkg_manufacturer text,
    pkg_manufacturer_address text,
    pkg_manufacturer_phone text,
    pkg_manufacturer_email text,
    pkg_manufacturer_url text,
    pkg_distributor text,
    pkg_distributor_address text,
    pkg_distributor_phone text,
    pkg_distributor_email text,
    pkg_distributor_url text,
    marketing_description text,
    other_description text,
    units_in_package int(11),
    packaging_type text,
    packaging_size text,
    package_information text,
    created timestamp,
    last_updated timestamp
) TYPE=MyISAM;

CREATE TABLE im_media (
    id int(11),
    item_upc varchar(50),
    gs1_view varchar(50),
    image_1_mime_type varchar(50),
    image_1_date_added timestamp,
    image_1_source text,
    image_1_description text,
    image_1_path text,
    image_2_mime_type varchar(50),
    image_2_date_added timestamp,
    image_2_source text,
    image_2_description text,
    image_2_path text,
    image_3_mime_type varchar(50),
    image_3_date_added timestamp,
    image_3_source text,
    image_3_description text,
    image_3_path text,
    image_4_mime_type varchar(50),
    image_4_date_added timestamp,
    image_4_source text,
    image_4_description text,
    image_4_path text,
    image_5_mime_type varchar(50),
    image_5_date_added timestamp,
    image_5_source text,
    image_5_description text,
    image_5_path text,
    image_6_mime_type varchar(50),
    image_6_date_added timestamp,
    image_6_source text,
    image_6_description text,
    image_6_path text,
    image_7_mime_type varchar(50),
    image_7_date_added timestamp,
    image_7_source text,
    image_7_description text,
    image_7_path text,
    image_8_mime_type varchar(50),
    image_8_date_added timestamp,
    image_8_source text,
    image_8_description text,
    image_8_path text,
    image_9_mime_type varchar(50),
    image_9_date_added timestamp,
    image_9_source text,
    image_9_description text,
    image_9_path text
) TYPE=MyISAM;

CREATE TABLE im_productdata (
    item_upc varchar(50),
    id int(11),
    upc varchar(50),
    product_id varchar(100),
    sequence int(11),
    manufacturer text,
    distributor text,
    brand text,
    product_description text,
    product_size text,
    drug_interactions text,
    directions text,
    indications text,
    ingredients text,
    vitamin_and_minerals text,
    low_fat bool,
    low_sodium bool,
    fat_free bool,
    sugar_free bool,
    good_source_of_fiber bool,
    vegan bool,
    vegetarian bool,
    lactose_free bool,
    flavor bool,
    antibiotic_free bool,
    temperature_indicator text,
    wheat_free bool,
    gluten_free bool,
    hormone_free bool,
    is_natural bool,
    nitrates_free bool,
    nitrites_free bool,
    organic bool,
    peanut_free bool,
    ready_to_cook bool,
    ready_to_heat bool,
    dairy_free bool,
    egg_free bool,
    kosher_codes varchar(50),
    recycle_codes varchar(50),
    ndc_code varchar(50),
    country_of_origin text
) TYPE=MyISAM;

CREATE TABLE images (
    img_id int(11) NOT NULL,
    img_ma_id int(11) NOT NULL,
    img_pr_sku ean13,
    img_mime_type varchar(255),
    img_rank int(11) NOT NULL,
    img_show_on_site bool DEFAULT 1 NOT NULL,
    img_width int(11),
    img_height int(11),
    img_file_size int(11),
    img_alt_text varchar(255),
    img_description text,
    img_source text,
    img_date_added timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    last_updated timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL
) TYPE=MyISAM;

CREATE TABLE kwikee_external_codes (
    gtin varchar(14),
    external_code text,
    external_code_value text
) TYPE=MyISAM;

CREATE TABLE kwikee_nutrition (
    upc varchar(10),
    gtin varchar(14),
    promotion text,
    cal_from_sat_tran_fat varchar(15),
    calories_per_serving varchar(15),
    carbo_per_serving varchar(15),
    carbo_uom varchar(15),
    cholesterol_per_serving varchar(15),
    cholesterol_uom varchar(15),
    dvp_biotin varchar(15),
    dvp_calcium varchar(15),
    dvp_carbo varchar(15),
    dvp_chloride varchar(15),
    dvp_cholesterol varchar(15),
    dvp_chromium varchar(15),
    dvp_copper varchar(15),
    dvp_fiber varchar(15),
    dvp_folic_acid varchar(15),
    dvp_iodide varchar(15),
    dvp_iodine varchar(15),
    dvp_iron varchar(15),
    dvp_magnesium varchar(15),
    dvp_manganese varchar(15),
    dvp_molybdenum varchar(15),
    dvp_niacin varchar(15),
    dvp_panthothenate varchar(15),
    dvp_phosphorus varchar(15),
    dvp_potassium varchar(15),
    dvp_protein varchar(15),
    dvp_riboflavin varchar(15),
    dvp_sat_tran_fat varchar(15),
    dvp_saturated_fat varchar(15),
    dvp_selenium varchar(15),
    dvp_sodium varchar(15),
    dvp_sugar varchar(15),
    dvp_thiamin varchar(15),
    dvp_total_fat varchar(15),
    dvp_vitamin_a varchar(15),
    dvp_vitamin_b12 varchar(15),
    dvp_vitamin_b6 varchar(15),
    dvp_vitamin_c varchar(15),
    dvp_vitamin_d varchar(15),
    dvp_vitamin_e varchar(15),
    dvp_vitamin_k varchar(15),
    dvp_zinc varchar(15),
    fat_calories_per_serving varchar(15),
    fiber_per_serving varchar(15),
    fiber_uom varchar(15),
    insol_fiber_per_serving varchar(15),
    insol_fiber_per_serving_uom varchar(15),
    mono_unsat_fat varchar(15),
    mono_unsat_fat_uom varchar(15),
    nutrient_disclaimer_1 text,
    nutrient_disclaimer_2 text,
    nutrient_disclaimer_3 text,
    nutrient_disclaimer_4 text,
    nutrition_label text,
    omega_3_polyunsat varchar(15),
    omega_3_polyunsat_uom varchar(15),
    omega_6_polyunsat varchar(15),
    omega_6_polyunsat_uom varchar(15),
    omega_9_polyunsat varchar(15),
    omega_9_polyunsat_uom varchar(15),
    poly_unsat_fat varchar(15),
    poly_unsat_fat_uom varchar(15),
    potassium_per_serving varchar(15),
    potassium_uom varchar(15),
    protein_per_serving varchar(15),
    protein_uom varchar(15),
    sat_fat_per_serving varchar(15),
    sat_fat_uom varchar(15),
    serving_size varchar(15),
    serving_size_uom varchar(15),
    servings_per_container varchar(15),
    sodium_per_serving varchar(15),
    sodium_uom varchar(15),
    sol_fiber_per_serving varchar(15),
    sol_fiber_per_serving_uom varchar(15),
    starch_per_serving varchar(15),
    starch_per_serving_uom varchar(15),
    sub_number int(11),
    sugar_per_serving varchar(15),
    sugar_uom varchar(15),
    suger_alc_per_serving varchar(15),
    suger_alc_per_serving_uom varchar(15),
    total_calories_per_serving varchar(15),
    total_fat_per_serving varchar(15),
    total_fat_uom varchar(15),
    trans_fat_per_serving varchar(15),
    trans_fat_uom varchar(15)
) TYPE=MyISAM;

CREATE TABLE kwikee_pog (
    gtin varchar(14),
    upc_10 varchar(10),
    upc_12 varchar(12),
    gpc_brick_id int(11),
    gpc_brick_name text,
    section_id varchar(15),
    section_name text,
    manufacturer_name text,
    brand_name text,
    custom_product_name text,
    product_name text,
    description text,
    product_size double precision,
    uom varchar(50),
    container_type text,
    height double precision,
    height_count double precision,
    width double precision,
    width_count double precision,
    depth double precision,
    depth_count double precision,
    depth_nesting double precision,
    dual_nesting int(11),
    vertical_nesting double precision,
    peg_down double precision,
    peg_right double precision,
    tray_count varchar(15),
    tray_depth double precision,
    tray_height double precision,
    tray_width double precision,
    case_count double precision,
    case_depth double precision,
    case_height double precision,
    case_width double precision,
    display_depth double precision,
    display_height double precision,
    display_width double precision,
    unique_id text,
    physical_weight_lb double precision,
    physical_weight_oz double precision,
    date_created timestamp,
    product_count text,
    unit_size double precision,
    unit_uom varchar(50),
    unit_container text,
    source_zip varchar(50)
) TYPE=MyISAM;

CREATE TABLE kwikee_products (
    upc varchar(10),
    whole_upc varchar(12),
    gtin varchar(14),
    case_gtin varchar(100),
    manufacturer_name text,
    brand_name text,
    product_name text,
    description text,
    product_size double precision,
    uom varchar(50),
    container_type text,
    product_count text,
    unit_size double precision,
    unit_uom varchar(50),
    unit_container text,
    custom_product_name text,
    promotion text,
    gpc_brick_id int(11),
    section_id varchar(15),
    section_name text,
    consumable varchar(5),
    low_fat varchar(5),
    fat_free varchar(5),
    gluten_free varchar(5),
    kosher varchar(5),
    organic varchar(5),
    model varchar(50),
    ingredient_code text,
    ingredients text,
    allergens text,
    indications_copy text,
    interactions_copy text,
    why_buy_1 text,
    why_buy_2 text,
    why_buy_3 text,
    why_buy_4 text,
    why_buy_5 text,
    why_buy_6 text,
    why_buy_7 text,
    romance_copy_1 text,
    romance_copy_2 text,
    romance_copy_3 text,
    romance_copy_4 text,
    warnings_copy text,
    instructions_copy_1 text,
    instructions_copy_2 text,
    instructions_copy_3 text,
    instructions_copy_4 text,
    instructions_copy_5 text,
    guarantees text,
    guarantee_analysis text,
    legal text,
    post_consumer text,
    keywords text,
    height double precision,
    width double precision,
    depth double precision,
    peg_right double precision,
    peg_down double precision,
    physical_weight_lb double precision,
    physical_weight_oz double precision,
    case_count int(11),
    case_depth double precision,
    case_height double precision,
    case_width double precision,
    depth_count int(11),
    display_depth double precision,
    display_height double precision,
    display_width double precision,
    height_count int(11),
    tray_count varchar(15),
    tray_depth double precision,
    tray_height double precision,
    tray_width double precision,
    width_count double precision,
    multiple_shelf_facings int(11),
    dual_nesting int(11),
    depth_nesting double precision,
    vertical_nesting double precision,
    product_created_date timestamp,
    product_last_modified_date timestamp,
    division_name text,
    division_name_2 text,
    last_publish_date timestamp,
    image_indicator int(11),
    seasonal_flag int(11),
    country_id int(11),
    language_id int(11),
    mfr_approved_date timestamp,
    product_base_id int(11),
    product_varietal text,
    variant_name_1 text,
    variant_name_2 text,
    variant_value_1 double precision,
    variant_value_2 double precision,
    alt_brand_name text,
    alt_container_type text,
    alt_product_description text,
    alt_product_name text,
    alt_product_size double precision,
    alt_uom varchar(15),
    nutrient_claim_1 varchar(100),
    nutrient_claim_2 varchar(100),
    nutrient_claim_3 varchar(100),
    nutrient_claim_4 varchar(100),
    nutrient_claim_5 varchar(100),
    nutrient_claim_6 varchar(100),
    nutrient_claim_7 varchar(100),
    nutrient_claim_8 varchar(100),
    nutrition_footnotes_1 text,
    nutrition_footnotes_2 text,
    nutrition_head_1 text,
    nutrition_head_2 text,
    other_nutrient_statement text,
    extra_text_2 text,
    extra_text_3 text,
    extra_text_4 text,
    diabetes_fc_values text,
    disease_claim text,
    romance_copy_category text,
    sensible_solutions text,
    size_description_1 text,
    size_description_2 text,
    ss_claim_1 text,
    ss_claim_2 text,
    ss_claim_3 text,
    ss_claim_4 text,
    hexcode text,
    identifier_1 text,
    identifier_2 text,
    vm_claim_1 text,
    vm_claim_2 text,
    vm_claim_3 text,
    vm_claim_4 text,
    vm_type_1 text,
    vm_type_2 text,
    vm_type_3 text,
    vm_type_4 text,
    bdm_account_base_id int(11),
    client_base_id int(11),
    container_type_uc text,
    csm_account_base_id int(11),
    custom_product_name_uc text,
    ethnic_copy text,
    flavor text,
    national_billing_flag int(11),
    product_form text,
    product_name_uc text,
    product_size_uc text,
    product_type text,
    supplied_brand_name text,
    supplied_manufacturer_name text,
    uom_uc varchar(15),
    walmart_long_desc_header text,
    walmart_search_description text,
    source_zip varchar(50)
) TYPE=MyISAM;

CREATE TABLE manufacturers (
    ma_id int(11) NOT NULL,
    ma_name text NOT NULL,
    ma_logo_image_url text,
    ma_marketing_description text,
    last_updated timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL
) TYPE=MyISAM;

CREATE TABLE product_families (
    ma_id int(11) NOT NULL,
    ma_name varchar(255) NOT NULL,
    last_updated timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL
) TYPE=MyISAM;

CREATE TABLE products (
    pr_sku varchar(13) NOT NULL,
    pr_sku_is_real_upc int(11) NOT NULL,
    pr_status varchar(255) NOT NULL,
    pr_default_img_id int(11),
    pr_case_upc varchar(13),
    pr_units_per_case smallint,
    pr_measurement_unit varchar(255),
    pr_measurement_value int(11),
    pr_upc_commodity int(11),
    pr_upc_vendor int(11),
    pr_upc_case int(11),
    pr_upc_item int(11),
    pr_list_cost int(11),
    pr_length double precision,
    pr_width double precision,
    pr_height double precision,
    pr_cubic_volume double precision,
    pr_weight double precision,
    pr_gtin varchar(14),
    pr_temperature_zone varchar(13),
    pr_ma_id int(11),
    pr_cat_id int(11),
    pr_description text,
    pr_shelf_life_days int(11),
    pr_qc_check_interval_days int(11),
    pr_bnd_id int(11),
    pr_name varchar(255),
    pr_pfl_id int(11),
    pr_case_length double precision,
    pr_case_width double precision,
    pr_case_height double precision,
    pr_case_weight double precision,
    pr_expiration_class varchar(13),
    last_updated timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL
);

CREATE TABLE products_stores (
    ps_id int(11) NOT NULL,
    ps_pr_sku varchar(255) NOT NULL,
    ps_so_id int(11) NOT NULL,
    ps_list_cost int(11) NOT NULL,
    last_updated timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL
);

CREATE TABLE products_suppliers (
    psl_id int(11) NOT NULL,
    psl_pr_sku ean13 NOT NULL,
    psl_su_id int(11) NOT NULL,
    psl_status product_status NOT NULL,
    psl_wholesale_cost int(11),
    last_updated timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL
) TYPE=MyISAM;

CREATE TABLE stores (
    so_id int(11) NOT NULL,
    so_name varchar(255) NOT NULL,
    so_active bool DEFAULT 1 NOT NULL,
    so_date_active timestamp,
    so_address1 varchar(255),
    so_address2 varchar(255),
    so_city varchar(255),
    so_state varchar(2),
    so_zip_code varchar(12),
    so_phone varchar(30)
) TYPE=MyISAM;

CREATE TABLE suppliers (
    supplier_id int(11) NOT NULL,
    supplier_name text NOT NULL
) TYPE=MyISAM;

ALTER TABLE attribute_values
    ADD CONSTRAINT attribute_values_pkey PRIMARY KEY (atv_id);
ALTER TABLE attributes
    ADD CONSTRAINT attributes_pkey PRIMARY KEY (at_id);
ALTER TABLE brands
    ADD CONSTRAINT brands_pkey PRIMARY KEY (bnd_id);
ALTER TABLE categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (cat_id);
ALTER TABLE favorite_products
    ADD CONSTRAINT favorite_products_pkey PRIMARY KEY (fp_id);
ALTER TABLE images
    ADD CONSTRAINT images_pkey1 PRIMARY KEY (img_id);
ALTER TABLE manufacturers
    ADD CONSTRAINT manufacturers_pkey PRIMARY KEY (ma_id);
ALTER TABLE product_families
    ADD CONSTRAINT product_families_pkey PRIMARY KEY (ma_id);
ALTER TABLE products
    ADD CONSTRAINT products_pkey1 PRIMARY KEY (pr_sku);
ALTER TABLE products_stores
    ADD CONSTRAINT products_stores_pkey1 PRIMARY KEY (ps_id);
ALTER TABLE products_suppliers
    ADD CONSTRAINT products_suppliers_pkey1 PRIMARY KEY (psl_id);
ALTER TABLE stores
    ADD CONSTRAINT stores_pkey PRIMARY KEY (so_id);
ALTER TABLE suppliers
    ADD CONSTRAINT suppliers_pkey PRIMARY KEY (supplier_id);
ALTER TABLE `attribute_values` ADD INDEX ( atv_at_id ) ;
ALTER TABLE `attribute_values` ADD INDEX ( atv_pr_sku ) ;
ALTER TABLE `products_suppliers` ADD INDEX ( psl_pr_sku ) ;
ALTER TABLE `products_suppliers` ADD INDEX ( psl_su_id ) ;
