<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\EmailTemplate;
use App\Models\DoctorDegree;
use App\Models\DoctorInternship;
use App\Models\DoctorMembership;
use App\Models\DoctorExperience;
use App\Models\DoctorAward;
use App\Models\DoctorPublication;
use Illuminate\Database\Eloquent\Collection;
use \App\Libraries\ZnUtilities;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Promo;
use URL;
use App\Models\Support;


class AjaxController extends Controller {

    public function manageProfile() {
        
        $user_id = \Auth::user()->id;
        $img = $_POST['img'];
        $user = User::find($user_id);
        $user->profile_pic = $img;
        $user->save();
        return;
    }

    public function getTemplateContent($template_id) {
        $message = EmailTemplate::find($template_id)->toJson();
        echo $message;
    }

    public function changePassword() {

        return view('auth/changepassword');
    }

    public function changePasswordPost(Request $request) {

        $v = \Validator::make($request->all(), [
                    'password' => 'required|min:5|confirmed'
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        } else {

            $user = User::find(\Auth::user()->id);
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect('/fb/add/mobile')->with('success', 'Password Created Sucessfully');
        }
    }

    public function slideDelete(Request $request, $id) {

        \App\Models\SlideContent::find($id)->delete();
    }

//     public function productView($slug)
//    {      
//        $id = Promo::where('promo_slug',$slug)->pluck('promo_id'); 
//        $data = array();
//        $data['title'] = "Product View";
//        $data['product_info'] = Promo::find($id);      
//        return view('landings.landing',$data);
//    }
//    
//    public function saveLandingUser($slug, Request $request)
//    {
//      $id = Promo::where('promo_slug',$slug)->first();   
//       $v = \Validator::make($request->request->all(), [
//                    'password' => 'required|min:5|confirmed',
//                    'email' => 'required|email',
//                    'first_name' => 'required',
//                    'password_confirmation' => 'required'
//        ]);
//
//        if ($v->fails()) {
//            return redirect()->back()->withErrors($v->errors());
//        }
//        $activation_code = ZnUtilities::random_string('alphanumeric', 40);
//        $input = $request->request->all();
//
//        $user = new User();
//        $user->first_name = $input['first_name'];
//        $user->full_name = $input['first_name'] . ' ' . $input['last_name'];
//
//        $user->last_name = $input['last_name'];
//        $user->email = $input['email'];
//        $user->user_group_id = $input['user_group_id'];
//        $user->activation_code = $activation_code;
//        $user->user_status = 'blocked';
//        $user->password = bcrypt($input['password']);
//        
//        $full_name = $input['first_name'] . ' ' . $input['last_name'];
//        $user_slug = ZnUtilities::getSlug($full_name, $user, 'user_slug', 'id');
//        $user->user_slug = $user_slug;
//        
//        $user->save();
//        Mail::send('emails.userActivation', array(
//            'name' => $user->full_name,
//            'code' => $activation_code,
//            'url' => URL::to('/'),
//            'activation_code' => $activation_code), function($message) use ($user) {
//
//            $message->to($user->email, $user->full_name)
//                    ->subject('Activate your account');
//        }
//        );
//
//        return redirect('/')->with('success', 'An Activation Mail is send on "' . $user->email . '"');
//    }
    
//    public function supportIndex()
//    {
//        
//        $data = array();
//        $data['support'] = Support::get();
//        $data['active_support_navbar'] = 'support_active';
//        return view('supports.home',$data);
//    }
//    
//    public function sendSupportMail(Request $request)
//    {
//        $admin = User::where('user_group_id','1')->first();
//        
//        $subject = $request->get('subject');
//        
//        $content = $request->get('content');
//        
//        $support = new Support();
//        $support->subject = $subject;
//        $support->content = $content;
//        $support->user_email = $request->get('email');
//        
//        $support->save();
//        
////        \App\Libraries\ZnUtilities::pa($content);   die;
//        
//        Mail::send('emails.support', array(
//            'name' => $admin->full_name,
//            'content' => $content), function($message) use ($admin,$subject) {
//
//            $message->to($admin->email, $admin->full_name)
//                    ->subject($subject);
//        }
//        );
//        
//        return redirect('/supports')->with('success', 'Thnks For Feedback');
//    }

    
    
}
