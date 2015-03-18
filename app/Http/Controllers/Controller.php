<?php namespace Pikd\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

    public function getFlashData() {
        $ret = [];
        foreach (\Session::get('flash.old') as $key) {
            $ret[$key] = \Session::get($key);
        }

        return $ret;
    }
}
