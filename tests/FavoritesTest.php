<?php

use \Pikd\Models\Customer;
use \Pikd\Models\FavoriteProduct;

class FavoritesTest extends TestCase {

    private $fp_id;

    public function setUp() {
        parent::setUp();

        $user = Customer::find(1);
        $this->be($user);
    }

    /**
     * Add a favorite
     *
     * @return void
     */
    public function testAddFavorite() {
        $response = $this->call('POST', '/favorites', [
            'pr_sku' => '006-414403021-7',
        ]);

        $this->assertTrue(is_numeric($response->original));
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Delete a favorite
     *
     * @return void
     */
    public function testDeleteFavorite() {
        $response = $this->call('POST', '/favorites', [
            'pr_sku' => '006-414403021-7',
        ]);

        $delete = $this->call('DELETE', '/favorites/' . $response->original);

        $this->assertEquals(200, $delete->getStatusCode());
    }
}
