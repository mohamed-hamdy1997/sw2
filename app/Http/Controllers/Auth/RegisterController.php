<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/register';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
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
            'name' => $data['name'],
            'email' => $data['email'],
            'token' => $data['token'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Override default register method from RegistersUsers trait
     *
     * @param array $request
     * @return redirect to $redirectTo
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        //add token to the $request array
        $token = $this->getToken();
        $request->request->add(['token' => $token]);

        $user = $this->create($request->all());

        //$this->guard()->login($user);

        //write a code for send email to a user with activation link
        $data = array('name' => $request['name'], 'email' => $request['email'],  'activation_link' => url('/activation/' . $token));

        Mail::send('emails.email', $data, function($message) use ($data) {
            $message->to($data['email'])
                ->subject('Activate Your Account');
            $message->from('mohamedhamdy.o1997@gmail.com');
        });

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath())->with('success', 'We have sent an activation link on your email id. Please verify your account.');
    }

    /**
     * Generate a unique token
     *
     * @return unique token
     */
    public function getToken() {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    /**
     * Activate the user account
     *
     * @param string $key
     * @return redirect to login page
     */
    public function activation($key)
    {
        $auth_user = User::where('token', $key)->first();

        if($auth_user) {
            $auth_user->active = '1';
            $auth_user->token = 'NULL';
            $auth_user->update();
            return redirect('login')->with('success', 'Your account is activated. You can login now.');
        } else {
            return redirect('login')->with('error', 'Invalid activation key.');
        }
    }
}