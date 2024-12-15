@extends('layouts.master')
@section('content')
@include('layouts.navbar')

<div class="container">
    <div class="row">
        <div class="col-md-12 page_title">
            <h3>Support</h3>
            <div class="clearfix"></div>
        </div>
        
        <div class="col-md-6">
            <div class="wrap_box edit_user_form">
                <div class="row">
                    <form class="form-horizontal edit_user_form" role="form" method="POST" action="/sendsupport">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                          <div class="col-md-12">
                           @if(Auth::check()) <input type="hidden" id="email" name="email" class="form-control" readonly value="{{Auth::user()->email}}"  placeholder="Email">@else
                            <input type="email" id="email" name="email" class="form-control" value=""  placeholder="Email">@endif
                        </div>
                        <div class="col-md-12">
                            <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject">
                        </div>
                        <div class="col-md-12">
                            <textarea id="subject_description" name="content" placeholder="Content"></textarea>
                        </div>
                        <div class="col-md-12 top20">
                            <input type="submit" class="theme_btn" value="Send">
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="footer_height"></div>   
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="footer">
                    Footer
                </div>
            </div>
        </div>
    </div>
</footer>
@endsection