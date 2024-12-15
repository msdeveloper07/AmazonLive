<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Coupon;
use App\Models\Promo;
use App\Models\User;


use App\Libraries\ZnUtilities;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use URL;


class ReviewLandingPageController extends Controller {

     public function productView($slug)
    {
        $id = Promo::where('promo_slug',$slug)->pluck('promo_id');
        $data = array();
        $data['title'] = "Product View";
        $data['product_info'] = Promo::find($id);

        return view('landings.landing',$data);
    }
    
    public function saveLandingUser($slug, Request $request)
    {
      $id = Promo::where('promo_slug',$slug)->first();   
       $v = \Validator::make($request->request->all(), [
                    'password' => 'required|min:5|confirmed',
                    'email' => 'required|email',
                    'first_name' => 'required',
                    'password_confirmation' => 'required'
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
