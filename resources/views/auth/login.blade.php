@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 top100 text-center">
                <div class="padding_left_right">
                    <div class="login_warp">
                        <h6>Login</h6>
                    <form class="form-horizontal edit_user_form" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <!--<label for="email" class="col-md-4 control-label">E-Mail Address</label>-->

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
                            <!--<label for="password" class="col-md-4 control-label">Password</label>-->

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                         <div class="text-left top20">
                                <input class="theme_btn" type="submit" value="Login">
								<div class="clearfix"></div>
                                <a href="/password/reset">I forgot my password</a> 
                            </div>
                        
                         <div class="clearfix"></div>
                    </form>
                       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
