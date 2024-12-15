@extends('layouts.master')
@section('content')
@include('layouts.navbar')


<div class="container">
    <div class="row">
        <div class="col-md-12 page_title">
            <div class="back_links">
                <ul>
                    <li><a href="/promos">Promos</a></li>
                    <li><a href="#">Promo X</a></li>
                    <li><a href="/email_template/{{$id}}/">Edit Email X</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="col-md-8">
            <div class="wrap_box edit_user_form">
                <div class="row">
                    <form  role="form" action="/email_template_save/{{$id}}/{{isset($promo_id)?$promo_id:''}}" name='promo_form' id='promo_form' method="post" enctype="multipart/form-data">
                         <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="col-md-12">
                        <label class="">Subject    </label>
                        <input name="email_subject" type="text" class="form-control" placeholder="Subject" value="{{isset($emailTemplates[0])?$emailTemplates[0]->email_template_title : ''}}">
                        
                    </div>
                         
                    <div class="col-md-12">
                        <label class="">Content 1   </label>
                        <textarea name="email_content_1" id="email_content_1" placeholder="Template Text">{{isset($emailTemplates[0])?$emailTemplates[0]->content : ''}}</textarea>
                    
                    </div>
                      
                      
                    <div class="col-md-12">
                        <label class="">Content 2   </label>
                        <textarea name="email_content_2" id="email_content_2" placeholder="Template Text">{{isset($emailTemplates[1])?$emailTemplates[1]->content : ''}}</textarea>
                    
                    </div>
                      
                        
                    <div class="col-md-12">
                        <label class="">Content 3   </label>
                        <textarea name="email_content_3" id="email_content_3" placeholder="Template Text">{{isset($emailTemplates[2])?$emailTemplates[2]->content : ''}}</textarea>
                    
                    </div>
                      
                         <div class="col-md-6">
                         <div class="fileinput fileinput-new" data-provides="fileinput">
        <div class="fileinput-preview fileinput-exists thumbnail" style="display: inline-block; width: 200px; float: left"><img src="/emailTemplateImages/{{isset($emailTemplates[0])?$emailTemplates[0]->attachment : ''}}" width="200px"></div>   
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
                    </div>
                         <?php  foreach($emailTemplates as $s){ ?>
                       <input type="hidden"  id="" name="temp_ids[]" value="{{$s->email_template_id}}" class="form-control file_upload"  >
                <?php         }?>
                         
                    <div class="clearfix"></div>
                        <div class="col-md-12"><hr></div>
                    
                    <div class="col-md-12">
                        <input type="submit" class="theme_btn" value="Save Email Template">
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        </div>

    @endsection
    