@extends('layouts.master')
@section('content')
@include('layouts.navbar')

<?php
$recentLogins = \App\Models\User::orderBy('last_login','DESC')->get();
//\App\Libraries\ZnUtilities::pa($recentLogins);die;
//$user->last_login = date('Y-m-d H:i:s');
//$user->save();


$date = date('Y-m-d');


$lastday = date('Y-m-d', strtotime('-1 day', strtotime($date))); 

$lastmonth = date('Y-m-d', strtotime('-1 month', strtotime($date)));

 $lastmonthstart = date('Y-m-01', strtotime($lastmonth));
 $lastmonthend = date('Y-m-t', strtotime('-1', strtotime($lastmonth)));

$lastSeven = date('Y-m-d', strtotime('-7 day', strtotime($date)));

$todayusers = \App\Models\User::where('created_at',$date)->lists('created_at');
$yesterday = \App\Models\User::where('created_at',$lastday)->lists('created_at');
$seven = \App\Models\User::where('created_at','>=', $lastSeven)->where('created_at','<=', $date)->get();
$month = \App\Models\User::where('created_at','>=', $lastmonthstart)->where('created_at','<=', $lastmonthend)->get();


$todaysreview = \App\Models\Review::where('date_submitted_on',$date)->get()->count();
$yesterdaysreview = \App\Models\Review::where('date_submitted_on',$lastday)->get()->count();
$lastweekreview = \App\Models\Review::where('date_submitted_on','>=', $lastSeven)->where('date_submitted_on','<=', $date)->get()->count();
$latsMonthreview = \App\Models\Review::where('date_submitted_on','>=', $lastmonthstart)->where('date_submitted_on','<=', $lastmonthend)->get()->count();


$todayscouponsent = \App\Models\Coupon::where('date_send_on',$date)->where('user_id','!=',0)->get()->count();
$yesterdayscouponsent = \App\Models\Coupon::where('date_send_on',$lastday)->where('user_id','!=',0)->get()->count();
$lastweekcouponsent = \App\Models\Coupon::where('date_send_on','>=', $lastSeven)->where('date_send_on','<=', $date)->where('user_id','!=',0)->get()->count();
$latsMonthcouponsent = \App\Models\Coupon::where('date_send_on','>=', $lastmonthstart)->where('date_send_on','<=', $lastmonthend)->where('user_id','!=',0)->get()->count();



?>
<div class="container">
    <div class="row">
        <div class="col-md-12 page_title">
            <h3>Dashboard</h3>
        </div>
        <div class="col-md-8">
            <div class="wrap_box">
                <h5>Status</h5>
                <div class="table-responsive"><table class="table table-responsive dashboard_table">
                  <thead class="thead-inverse">
                    <tr>
                      <th></th>
                      <th>Today</th>
                      <th>Yesterday</th>
                      <th>Last 7 Days</th>
                      <th>Last Month</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">New Reviews</th>
                      <td>{{$todaysreview}}</td>
                      <td>{{$yesterdaysreview}}</td>
                      <td>{{$lastweekreview}}</td>
                      <td>{{$latsMonthreview}}</td>
                    </tr>
                    <tr>
                      <th scope="row">Coupons Sent</th>
                      <td>{{$todayscouponsent}}</td>
                      <td>{{$yesterdayscouponsent}}</td>
                      <td>{{$lastweekcouponsent}}</td>
                      <td>{{$latsMonthcouponsent}}</td>
                    </tr>
                    <tr>
                      <th scope="row">New Users</th>
                      <td>{{count($todayusers)}}</td>
                      <td>{{count($yesterday)}}</td>
                      <td>{{count($seven)}}</td>
                      <td>{{count($month)}}</td>
                    </tr>
                  </tbody>
                </table>
                </div>
            </div>
        </div>
        <!--<div class="clearfix"></div>
        <div class="col-md-8"><hr></div>
        <div class="clearfix"></div>-->
        <div class="col-md-4">
            <div class="wrap_box">
                <h5>Recent Logins</h5>
                <ul class="dashboard_login_list">
                    @foreach($recentLogins as $key=>$rl)
                    @if($key < 5)
                    <li><a href="/userprofile/{{$rl->user_slug}}">{{$rl->first_name}} {{$rl->last_name}}</a></li>
                    @endif
                  @endforeach
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="footer_height"></div> 




@endsection
