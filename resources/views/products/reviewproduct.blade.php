@extends('layouts.master')
@section('content')
@include('layouts.navbar')

<?php
//\App\Libraries\ZnUtilities::pa($coupon_code);   die;
?>

<div class="container">
    <div class="row">
        <div class="col-md-12 page_title">
            <!--<a href="profile_edit.html">Edit</a>-->
            <div class="back_links">
                <ul>
                    <li><a href="/products">Products</a></li>
                    <li><a href="#">Product X</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-7 col-sm-7">
            <h3>{{$product_info->product_title}}</h3>
              
                {!! $product_info->promo_description !!}

               
                <div class="wrap_box height_auto top20">
                    <h5 class="text_trans">Promotion Detail</h5>
                    <ul class="reviewer_list review_profile">
                        <li>List Price: ${{$product_info->sales_price}}</li>
                        <li>You Pay: ${{$product_info->normal_price}}</li>
                        <li>Please review within 2 weeks!</li>
                    </ul>
                    <div class="wrap_box_inner">
                        <h5 class="text_trans">Coupon code: 
                       
                                {{isset($coupon_code->coupon_code)?$coupon_code->coupon_code:''}}
                      
                        </h5>
                        <h5 class="text_trans">Purchase Product Here: {{$product_info->product_link}}</h5>
                        <h5 class="text_trans">How to leave your review: <a href="#">Learn More</a></h5>
                    </div>
                    <div class="clearfix"></div>
                    
                    <div class="top20">
                        <form role="form" action='/saveReview/{{$product_info->promo_id}}' name='promo_form' id='promo_form' method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <h4 class="text_trans nomargin">Leave your Review? Enter the link below:</h4>
                        <p><a href="#">Where can i find review link?</a></p>
                        <div class="edit_user_form top20">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" name="review_link" class="form-control" placeholder="Review Link" >
                                </div>
                            </div>
                        </div>
                        <button type="sunmit" class="theme_btn" value="">Save Link</button>
                     </form>
                    </div>
                   
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
            <div class="wrap_box height_auto top30">
                <h5 class="text_trans nomargin">Need Help Finding Your Reviewer Link?</h5>
                <p>Watch this video:</p>
                <img class="top20" width="100%" src="/images/video.jpg" alt="">
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

