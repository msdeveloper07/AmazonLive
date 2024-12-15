<?php

namespace App\Http\Controllers;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use \App\Libraries\ZnUtilities;
use App\Models\User;

class ActivationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function activate($code)
    {
      
      $user = User::where('activation_code',$code)->where('user_status','blocked')->first();
       //ZnUtilities::pa($user);die();
              if(count($user)>0){
                 $user->user_status='active';
                 $user->save();
                 return redirect('/')->with('success','Activation Complete');
              }else{
                  return redirect('/')->with('fail','Activation link is expired');
              }
    }

}
