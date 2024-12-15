@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 top100 text-center">
            <div class="padding_left_right">
                <div class="login_warp">
                    <h6>Reset Password</h6>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="edit_user_form" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <!--<label for="email" class="col-md-4 control-label">E-Mail Address</label>-->

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" placeholder="E-Mail Address" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                            <div class="col-md-12 top20">
<!--                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                                </button>-->
                            <input class="theme_btn" type="submit" value="Send Password Reset Link"
                            </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
