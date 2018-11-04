<?php

namespace App\Http\Controllers\Auth;

use App\Mail\SendUserRegistered;
use App\Role;
use App\User;
use App\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Session;
use App\Verification;

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
        $roles = Role::all();
        return view('general.auth.register')->with('roles', $roles);
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
            'references' => 'numeric|digits_between:10,11',
            'role' => 'required',
            'code' => 'required|string|max:255'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $verify = Verification::where('email', $data['email'])->where('code', $data['code'])->first();

        if($verify != null || !$verify){
            Session::flash('status', 'Invalid verification code');
            return redirect()->route('register');
        }else{

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'admin' => 0,
            ]);

            Profile::create([
                'user_id' => $user->id,
                'references' => $data['references'] != '' ? $data['references'] : 'NO REFERRAL',
                'picture' => 'upload\profile\48.jpg',
            ]);

            $user->role()->attach($data['role']);

            Mail::to('ershadahamed89@gmail.com')->send(new SendUserRegistered($user));

            return $user;

        }
    }
}
