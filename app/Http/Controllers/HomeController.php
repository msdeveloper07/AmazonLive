<?php

namespace App\Http\Controllers;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        $data['active_dashboard_navbar'] = 'dashboard_active';

        if ((isset(Auth::user()->user_group_id) ? Auth::user()->user_group_id : '') == '1') {
            return view('dashboard', $data);
        } elseif ((isset(Auth::user()->user_group_id) ? Auth::user()->user_group_id : '') == '2') {
            return redirect('products');
        }
    }

}
