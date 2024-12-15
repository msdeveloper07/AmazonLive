@extends('layouts.master')

@section('content')
<div class="content-header">
@if(isset($title))
<h2>{{$title}}</h2>
@endif
</div>
<div class="content">
<div class="row">
    <form  role="form" action='/userGroups/{{$id}}' name='user_form' id='user_form' method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <input type="hidden" name="_method" value="PUT">


        <div class="col-md-10">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">General</h3>
                </div><!-- /.box-header -->

                 <div class="box-body">
                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="InputTitle">User Group Name</label>
                            <input type="text" placeholder="use group name" id="user_group_name" name="user_group_name" class="form-control required" value="{{$usergroup->user_group_name}}">
                        </div>
                    </div>
                        
                          <div class="col-md-4">
                            <div class="form-group">
                                <label for="InputTitle">Parent Group</label>
                                <select name="user_group_parent_id" required id="user_group_parent_id" class="form-control required">
                                    <option value="">Please Select</option>
                                    <option {{$usergroup->parent_id==0?'selected="selected"':''}} value="0">Root</option>
                                  @foreach($parent_user_groups as $u)
                                  <option {{$usergroup->parent_id==$u->user_group_id?'selected="selected"':''}} value="{{$u->user_group_id}}">{{$u->user_group_name}} </option>
                                  @endforeach

                                   
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