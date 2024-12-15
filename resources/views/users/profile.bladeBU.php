@extends('layouts.master')
@section('content')
@include('layouts.navbar')
@if(Auth::user()->user_group_id == '1')
<div class="container">
    <div class="row"> 
        <div class="col-md-12 page_title"> 
            <h3>User <a style="margin-top: -7px" href="">{{$user->first_name}} {{$user->last_name}}</a></h3> 
            <a href="/users/{{$user->id}}/edit/">Edit</a>   
            <div class="back_links">      
                <ul>             
                    <li><a href="">User</a></li>  
                    <li><a href="">{{$user->first_name}} {{$user->last_name}}</a></li> 
                </ul>       
            </div>       
            <div class="clearfix"></div>     
        </div>       
        <div class="col-md-6 space_bottom30"> 
            <div class="wrap_box">      
                <div class="row">  
                    <div class="col-md-6 col-sm-6 user_info">   
                        <h5>User Info</h5>   
                        <p>First Name:</p><span>{{$user->first_name}}</span>  
                        <p>Last Name:</p><span>{{$user->last_name}}</span>   
                        <p>Email:</p><span>{{$user->email}}</span>          
                    </div>            
                    <div class="col-md-6 col-sm-6">    
                        <div class="user_indenty">   
                            <img src="images/dummy.jpg" alt="">      
                            <a href="">{{$user->first_name}} {{$user->last_name}}</a>  
                        </div>                    <div class="clearfix"></div>    
                    </div>  
                    <div class="clearfix"></div>  
                    <form class="form-inline" action="/userStatus/{{$user->id}}" method="post" name="actions_form" id="actions_form">  
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">  
                        <div class="col-md-12 top30">
                            @if($user->user_status == 'active')   
                            <button type="submit" name="bulk_action" id="cid{{$user->id}}" class="theme_btn" value="blocked">Sof Ban User</button>  
                            @else  
                            <button type="submit" name="bulk_action" id="cid{{$user->id}}" class="theme_btn" value="active" style="background-color: red !important; border-color: red !important;">Activate User</button>    
                            @endif 
                        </div> 
                    </form>  
                </div>  
            </div> 
        </div>
        <div class="col-md-6 space_bottom30">
            <div class="wrap_box"> 
                <h5>Reviewer Info</h5> 
                <ul class="reviewer_list">
                    <li>Total Reviews Posted</li> 
                    <li>Average Rating of Tracked Reviews</li>
                    <li>Average Time to Leave Reviews After Receiving Coupon</li>
                </ul> 
            </div>     
        </div>     
        <div class="col-md-12"> 
            <div class="wrap_box"> 
                <h5>Post Promos</h5>
                <div class="table-responsive"><table class="table dashboard_table">
                        <thead class="thead-inverse">
                            <tr class="table_head">   
                                <th>Promo Link</th>   
                                <th>Product#1</th>  
                                <th>ASIN</th>    
                                <th>Star Rating</th>   
                                <th>Time to Posted</th> 
                                <th>Link to Review</th> 
                            </tr>               
                        </thead>          
                        <tbody>   
                            @foreach($promo as $p)    
                            <tr>        
                                
                                <th scope="row">{{$p->promo_name}}</th>   
                                <td>{{$p->product_title}}</td> 
                                <td>{{$p->asin}}</td>    
                                <td>Star Rating</td>  
                                <td>Time to Posted</td>   
                                <td>{{$p->created_at}}</td>    
                            </tr>        
                            @endforeach 
                        </tbody>        
                    </table>         
                </div> 
                <div class="clearfix"></div>    
                <h5>Pending Promos</h5>   
                <div class="table-responsive">
                    <table class="table dashboard_table">
                        <thead class="thead-inverse"> 
                            <tr class="table_head">  
                                <th>Promo Link</th>
                                <th>Product#1</th>  
                                <th>ASIN</th>      
                                <th>Star Rating</th>   
                                <th>Time to Posted</th> 
                                <th>Link to Review</th>    
                            </tr>                 
                        </thead>                  
                        <tbody>                  
                        </tbody>        
                    </table>  
                </div>     
                <!--pagination-->     
                <div class="row">   
                    <div class="col-md-12">   
                    </div>  
                </div>    
                <!--/pagination-->    
            </div>  
        </div>   
        <div class="clearfix"></div>    
        <div class="col-md-6 top30">    
            <div class="wrap_box height_auto">
                <h5>Amazon Reviewer Profile</h5>   
                <ul class="reviewer_list review_profile"> 
                    <li>Reviewer Name</li>
                    <li>Profile Link</li>  
                </ul>            
                <div class="clearfix"></div>  
                <div class="top30">    
                    <a href="/userScrap/{{$user->id}}" class="theme_btn">One Time scrape of User Amazon info</a>
                </div>  
            </div>      
        </div> 
    </div>
</div>
@else
<div class="container"> 
    <div class="row"> 
        <div class="col-md-12 page_title">
            <h3>Edit Profile</h3> 
            <a href="/users/{{$user->id}}/edit/">Edit</a>
            <div class="clearfix"></div>   
        </div>       
        <div class="col-md-6 space_bottom30">  
            <div class="wrap_box height_auto">   
                <div class="row">              
                    <div class="col-md-6 col-sm-6 user_info">
                        <h5>User Info</h5> 
                        <p>First Nmae:</p><span>{{$user->first_name}}</span>  
                        <p>Last Nmae:</p><span>{{$user->last_name}}</span>  
                        <p>Email:</p><span>{{$user->email}}</span>   
                    </div>             
                    <div class="col-md-6 col-sm-6"> 
                        <div class="user_indenty">   
                            <img src="images/dummy.jpg" alt="">    
                            <a href="">{{$user->first_name}} {{$user->last_name}}</a>   
                        </div>    
                        <div class="clearfix"></div>      
                    </div>             
                    <div class="clearfix"></div>      
                </div>          
            </div>      
        </div> 
    </div></div>
@endif
@endsection
