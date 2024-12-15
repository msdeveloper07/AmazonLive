<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\History;
use App\Models\UserGroup;
use App\Models\Promo;
use Illuminate\Database\Eloquent\Collection;
use \App\Libraries\ZnUtilities;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use \Symfony\Component\DomCrawler\Crawler;


class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        
       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        ZnUtilities::push_js_files('components/users.js');
        $data = array();
        $data['users'] = User::orderBy('id', 'DESC')->paginate('10');
        
        
        
        $data['title'] = "Users";
        $data['active_user_navbar'] = 'user_active';
        return view('users.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $data = array();
        $data['usergroup'] = UserGroup::all();
        $data['title'] = "Create New User";
        return view('users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      
        $activation_code = ZnUtilities::random_string('alphanumeric', '50');
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->user_group_id = $request->get('user_group_id');
        $user->user_status = $request->get('user_status');
        $user->activation_code = $activation_code;
        $user->save();

        Mail::send('emails.newUserActivation', array(
            'name' => $request->get('name'),
            'activation_code' => $activation_code), function($message) use ($request) {
            $message->to($request->get('email'), $request->get('name'))
                    ->subject('Your account has been created');
        }
        );

        return redirect('users')->with('success', 'User Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {

        $id = User::where('user_slug',$slug)->pluck('id');
        $user = User::find($id);
        $data = array();
        $data['id'] = $id;
        $data['user'] = $user;
        $data['title'] = "User Edit";
        $data['county'] = Config::get('county.salutations');
        return view('users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser($slug, UserRequest $request) {
        
        $id = Ussluer::where('user_slug',$slug)->pluck('id');
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->user_group_id = $request->get('user_group_id');
        $user->user_status = $request->get('user_status');
        $user->save();
        return Redirect('users/'.$id.'/edit')->with('success', 'User Updates Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function uploadImage() {

        $data = array();
        $id = Auth::user()->id;
        $user = User::find($id);
        $data['users'] = $user;
        $data['title'] = "User";

        return view('users.uploadImage', $data);
    }

    

    public function profile($slug) {
        $id = User::where('user_slug',$slug)->pluck('id');   
           
        $data = array();
        $user = User::find($id);
        $data['id'] = $id;
        $data['user'] = $user;
        
//        ZnUtilities::push_js_files('components/image_upload.js');
        
        $data['active_profile_navbar'] = 'profile_active';
        ZnUtilities::push_js_files('pekeUpload.js'); 
        $data['title'] = "User Profile";
        $data['promo'] = Promo::all();  
        $data['scrap'] = \App\Models\Scrape::where('user_id',$id)->first(); 
        
//        ZnUtilities::pa($data['scrap']);  die;
        
        return view('users.profile', $data);
    }
    
     public function userSearch($search) {
        $user = User::where("first_name", "like", "%" . $search . "%")
                ->orWhere("email", "like", "%" . $search . "%")
                ->paginate();

        $data = array();
        $data['users'] = $user;
        //Basic Page Settings
        $data['search'] = $search;
        $data['title'] = "User";
        return view('users.list', $data);
    }

    public function userAction(Request $request) {
        
        $search = $request->get('search');
        if ($search != '') {
            return redirect('/userSearch/' . $search);
        } else {
            $cid = $request->get('cid');
            
//            ZnUtilities::pa($cid); die;
            
            $bulk_action = $request->get('bulk_action');
            if ($bulk_action != '') {
                switch ($bulk_action) {
                    case 'blocked': {
//                         die('hereeeee');
//                            foreach ($cid as $id) {
                                DB::table('users')
                                        ->where('id', $id)
                                        ->update(array('user_status' => 'deactive'));
//                            }

                            return redirect('/users')->with('success', 'Rows Updated!');

                            break;
                        }
                    case 'active': {
                            foreach ($cid as $id) {
                                DB::table('users')
                                        ->where('id', $id)
                                        ->update(array('user_status' => 'active'));
                            }

                            return redirect('/users')->with('success', 'Rows Updated!');
                            break;
                        }
                    case 'delete': {

                            foreach ($cid as $id) {
                                DB::table('users')
                                        ->where('id', $id)
                                        ->delete();
                            }

                            return redirect('/users')->with('success', 'Row Deleted Successfully!');
                            break;
                        }
                } //end switch
            } // end if statement
            return redirect('/users')->with('fail', 'Please Enter a Keyword');
        }
    }

    public function userActivity($id) {
        $user = User::find($id);
        $data = array();
        $data['id'] = $id;
        $notesCount = History::where('user_id', $id)->get()->count();

        if ($notesCount > 0) {
            $data['user_activity'] = History::where('user_id', $id)
                    ->orderBy('history_id', 'desc')
                    ->get();
        } else {
            $data['user_activity'] = '';
        }
        ZnUtilities::push_js_files('components/users.js');
        $data['title'] = 'Users';
        $data['user_name'] = $user->name;
        return view('users.user_activity', $data);
    }

    public function userActivityResult($id, Request $request) {
        $user = User::find($id);
        $data = array();
        $data['id'] = $id;
        $date_to = $request->get('date_to') . ' 11:59:59';
        $date_from = $request->get('date_from') . ' 00:00:00';

//        ZnUtilities::pa($date_from);  die();

        if ($date_to != $date_from) {

            $date_query = "(date(submitted_on) between '{$date_from}' and '{$date_to}')";
        } else if ($date_to == $date_from) {
            $date_query = "date(submitted_on) = '{$date_from}' ";
        } else {
            $date_to = date('Y-m-d') . ' 00:00:00';
            $date_query = "date(submitted_on) >= '{$date_from}' ";
        }


        $data['date_from'] = $request->get('date_from');
        $data['date_to'] = $request->get('date_to');
        $user_activity = DB::table('history');
        $user_activity->where('user_id', $id);
        $user_activity->whereRaw(DB::raw($date_query));
        $user_activity_ids = $user_activity->lists('history_id');




        if (Count($user_activity_ids) > 0) {
            $data['user_activity'] = History::whereIn('history_id', $user_activity_ids)
                    ->orderBy('history_id', 'desc')
                    ->get();
        } else {
            $data['user_activity'] = '';
        }
        ZnUtilities::push_js_files('components/users.js');
        $data['title'] = 'Users';
        $data['user_name'] = $user->name;
        return view('users.user_activity', $data);
    }

    public function updateRegisterUser($slug, Request $request) {
        
        $id = User::where('user_slug',$slug)->pluck('id');
        
        $user = User::find($id);
        
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->primary_phone = $request->get('primary_phone');
        $user->address = $request->get('address');
        $user->address_optional = $request->get('address_optional');
        $user->city = $request->get('city');
        $user->county = $request->get('county');
        $user->zip_code = $request->get('zip_code');
        $user->profile_link = $request->get('profile_link');
        $user->user_status = $request->get('status');
        

        $user->save();
        return Redirect('users/'.$slug.'/edit')->with('success', 'User Updates Successfully');
    }
    
    public function userStatus($id, Request $request) {
        
//        die('here');
        
        $search = $request->get('search');
        if ($search != '') {
            return redirect('/userSearch/' . $search);
        } else {
            $cid = $request->get('cid');
            
//            ZnUtilities::pa($cid); die;
            
            $bulk_action = $request->get('bulk_action');
            if ($bulk_action != '') {
                switch ($bulk_action) {
                    case 'blocked': {
//                         die('hereeeee');
//                            foreach ($cid as $id) {
                                DB::table('users')
                                        ->where('id', $id)
                                        ->update(array('user_status' => 'blocked'));
//                            }

                            return redirect('/users')->with('success', 'Rows Updated!');

                            break;
                        }
                    case 'active': {
//                            foreach ($cid as $id) {
                                DB::table('users')
                                        ->where('id', $id)
                                        ->update(array('user_status' => 'active'));
//                            }

                            return redirect('/users')->with('success', 'Rows Updated!');
                            break;
                        }
                    
                } //end switch
            } // end if statement
            return redirect('/users')->with('fail', 'Please Enter a Keyword');
        }
    }
    
    public function userScrap($slug, Request $request) {
        $id = User::where('user_slug',$slug)->first()->id;
        $user = User::find($id);
    
        $profile_link = $user->profile_link;

        if($profile_link){
        $url = $profile_link;
        
        $html_main = file_get_contents($url);
        $crawler_main = new Crawler($html_main);
        
        $div_data = $crawler_main->filter('.body > div > div > div > div > div > div')->eq(1);

        $name = $div_data->filter('div > div > div > span')->text();
        
        $review_ranking = $div_data->filter('div > div > div > div > div > div > div > div > div')->eq(3);
        
        $review = $review_ranking->filter('div > div')->eq(1)->text();
        
        
        $scrape_data = new \App\Models\Scrape();

        $scrape_data->submitted_by = $name;
        $scrape_data->review_ranking = $review;
        $scrape_data->user_id = $id;  
        
//        ZnUtilities::pa($id);  die;
        
        $scrape_data->date = date('Y-m-d'); 
        
        $scrape_data->save();
        }
        return redirect('/userprofile/'.$slug);
        
       
    }
    
    public function exportToCSV($search) {

        
        $user_ids = User::where("first_name", "like", "%" . $search . "%")
                ->orWhere("email", "like", "%" . $search . "%")
                ->lists('id');
        
        $all_data = User::whereIn('id',$user_ids)->get();

        $csv_data = array();
            $csv_data[0] = array('Name', 'Email'
        );
        $j = 1;
        
        
//        $promo_id = \App\Models\Coupon::where('user_id', $c->id)->pluck('promo_id');
        

        foreach ($all_data as $d) {

            $csv_data[$j][] = $d->full_name;
            $csv_data[$j][] = $d->email;
            

            $j++;
        }
        ZnUtilities::array_to_csv($csv_data, 'Report-' . date('y-m-d-H-i-s') . '.csv');
    }
    
   

}
