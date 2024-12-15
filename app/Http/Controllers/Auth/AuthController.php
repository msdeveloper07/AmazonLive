<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\Libraries\ZnUtilities;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use URL;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    

    protected $redirectTo = '/dashboard';
    
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
  

        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        
     
    }
        public function index()
    {
  
   $user_id = \Auth::user()->id;
    $user = \App\Models\User::find($user_id);
$user->last_login = date('Y-m-d H:i:s');
$user->save();

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
            'first_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
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
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']), 
            'user_group_id' => $data['user_group_id'],
            
        ]);
    }
   public function register(Request $request) {
      
       $v = \Validator::make($request->request->all(), [
                    'password' => 'required|min:5|confirmed',
                    'email' => 'required|email',
                    'first_name' => 'required',
                    'last_name' => 'required'
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        }
        $activation_code = ZnUtilities::random_string('alphanumeric', 40);
        $input = $request->request->all();

        $user = new User();
        $user->first_name = $input['first_name'];
        $user->full_name = $input['first_name'] . ' ' . $input['last_name'];

        $user->last_name = $input['last_name'];
        $user->email = $input['email'];
        $user->user_group_id = $input['user_group_id'];
        $user->activation_code = $activation_code;
        $user->user_status = 'blocked';
        $user->password = bcrypt($input['password']);
        
        $full_name = $input['first_name'] . ' ' . $input['last_name'];
        $user_slug = ZnUtilities::getSlug($full_name, $user, 'user_slug', 'id');
        $user->user_slug = $user_slug;
        
//        ZnUtilities::pa($user_slug);  die;
        
        $user->save();

        Mail::send('emails.userActivation', array(
            'name' => $user->full_name,
            'code' => $activation_code,
            'url' => URL::to('/'),
            'activation_code' => $activation_code), function($message) use ($user) {

            $message->to($user->email, $user->full_name)
                    ->subject('Activate your account');
        }
        );

        return redirect('/')->with('success', 'An Activation Mail is send on "' . $user->email . '"');
    }

}
