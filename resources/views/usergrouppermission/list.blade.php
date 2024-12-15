@extends('layouts.master')

@section('content')
<div class="content-header">
@if(isset($title))
<h2>{{$title}}</h2>
@endif
</div>
<div class="content">

<form class="form-inline" action="/userGroupPermissionAction" method="post" name="actions_form" id="actions_form">

<div class="box box-danger">
    
        
    <div class="box-body">
         <div class="row">
             
             <div class="col-md-4">
                 
             </div>
             
             
                <div class="col-md-5">
                  
                      
                      
                </div>

                <div class="col-md-2">
                    <a href="/userGroupPermissions/create" class="btn btn-primary btn-flat">Add New User Group Permission </a>
                </div>

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
            <th>User Group Name</th>
          
            <th>&nbsp;</th>
           
       </tr>
     </thead>
     <tbody>
        @foreach($usergroup as $c)
       <tr>
           <td  data-title="Select">
               <input type="checkbox" class="check" name="cid[]" value="{{$c->id}}" id="cid{{$c->_id}}" />
           </td>

           <td  data-title="User Group Name">
               <a href="/userGroupPermissions/{{$c->user_group_id}}/edit/" title="Edit">
                 {{$c->user_group_name}} 
               </a>
           </td>
                     
           <td>
              <a href="/userGroupPermissions/{{$c->user_group_id}}/edit/" title="Edit"><i class="fa fa-pencil-square fa-lg"></i>&nbsp;Edit</a>
                  
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
