@extends('layouts.master')

@section('content')
<div class="space"></div>
<div class="container">
    <div class="row">
          <div class="col-md-6 col-md-offset-3 text-center">
              <h3 class="login_heading">Become a Product Tester Today<span>!</span></h3>
             <div class="padding_left_right">
                <div class="login_warp">
             
                    <form class="form-horizontal edit_user_form" role="form" method="POST" action="{{ url('/register') }}">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input  type="hidden" name="user_group_id" value="2">
                        
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <input id="first_name" type="text" class="form-control" name="first_name" placeholder="First Name" value="{{ old('first_name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        
                         <div class="form-group">
                            <div class="col-md-12">
                                <input id="last_name" type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
                            </div>
                        </div>
                        
                        

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                           <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                    
<!--                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="user_group" id="user_group">
                                    <option value="1">Admin</option>
                                    <option value="2" selected="">User</option>
                                </select>   
                            </div>
                        </div>-->
       

                        <div class="col-md-12 top20">
                                <input class="theme_btn" type="submit" value="Become a Product Tester">
                            </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
