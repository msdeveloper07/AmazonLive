@extends('layouts.master')
@section('content')
@include('layouts.navbar')
<div class="container">
    <div class="row">
        <div class="col-md-12 page_title">
            <h3>Congratulations! you are now a Product Tester!</h3>
            <!--<a href="profile_edit.html">Edit</a>
            <div class="back_links">
                <ul>
                    <li><a href="users.html">User</a></li>
                    <li><a href="#">User X</a></li>
                </ul>
            </div>-->
            <div class="clearfix"></div>
        </div>
        
        <div class="col-md-12">
            <h4 style="text-transform:none">Step #1: Select a Product you want to review.</h4>
            <ul class="product_wrap text-center congratulations">
                @foreach($products as $p)
                @if($p->product_image)
                <li>
                    <a href="products/view/{{$p->product_slug}}">
                        <img src="<?php echo '/product_image/' . $p->product_image; ?>" alt="">
                        <span>{{$p->product_title}}</span>
                    </a>
                </li>
                @else
                <li>
                    <a href="products/view/{{$p->product_slug}}">
                        <img src="<?php echo '/images/product.jpg'; ?>" alt="">
                        <span>{{$p->product_title}}</span>
                    </a>
                </li>

                @endif
                @endforeach
            </ul>
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

