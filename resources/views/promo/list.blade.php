@extends('layouts.master')
@section('content')
@include('layouts.navbar')

<div class="content">
    <form class="form-inline" action="/promoAction" method="post" name="actions_form" id="actions_form">
    <div class="col-md-12 page_title">
        <h3>Promos</h3>
<a href="">Filter by Promo</a>
            <div class="user_search">
              
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="text" class="form-control"  name="search" value="{{isset($search)?$search:''}}" placeholder="Search Page" aria-describedby="basic-addon2"> 
                <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search" aria-hidden="true"></i></button>
            
             
                    
                <a class="theme_btn" href="promos/create" style="color: #fff; margin-left: 20px; margin-top: -10px;">Create New Promo</a>
                  
                
            
            </div>
        <div class="clearfix"></div>
    </div>

    <div class="col-md-12">
        <div class="wrap_box">
            <div class="table-responsive"><table class="table dashboard_table">
                    <thead class="thead-inverse">
                        <tr class="table_head">
                            <th>Promo Name</th>
                            <th>ASIN</th>
                            <!--<th>#Codes</th>-->
                            <th>Status</th>
                            <th>Edit</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($promos as $c)
                        <tr>
                            <th scope="row">{{$c->promo_name}}</th>
                            <td  data-title="aisn">{{$c->aisn}}</td>
                            <!--<td  data-title="codes">{{$c->codes}}</td>-->
                            <td  data-title="status">{{$c->promo_status}}</td>
                            <td><a href="/promos/{{$c->promo_slug}}/edit/">Edit</a></td>
                            <!--<td><a href="/promos/{{$c->id}}/edit/" title="Edit"><i class="fa fa-pencil-square fa-lg"></i>&nbsp;Edit</a></td>-->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                <!--pagination-->
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                          <ul class="pagination">
                           
                             {!! $promos->render() !!}
                          </ul>
                        </nav>
                    </div>
                </div>
                <!--/pagination-->
                
                <div class="row">
                    <div class="col-md-12">
                        <a class="theme_btn" href="promos/create">Create New Promo</a>
                    </div>
                </div>
        <div class="clearfix"></div>
    </form>
    </div>
    </div>

    @endsection

