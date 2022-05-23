<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isEmpty;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * Url: /api/v1/user/registerSlAvatar
     * @param Request $request
     * @return
     */
    public function registerSlAvatar(Request $request){

        if (!$request->has('name')){
           // return response()->json(['message'=>"missing Avatar Name"],400);
            if (!$request->has('password')){
                //return response()->json(['message'=>"missing password"],400);
                return "error|missing avatar\ndata|none";
            }
        }
        if (!$request->has('email')){
            return response()->json(['message'=>"missing email"],400);
        }else{
            if (DB::table('users')->where('email','=',$request->email)->exists()){
                $forgotPasswordUrl = url("/user/forgotpassword");
                return response()->json(['message'=>"email already exists in the database. Did you forget your password? If so, please go to: $forgotPasswordUrl"],200);
            }else{
                event(new Registered($user = $this->create($request->all())));

                // After the user is created, he's logged in.
                $this->guard()->login($user);
                $outpout = ['message'=>"Successfully registered!",
                    'data'=>$user->getFillable()

                ];
                return response()->json($outpout,200);
            }


        }


    }
    public function register(Request $request)
    {
        // Here the request is validated. The validator method is located
        // inside the RegisterController, and makes sure the name, email
        // password and password_confirmation fields are required.
        $this->validator($request->all())->validate();

        // A Registered event is created and will trigger any relevant
        // observers, such as sending a confirmation email or any
        // code that needs to be run as soon as the user is created.
        event(new Registered($user = $this->create($request->all())));

        // After the user is created, he's logged in.
        $this->guard()->login($user);

        // And finally this is the hook that we want. If there is no
        // registered() method or it returns null, redirect him to
        // some other URL. In our case, we just need to implement
        // that method to return the correct response.
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
        $user->generateToken();

        return response()->json(['data' => $user->toArray()], 201);
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
