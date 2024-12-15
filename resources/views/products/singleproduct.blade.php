@extends('layouts.master')
@section('content')
@include('layouts.navbar')
<div class="container">
    <div class="row">
        <div class="col-md-12 page_title">
            <!--<a href="profile_edit.html">Edit</a>-->
            <div class="back_links">
                <ul>
                    <li><a href="/products">Products</a></li>
                    <li><a href="#">Single Products</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-7 col-sm-7">
            <h3>{{$product_info->product_title}}</h3>
                <div class="reviewer_list">
                    <span>{!! $product_info->promo_description !!}</span>
<!--                    <li>A little about this product</li>
                    <li>And maybe some more that tells the user how they can use this product</li>-->
                </div>
                <div class="wrap_box height_auto top20">
                    <h5 class="text_trans">Promotion Detail</h5>
                    <ul class="reviewer_list review_profile">
                        <li>List Price: ${{$product_info->sales_price}}</li>
                        <li>You Pay: ${{$product_info->normal_price}}</li>
                        <li>Please review within 2 weeks!</li>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="top20">
                        <a href="/products/reviewproduct/{{$product_info->product_slug}}" class="theme_btn">Test and review this product</a>
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

