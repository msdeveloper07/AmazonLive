@extends('layouts.master')
@section('content')
@include('layouts.navbar')


<div class="content">
    <div class="row">
        <form  role="form" action='/promos' name='promo_form' id='promo_form' method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="col-md-12 page_title">
                <div class="back_links">
                    <ul>
                        <li><a href="">Promos</a></li>
                        <li><a href="#">Promo X</a></li>
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
                                    <input type="text" placeholder="Promo Name" id="promo_name" name="promo_name" class="form-control required" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="AISN" id="aisn" name="aisn" value="">
                            </div>
                            <div class="col-md-12">
                                <select name="status" id="status">
                                    <option>Active</option>
                                    <option>Deactive</option>
                                </select>
                            </div>

                            
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Sale Price" id="sales_price" name="sales_price" value="">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Normal Price" id="normal_price" name="normal_price" value="">
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Product Title" id="product_title" name="product_title" value="">
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Product Link" id="product_link" name="product_link" value="" >
                            </div>
                            <div class="col-md-12">
                                <textarea placeholder="Promo Description" id="description" name="description"></textarea>
                            </div>
                           
                            <div class="col-md-12">
                                <textarea placeholder="Landing Page Description" id="landing_page_des" name="landing_page_des"></textarea>
                            </div>
                           

                            <div class="fileinput fileinput-new" data-provides="fileinput">

                                <div class="fileinput-preview fileinput-exists thumbnail" style="display: inline-block; width: 200px; float: left"></div>
                                <div>
                                    <div class="clearfix"></div>
                                    <span class="btn btn-file">
                                        <div class="box-body box-profile">


                                            <div class="col-md-12">
                                                <input type="file"  id="upload-button" name="file" class="form-control file_upload" >
                                                <div for="upload-button" class="file_upload_div">Select File &nbsp; <i class="fa fa-upload" aria-hidden="true"></i></div>
                                            </div>


                                        </div>
                                       <!--  <span class="btn fileinput-exists" data-dismiss="fileinput">Remove</span> -->
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
                            <td><a href="/email_template/{{$et->email_template_id}}/">Edit</td>
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
                        <li>Total Coupons</li>
                        <li>Total Reviews Generated</li>
                        <li>Panding Reviews</li>
                    </ul>
                </div>
                <div class="wrap_box height_auto">
<!--                    <h5>Coupon Batchs</h5>
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
                                <tr>
                                    <td>06/16/16</td>
                                    <td>2000</td>
                                    <td>GHB</td>
                                </tr>
                                <tr class="table-active">
                                    <td>06/16/16</td>
                                    <td>3000</td>
                                    <td>VJS</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>-->
                    <div class="row">
<!--                        <div class="col-md-12 edit_user_form">
                            <select>
                                <option>Filename</option>
                            </select>
                        </div>-->
<div id="file_uploaded" ></div><br>
               <div id="progress_bar"></div>
                             
       <div class="batch_upload">
                
                  <input type="file" id="upload-batch" name="batch_file" />
                <!--<div class="file_upload_div" >Upload new batch of codes &nbsp; <i class="fa fa-upload" aria-hidden="true"></i></div>-->
                    </div>
                    </div>
                    <div class="clearfix"></div>
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