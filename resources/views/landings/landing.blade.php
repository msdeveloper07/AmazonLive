@extends('layouts.master')

@section('content')
@include('layouts.navbar')

<?php

//print_r($product_info); die;

?>
<div class="container">
    <div class="row">
        <div class="col-md-12 page_title text-center">
            <h3 class="text_trans">Try this cool product for just ${{$product_info->sales_price}}-Normally over ${{$product_info->normal_price}}!</h3>

            <div class="clearfix"></div>
        </div>



        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="col-md-7 col-sm-7">
                    <h5 class="public_page_heading"></h5>
                    <p class="top20"></p>
                    <div class="reviewer_list top20">
                        <span>{!! $product_info->landing_page_des !!}</span>

                    </div>
                </div>
                <div class="col-md-5 col-sm-5">
                    <div class="wrap_box height_auto">
                        @if($product_info->product_image)
                        <img width="100%" src="/product_image/{{$product_info->product_image}}" alt="">
                        @else
                        <img src="/images/product_big.jpg" alt="" width="100%">
                        @endif
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
             <div class="col-md-6 col-md-offset-3 top30 text-center">
                <div class="padding_left_right">
                    <div class="login_warp">
                        <h6>Fill out the form to start receiving your products</h6>
                        
                        <form class="form-horizontal edit_user_form" role="form" method="POST" action="/savelandinguser/{{$product_info->promo_slug}}">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input  type="hidden" name="user_group_id" value="2">
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
                        
                         <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" placeholder="First Name" value="{{ old('first_name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        
                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="col-md-6{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" value="">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        

                        
                            <div class="col-md-6{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        
<!--                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="First Name">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Last Name">
                            </div>-->
                          
                            <div class="col-md-12 top20">
                                @if(\Auth::check())
                                <a  class="theme_btn" onclick="alert('This is only for priview test')" >Test and Review This Product!</a>
                               @else <input class="theme_btn" type="submit" value="Test and Review This Product!">
                                @endif
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
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

