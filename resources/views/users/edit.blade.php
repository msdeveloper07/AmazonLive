@extends('layouts.master')

@section('content')
@include('layouts.navbar')
<?php
//App\Libraries\ZnUtilities::pa($county);    die;
?>
<div class="content">
    <div class="row">
        <div class="col-md-12 page_title">
            <h3>Edit Account  Settings </h3>
            <div class="back_links">
                <ul>
                    <li><a href="/userprofile/{{$user->user_slug}}">Profile</a></li>
                    <!--<li><a href="">{{$user->first_name}} {{$user->last_name}}</a></li>-->
                    <li><a href="">Edit</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-6">
            <div class="wrap_box edit_user_form">
                <div class="row">
                    <form  role="form" action="/updateusers/{{$user->user_slug}}" name='user_form' id='user_form' method="post">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">


                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="First name" id="first_name" name="first_name" class="form-control required" value="{{$user->first_name}}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Last name" id="last_name" name="last_name" class="form-control required" value="{{$user->last_name}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="email" placeholder="Ex: you@abc.com" id="email" name="email" class="form-control required"  value="{{$user->email}}" required>
                            </div>
                        </div>
                        
<!--                         <div class="col-md-12">
                            <select name="status" id="status">
                                <option {{$user->user_status=='active'?'selected="selected"':''}} value="active">Avtive</option>
                                <option {{$user->user_status=='blocked'?'selected="selected"':''}} value="blocked">Blocked</option>
                            </select>
                        </div>-->
                        
                        @if(Auth::user()->user_group_id == '1')  
                        <div class="col-md-12">
                            <input type="text" id="primary_phone" name="primary_phone" class="form-control" placeholder="Primary Phone" value="{{$user->primary_phone}}" required>
                        </div>
                        <div class="col-md-12">
                            <input type="text" id="address" name="address" class="form-control" placeholder="Address" value="{{$user->address}}" required>
                        </div>
                        <div class="col-md-12">
                            <input type="text" id="address_optional" name="address_optional" class="form-control" placeholder="Address a (optional)" value="{{$user->address_optional}}">
                        </div>
                        <div class="col-md-12">
                            <input type="text" id="city" name="city" class="form-control" placeholder="City" value="{{$user->city}}">
                        </div>
                        
                        
                        
                        <div class="col-md-6">
                            <div class="form-group">

                                <select name="county" id="county" class="form-control" required>
                                    <option value="" >Please Select County</option>
                                    @foreach($county as $t)
                                    <option {{$t==$user->county?'selected="selected"':''}} value="{{$t}}">{{$t}}</option>
                                    @endforeach
                                </select>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="zip_code" name="zip_code" class="form-control" placeholder="Zip" value="{{$user->zip_code}}" required>
                        </div>
                        
                       

                        <div class="clearfix"></div>
                        <div class="col-md-12 top20">
                            <div class="amazon_reviewer">
                                <h5>Amazon Reviewer Profile</h5>
                                <input type="text" class="form-control" name="profile_link" id="profile_link" placeholder="Profile Link" value="{{$user->profile_link}}" required>
                            </div>
                        </div>
                        @endif
                        <div class="col-md-12 top20">
                            <input type="submit" class="theme_btn" value="Save Changes">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection