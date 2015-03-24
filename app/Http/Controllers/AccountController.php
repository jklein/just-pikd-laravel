<?php namespace Pikd\Http\Controllers;

use Pikd\Http\Requests;
use Pikd\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Auth\Guard;

class AccountController extends Controller {

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handleGet() {
        $data['title'] = sprintf("%s | Pikd", 'Account');

        $data['user'] = \Auth::user()->getAttributes();

        return view('account', $data);
    }

    public function handlePost(Request $r) {
        // They could be updating information about themself, or they could be
        // changing their password
        $change_password = $r->input('change_password');

        if (!empty($change_password)) {
            $this->validate($r, [
                'email'           => 'required|email',
                'old_password'    => 'required',
                'new_password'    => 'required',
                'repeat_password' => 'required|same:new_password',
            ]);

            $credentials = [
                'cu_email'    => $r->input('email'),
                'cu_password' => $r->input('old_password'),
            ];

            if (!$this->auth->attempt($credentials, false, false)) {
                \Session::flash('danger', 'Auth failed!');
                return redirect('account');
            }

            $customer = \Pikd\Models\Customer::find(\Auth::user()->cu_id);
            $customer->cu_password = bcrypt($r->input('new_password'));
            $customer->save();

            \Session::flash('success', 'Password updated successfully!');
            return redirect('account');
        } else {
            $form_data = array(
                'first_name' => filter_var($r->input('first_name'), FILTER_SANITIZE_STRING),
                'last_name'  => filter_var($r->input('last_name'), FILTER_SANITIZE_STRING),
                'email'      => filter_var($r->input('email'), FILTER_VALIDATE_EMAIL),
            );
            $update = $auth->updateInfo($form_data);
        }

        if ($update['valid']) {
            $app->flashNow('success', $update['messages']);
        } else {
            $app->flashNow('danger', $update['messages']);
        }
    }
}
