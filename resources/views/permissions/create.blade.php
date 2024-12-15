@extends('layouts.master')

@section('content')

<div class="content-header">
@if(isset($title))
<h2>{{$title}}</h2>
@endif
</div>
<div class="content">


<div class="row">
    <form  role="form" action='/permissions' name='user_form' id='user_form' method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">General</h3>
                </div>
                     
                     <div class="box-body">
                     <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="InputTitle">Component</label>
                            <select class="form-control" name="component" id="component">
                               
                                <option value=''>Select Component</option>
                                <option value='cp'>Control Pannel</option>
                            </select> 
                           
                              </div>
                    </div>
                    </div>
                    
                    <div class="row">
                       <div class="col-md-8">
                           <div class="form-group">
                              <label for="InputTitle">Elements</label>
                              <input type="text" placeholder="Ex: demo " id="element" name="element" class="form-control required"  value="">
                            </div>
                       </div>
                   </div>
                   
                     <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="InputTitle">Title</label>
                            <select class="form-control" name="title" id="title">
                           
                                <option value=''>Select Title</option>
                                <option value='manage'>Manage</option>
                                <option value='add'>Add</option>
                                <option value='edit'>Edit</option>
                                <option value='delete'>Delete</option>
                                <option value='search'>Search</option>
                                
                           
                            </select> 
                           
                              </div>
                    </div>
                    </div>
                    
                      </div><!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
@endsection