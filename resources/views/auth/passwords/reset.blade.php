@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
         <div class="col-md-6 col-md-offset-3 top100 text-center">
            <div class="padding_left_right">
                <div class="login_warp">
                    <h6>Reset Password</h6>

                <div class="panel-body">
                    <form class="form-horizontal edit_user_form" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <!--<label for="email" class="col-md-4 control-label">E-Mail Address</label>-->

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" placeholder="E-Mail Address" name="email" value="{{ $email or old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <!--<label for="password" class="col-md-4 control-label">Password</label>-->

                            <div class="col-md-12">
                                <input id="password" type="password" placeholder="Password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <!--<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>-->
                            <div class="col-md-12">
                                <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                            <div class="col-md-12 top20">
<!--                                <button type="submit" class="theme_btn">
                                     Reset Password
                                </button>-->
                            <input class="theme_btn" type="submit" value="Reset Password"
                            </div>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection