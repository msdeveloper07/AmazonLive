@extends('layouts.master')
@include('layouts.navbar')
@section('content')


<div class="content">
    <div class="row">

        <div class="col-md-12 page_title">
            <h3>Edit-User X</h3>
            <div class="back_links">
                <ul>
                    <li><a href="users.html">User</a></li>
                    <li><a href="view_user.html">User X</a></li>
                    <li><a href="#">Edit</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-6">
            <div class="wrap_box edit_user_form">
                <div class="row">
                <form  role="form" action="/users/{{$id}}" name='user_form' id='user_form' method="post">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="_method" value="PUT">

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="First name" id="first_name" name="first_name" class="form-control required" value="{{$user->first_name}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Last name" id="last_name" name="last_name" class="form-control required" value="{{$user->last_name}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="email" placeholder="Ex: you@abc.com" id="email" name="email" class="form-control required"  value="{{$user->email}}">
                            </div>
                        </div>
                        
                     <div class="col-md-12">
                        <input type="text" id="primary_phone" name="primary_phone" class="form-control" placeholder="Primary Phone">
                    </div>
                    <div class="col-md-12">
                        <input type="text" id="address" name="address" class="form-control" placeholder="Address">
                    </div>
                    <div class="col-md-12">
                        <input type="text" id="address_optional" name="address_optional" class="form-control" placeholder="Address a (optional)">
                    </div>
                    <div class="col-md-12">
                        <input type="text" id="city" name="city" class="form-control" placeholder="City">
                    </div>
                    <div class="col-md-6">
                        <select class="form-control bfh-states" data-country="US" data-state="CA"><option value=""></option><option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AS">American Samoa</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="AF">Armed Forces Africa</option><option value="AA">Armed Forces Americas</option><option value="AC">Armed Forces Canada</option><option value="AE">Armed Forces Europe</option><option value="AM">Armed Forces Middle East</option><option value="AP">Armed Forces Pacific</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="DC">District of Columbia</option><option value="FM">Federated States Of Micronesia</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="GU">Guam</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MH">Marshall Islands</option><option value="MD">Maryland</option><option value="MA">Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="MP">Northern Mariana Islands</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PW">Palau</option><option value="PA">Pennsylvania</option><option value="PR">Puerto Rico</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VI">Virgin Islands</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyoming</option></select>
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="zipe" name="zipe" class="form-control" placeholder="Zip">
                    </div>


                    <div class="clearfix"></div>
                    <div class="col-md-12 top20">
                        <div class="amazon_reviewer">
                            <h5>Amazon Reviewer Profile</h5>
                            <input type="text" class="form-control" placeholder="Profile Link">
                        </div>
                    </div>
                    <div class="col-md-12 top20">
                        <input type="submit" class="theme_btn" value="Save User">
                    </div>
                </form>
                    </div>
            </div>
        </div>

    </div>
</div>
@endsection