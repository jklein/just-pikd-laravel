<?php namespace Pikd\Http\Controllers;

use Pikd\Http\Requests;
use Pikd\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AccountController extends Controller {

    public function handleGet() {
        $data['title'] = sprintf("%s | Pikd", 'Account');

        $data['user'] = \Auth::user()->getAttributes();
        return view('account', $data);
    }
}
