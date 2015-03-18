<?php namespace Pikd\Http\Controllers;


class UtilController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function handleGet() {
        $data = [];

        // \Session::flash('info', 'Info Message');
        // \Session::flash('success', 'Success Message');
        // \Session::flash('error', 'Error Message');
        // \Session::flash('warning', 'Warning Message');

        $data['flash'] = $this->getFlashData();
        return view('util', $data);
    }

}
