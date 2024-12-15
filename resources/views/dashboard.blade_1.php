@extends('layouts.master')
@section('content')
@include('layouts.navbar')

<?php
$date = date('Y-m-d');
$todayusers = \App\Models\User::where('created_at',$date)->lists('created_at');

$lastday = date('Y-m-d', strtotime('-1 day', strtotime($date))); 
$yesterday = \App\Models\User::where('created_at',$lastday)->lists('created_at');

$lastmonth = date('Y-m-d', strtotime('-1 month', strtotime($date)));


$lastSeven = date('Y-m-d', strtotime('-7 day', strtotime($date)));

$seven = \App\Models\User::whereBetween('created_at',[$date, $lastSeven])
                           ->orWhereBetween('created_at',[$date, $lastSeven]) 
        ->lists('created_at');

//App\Libraries\ZnUtilities::pa($seven);    die;

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
                      <td>50</td>
                      <td>55</td>
                      <td>350</td>
                      <td>4000</td>
                    </tr>
                    <tr>
                      <th scope="row">Coupons Sent</th>
                      <td>60</td>
                      <td>75</td>
                      <td>400</td>
                      <td>4500</td>
                    </tr>
                    <tr>
                      <th scope="row">New Users</th>
                      <td>{{count($todayusers)}}</td>
                      <td>{{count($yesterday)}}</td>
                      <td>70</td>
                      <td>150</td>
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
                    <li><a href="#">User #1</a></li>
                    <li><a href="#">User #2</a></li>
                    <li><a href="#">User #3</a></li>
                    <li><a href="#">User #4</a></li>
                    <li><a href="#">User #5</a></li>
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="footer_height"></div> 




@endsection
