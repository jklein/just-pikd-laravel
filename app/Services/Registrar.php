<?php namespace Pikd\Services;

use Pikd\Models\Customer;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		$verifier = \App::make('validation.presence');
    	$verifier->setConnection('customer');

		$validator = Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:customers,cu_email',
			'password' => 'required|confirmed|min:6',
		]);

		$validator->setPresenceVerifier($verifier);

		return $validator;
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return Customer
	 */
	public function create(array $data)
	{
		return Customer::create([
			'cu_first_name' => $data['name'],
			'cu_email' => $data['email'],
			'cu_password' => bcrypt($data['password']),
		]);
	}

}
