<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Support;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index()
    {
//        
    }
    
    
    
    public function supportIndex()
    {
        $data = array();
        $data['support'] = Support::get();
        $data['active_support_navbar'] = 'support_active';
        return view('supports.home',$data);
    }
    
    public function sendSupportMail(Request $request)
    {
        $admin = User::where('user_group_id','1')->first();
        $subject = $request->get('subject');
        $content = $request->get('content');
        
        $support = new Support();
        $support->subject = $subject;
        $support->content = $content;
        $support->user_email = $request->get('email');    
        $support->save();
        
        
        Mail::send('emails.support', array(
            'name' => $admin->full_name,
            'content' => $content), function($message) use ($admin,$subject) {

            $message->to($admin->email, $admin->full_name)
                    ->subject($subject);
        }
        );
        
        return redirect('/supports')->with('success', 'Thanks For Feedback');
    }

}
