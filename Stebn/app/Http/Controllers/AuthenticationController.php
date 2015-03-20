<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUser;
use App\User;
use Auth;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class AuthenticationController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Authentication Controller
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'authentication/login']);
    }
    */
    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function register()
    {
        return view('authentication.register');
    }

    public function login()
    {
        return view('authentication.login');
    }

    public function store(CreateUser $request)
    {
        User::create($request->all());

        return view('welcome');
    }

    public function authenticate(Requests\LoginUser $request)
    {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $user = User::where('email', $email)->where('password', $password)->first();

        if(is_null($user))
        {
            return redirect('authentication/login')->with([
                'flash_message' => 'Wrong email or password!',
                'flash_message_important' => true,
            ]);
        }

        Auth::login($user);;

        switch($user->type)
        {
            case '1': return view('admin.welcome'); break;
            case '2': return view('hotelreceptionist.welcome'); break;
            default : return view('welcome'); break;
        }


    }

    public function Deauthenticate()
    {
        Auth::logout();
        return redirect('welcome');
    }
}
