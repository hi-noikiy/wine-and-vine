<?php

namespace App\Http\Controllers\Auth;


use App\Http\Requests\UserRegistrationRequest;
use App\User;
use App\RatingVisibility;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use PragmaRX\Countries\Package\Countries;

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
    protected $redirectTo = '/home';

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
            'countries' => Countries::all()
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
     * @return \App\User
     */
    protected function create(array $data)
    {
        $first_name = $data['first-name'];
        $last_name = $data['last-name'];
        return User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'username' => $this->uniqueUsername($first_name, $last_name),
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'country' => $data['country'],
            'rating_visibility_id' => $data['rating-visibility'],
            'newsletter' => $data['newsletter'],
            'email_offers' => $data['email-offers']
        ]);
    }

    protected function uniqueUsername($first_name, $last_name) {
        $username = strtolower("{$first_name}_{$last_name}");
        $count = User::where('username', 'like', "%{$username}%")->count();

        return $count > 0 ? "{$username}_{$count}" : $username;
    }
}