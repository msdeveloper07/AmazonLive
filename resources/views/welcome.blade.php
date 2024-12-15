@extends('layouts.master')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 top100 text-center index_wrap">
            <div class="login_warp"><div class="row">
                <div class="col-md-12">
                    <!--<h4 class="text_trans">Admin View</h4>-->
                    <a href="/login" class="col-md-12 theme_btn">Login</a>
                </div>
            </div>
            <div class="row top30">
                <!--<h4 class="text_trans">User View</h4>-->
                <div class="col-md-12 col-sm-6">
                    <a href="/register" class="col-md-12 theme_btn">Signup Here</a>
                </div>
<!--                <div class="col-md-6 col-sm-6">
                    <a href="/landingpage" class="col-md-12 theme_btn">Landing Page</a>
                    <a href="auth/public_landing_page.html" class="index_btn">Landing Page</a>
                </div>-->
                </div></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
    </div>
</div>
@endsection
