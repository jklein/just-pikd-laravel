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

        \Session::flash('default', 'Default Message');
        \Session::flash('info', 'Info Message');
        \Session::flash('dark', 'Info Message');
        \Session::flash('success', 'Success Message');
        \Session::flash('warning', 'Warning Message');
        \Session::flash('danger', ['Danger Message', 'A second danger Message']);

        return view('util', $data);
    }
}
