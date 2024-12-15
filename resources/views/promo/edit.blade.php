@extends('layouts.master')
@section('content')
@include('layouts.navbar')

<div class="content">
    <div class="row">
 <form  role="form" action="/promos/{{$promo->promo_slug}}" name='promo_form' id='promo_form' method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                     <input type="hidden" name="_method" value="PUT">
        <div class="col-md-12 page_title">
            <div class="back_links">
                <ul>
                    <li><a href="">Promos</a></li>
                    <li><a href="#">{{$promo->promo_name}}</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-8">
            <div class="wrap_box edit_user_form">
                <div class="row">

                   


                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Promo Name" id="promo_name" name="promo_name" class="form-control required" value="{{$promo->promo_name}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="AISN" id="aisn" name="aisn" value="{{$promo->aisn}}">
                            </div>
                            <div class="col-md-12">
                                <select name="status" id="status">
                                    <option {{$promo->promo_status=='active'?'selected="selected"':''}} value="active">Active</option>
                                    <option {{$promo->promo_status=='deactive'?'selected="selected"':''}} value="deactive">Deactive</option>
                                </select>
                            </div>
                           
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Sale Price" id="sales_price" name="sales_price" value="{{$promo->sales_price}}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Normal Price" id="normal_price" name="normal_price" value="{{$promo->normal_price}}">
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Product Title" id="product_title" name="product_title" value="{{$promo->product_title}}">
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Product Link" id="product_link" name="product_link" value="{{$promo->product_link}}" >
                            </div>
                            <div class="col-md-12">
                                <textarea placeholder="Promo Description" id="description" name="description">{{$promo->promo_description}}</textarea>
                            </div>      
                         <div class="col-md-12">
                                <textarea placeholder="Landing Page Description" id="landing_page_des" name="landing_page_des">{{$promo->landing_page_des}}</textarea>
                            </div>
                         
                            
        <div class="col-md-3" id="old_image">
            <div class="form-group">
                <img class="img img-thumbnail" src="<?php echo '/product_image/' . $promo->product_image; ?>" /><br/>
            </div>
        </div>

                            
    <div class="fileinput fileinput-new" data-provides="fileinput">
        <div class="fileinput-preview fileinput-exists thumbnail" style="display: inline-block; width: 200px; float: left"></div>   
        <div>
            <div class="clearfix"></div>
            <span class="btn btn-file">
                <div class="box-body box-profile">
                    <div class="col-md-12">
                        <input type="file"  id="upload-button" name="file" value="" class="form-control file_upload"  >
                        <div for="upload-button" class="file_upload_div">Select File &nbsp; <i class="fa fa-upload" aria-hidden="true"></i></div>
                    </div>
                </div>
            </span>
        </div>
    </div>
                            

    <div class="clearfix"></div>
    <div class="col-md-12"><hr></div>
    <div class="col-md-12">
        <div class="amazon_reviewer">
            <h5>Emails Templates</h5>
            <div class="table-responsive"><table class="table dashboard_table">
                    <thead class="thead-inverse">
                        <tr class="table_head">
                            <th>Email Name #1</th>
                            <th>Time Delay</th>
                            <th>#Sends</th>
                            <th>#Opens</th>
                            <th>Template 1</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($email_templates) > 0)
                        @foreach($email_templates as $key=>$et)
                  <tr class="">
                            <td>{{$et->email_template_title}}</td>
                            <td>{{$et->time_delay}}</td>
                            <td></td>
                            <td>#Opens</td>
                            <td>{{$et->order }}</td>
                            <td><a href="/email_template/{{$et->email_template_id}}/{{$id}}/">Edit</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><!-- /.box-body -->


</div>
</div>
</div>


        <div class="col-md-4">
            <div class="wrap_box height_auto space_bottom30">
                <h5>Promo Info</h5>
                <ul class="reviewer_list">
                    <li>Total Coupons : @if(isset($coupon)){{count($coupon)}} @endif</li>
                    <li>Total Reviews Generated : @if(isset($generate_coupon)){{count($generate_coupon)}} @endif</li>
                    <li>Panding Reviews : @if(isset($pending_coupon)){{count($pending_coupon)}} @endif</li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                <a href="/{{$promo->promo_slug}}" class="theme_btn" title="Preview" target="_blank">Landing Page</a>
            </div>
               
            </div><br>
            <div class="wrap_box height_auto">
<!--                <h5>Coupon Batchs</h5>
                <div class="table-responsive">
                    <table class="table dashboard_table">
                        <thead class="thead-inverse">
                            <tr class="table_head">
                                <th>Date</th>
                                <th>Count</th>
                                <th>Code Prefix</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($coupon_batch as $cb)
                            <tr>
                                <td>{{$cb->date_imported}}</td>
                                <td>{{$cb->count}}</td>
                                <td>{{$cb->code_prefix}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>-->
                
                <div class="row">
<!--                        <div class="col-md-12 edit_user_form">
                            <select>
                                <option>Filename</option>
                            </select>
                        </div>-->

<!--                        <div id="prev_upload">
                            <input type="hidden"  name="profile_pic">
                        </div>

                        <div class="col-md-12 batch_upload">
                            <input type="file" name="batch_file" class="form-control file_upload">
                            <div class="file_upload_div" >Upload new batch of codes &nbsp; <i class="fa fa-upload" aria-hidden="true"></i></div>
                        </div>-->
<div id="file_uploaded" ></div><br>
<div id="progress_bar"></div>


                               
       <div class="batch_upload">
                
                  <input type="file" id="upload-batch" name="batch_file" />
                <!--<div class="file_upload_div" >Upload new batch of codes &nbsp; <i class="fa fa-upload" aria-hidden="true"></i></div>-->
                    </div>
                    </div>
                    <div class="clearfix"></div>
                
                <!--<div class="row">-->
<!--                    <div class="col-md-12 edit_user_form">
                        <select>
                            <option>Filename</option>
                        </select>
                    </div>-->
                    <!--<form  role="form" action="/batchfilesave/{{$id}}" name='promo_form' id='promo_form' method="post" enctype="multipart/form-data">-->
                    <!--<input type="hidden" name="_token" value="<?php // echo csrf_token(); ?>">-->
                   
                    
<!--                    <div class="col-md-12 batch_upload">
                        <input type="file" name="batch_file" class="form-control file_upload">
                        <div class="file_upload_div" >Upload new batch of codes &nbsp; <i class="fa fa-upload" aria-hidden="true"></i></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="top20"></div>
                    <div class="col-md-12">-->
                       
                      <!--<h5>{{isset($batch_file->code_prefix)?$batch_file->code_prefix:''}}</h5>-->
                    <!--</div>-->
                    
<!--                    <div class="col-md-12 top20">
                        <input type="submit" class="theme_btn" value="Save Promo">
                    </div>-->
                    <!--</form>-->
                <!--</div>-->
               
            </div>
        </div>
        <div class="clearfix"></div>
<div class="col-md-12 top20">
    <input type="submit" class="theme_btn" value="Save Promo">
</div>
</form>
    </div>
</div>
@endsection