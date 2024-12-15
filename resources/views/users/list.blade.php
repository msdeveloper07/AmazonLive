@extends('layouts.master')
@section('content')
@include('layouts.navbar')



<div class="content">
    <form class="form-inline" action="/userAction" method="post" name="actions_form" id="actions_form">
        <div class="col-md-12 page_title">
            <h3>Users</h3>
            <a href="">Filter by Promo</a>
            <div class="user_search">
              
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="text" class="form-control"  name="search" value="{{isset($search)?$search:''}}" placeholder="Search Page" aria-describedby="basic-addon2"> 
                <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search" aria-hidden="true"></i></button>
            
            @if(isset($search))
               
            <a class="theme_btn" href="/exportToCSVFile/{{isset($search)?$search:''}}"style="color: #fff; margin-left: 20px; margin-top: -10px;">Export Users</a>
               
            @endif
            
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="col-md-12">
            <div class="wrap_box height_auto">
                <div class="table-responsive"><table class="table dashboard_table">
                        <thead class="thead-inverse">
                            <tr class="table_head">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Total Promos</th>
                                <th>Average Rating</th>
                                <th>&nbsp;</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $c)
                            <tr>
                                <th scope="row">{{$c->full_name}}</th>
                                <td  data-title="Email">{{$c->email}}</td>
                                <?php
                                $promo_id = \App\Models\Coupon::where('user_id', $c->id)->pluck('promo_id');
                                
                                       $user_rating = \App\Models\Scrape::where('user_id', $c->id)->pluck('review_star')->toArray();
                                       $user_rating_total = count($user_rating);
                                       if($user_rating_total>0){
                                       $user_rating_total_stars = array_sum($user_rating);
                                       $average_stars1 = $user_rating_total_stars / $user_rating_total ;
                                       $average_stars = number_format($average_stars1, 1, ".", "");
                                       }
                                       else{
                                         $average_stars = '0';  
                                       }
                                ?>
                                <td  data-title="Total Promos">{{count($promo_id)}}</td>
                                <td  data-title="Average Rating">{{isset($average_stars)?$average_stars:'0'}}</td>
                                <td><a href="/userprofile/{{$c->user_slug}}">View User</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--export_user-->
<!--                @if(count($users) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <a class="theme_btn" href="/exportToCSVFile/{{isset($search)?$search:''}}">Export Users</a>
                    </div>
                </div>
                @endif-->
                <!--/export_user-->
                <!--pagination-->
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <ul class="pagination">

                                {!! $users->render() !!}
                            </ul>
                        </nav>
                    </div>
                </div>
                <!--/pagination-->
            </div>
        </div>
        <div class="clearfix"></div>
        
    </form>
    
</div>


@endsection

