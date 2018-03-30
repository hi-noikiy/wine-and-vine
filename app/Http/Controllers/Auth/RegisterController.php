<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Country;
use App\RatingVisibility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use PragmaRX\Countries\Package\Countries;
use App\Http\Requests\UserRegistrationRequest;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected function redirectTo()
    {
        return route('welcome');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register', [
            'ratings' => RatingVisibility::all(),
            'countries' => Country::all()
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param UserRegistrationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegistrationRequest $request)
    {
        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first-name'],
            'last_name' => $data['last-name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'rating_visibility_id' => $data['rating-visibility'],
            'newsletter' => $data['newsletter'],
            'email_offers' => $data['email-offers']
        ]);
    }
}
