@extends('layouts.master')

@section('content')
<div class="content-header">
@if(isset($title))
<h2>{{$title}}</h2>
@endif
</div>
<div class="content">


<form class="form-inline" action="/permissionAction" method="post" name="actions_form" id="actions_form">

<div class="box box-danger">
    
        
    <div class="box-body">
         <div class="row">
             
             <div class="col-md-4">
                     Actions
                     <div class="form-group">
                        <select id="bulk_action" name="bulk_action" class="form-control" placeholder="Select Action"  >
                            <option value="">Select An Action</option>
                          
                            <option value="delete">Delete Selected Permissions</option>
                        </select>
                     </div>
                 
             </div>
             
             
                <div class="col-md-4">
                  
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                        <div class="input-group">
                          <input type="text" value="<?php if(isset($search)){ echo $search;}?>" class="form-control" name="search" id="search" placeholder="Search Permissions">
                          <span class='input-group-btn'>
                          <button type="submit" class="btn btn-default btn-flat">Find Permission</button>
                          </span>
                        </div>
                      
                </div>

                <div class="col-md-2">
                    <a href="/permissions/create" class="btn btn-primary btn-flat">Add New Permissions </a>
                </div>
               @if(isset($search))
                <div class="col-md-2">
                    <a href="/permissions" class="btn btn-info btn-flat">Show All Permissions</a>
                </div>  
                 @endif
            </div>
    </div>    
   



<div class='table-responsive'>
    <table class="table table-hover table-bordered pull-left table-striped table-condensed admin-user-table">
    <thead>
        <tr>
            <th>
            <!-- <button id="checkall" class="btn-info">Toggle</button>-->
            <input type="checkbox" id="checkall" class="check" value="" />
            </th>
       
            <th>Element</th>
            <th>Component</th>
            <th>Title</th>
           
            <th>&nbsp;</th>
           
       </tr>
     </thead>
     <tbody>
        @foreach($permissions as $c)
       <tr>
           <td  data-title="Select">
               <input type="checkbox" class="check" name="cid[]" value="{{$c->permission_id}}" id="cid{{$c->permission_id}}" />
           </td>

           <td  data-title="User Name">
               <a href="/permissions/{{$c->permission_id}}/edit/" title="Edit">
                 {{$c->element}} 
               </a>
           </td>
           <td  data-title="Email">{{$c->component}}</td>
           <td  data-title="title">{{$c->title}}</td>
          
          
           
           <td>
              <a href="/permissions/{{$c->permission_id}}/edit/" title="Edit"><i class="fa fa-pencil-square fa-lg"></i>&nbsp;Edit</a>
                  
           </td>
       </tr>
       @endforeach
    </tbody>


</table>
</div>
</div>

</form>
</div>

@endsection

