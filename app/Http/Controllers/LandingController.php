<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Coupon;
use App\Models\Promo;
use App\Models\User;
use Auth;

use App\Libraries\ZnUtilities;
use App\Http\Requests;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['title'] = "Landings";
        $data['active_landing_navbar'] = 'landing_active';
        $data['landings'] = Promo::all();
      
        return view('landings.landing',$data);
    }
    
   
    
    
    
    

    
}
