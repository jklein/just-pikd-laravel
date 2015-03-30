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

        // \Session::flash('default', 'Default Message');
        // \Session::flash('info', 'Info Message');
        // \Session::flash('dark', 'Info Message');
        // \Session::flash('success', 'Success Message');
        // \Session::flash('warning', 'Warning Message');
        // \Session::flash('danger', ['Danger Message', 'A second danger Message']);

        $client = new \Predis\Client();
        $client->set('foo', 'bar');
        $data['redis_value'] = $client->get('foo');

        // Sending an email
        \Mail::send('emails.welcome', ['name' => 'Jonathan Klein'], function($message) {
            $message->to('jonathan.n.klein@gmail.com', 'Jonathan Klein')->subject('Welcome Again!');
        });


        return view('util', $data);
    }
}
