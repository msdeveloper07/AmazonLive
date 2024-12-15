@extends('layouts.master')

@section('content')

<div class="content-header">
@if(isset($title))
<h2>{{$title}}</h2>
@endif

</div>
<div class="content">
<div class="row">
    <form  role="form" action="/user/activity/{{$id}}" name='user_form' id='user_form' method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

  
                        

        <div class="col-md-10">
            <div class="box box-primary">
        
                <div class="box-header">
                    <h3 class="box-title">General</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    
                                  <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="InputTitle">From</label>
                                <input type="text" name="date_from" id="wp_from" class="form-control" value="{{isset($date_from)?$date_from:''}}"/>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="InputTitle">To</label>
                                <input type="text" name="date_to" id="wp_to" class="form-control" value="{{isset($date_to)?$date_to:''}}"/>
                            </div>
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group">
                                  <label for="InputTitle"> &nbsp; </label>
                                  <button style="margin-top: 25px;" class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div> 
            </div>
                    <hr>
                    <div class="row">
                            <h3>History</h3>
        <div class="col-md-12">
            @if(is_object($user_activity))
            <ul class="timeline">
                @foreach($user_activity as $n)


                <li>
                    <!-- timeline icon -->
                    <i class="fa fa-clock-o bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{\App\Libraries\ZnUtilities::format_date($n->submitted_on,'3')}}</span>
                        <h3 class="timeline-header">
                            @if(isset($n->user->name))
                            <!--<a href="#"> {{$n->user->name}}</a>-->
                               {{$n->history_title}}
                            @else
                            <a href="#">System</a>
                            @endif
                        </h3>
                        <div class="timeline-body">
                            {{$n->history_content}}
                        </div>

                        <div class='timeline-footer'>
                          
                        </div>
                    </div>
                </li>

                @endforeach
            </ul>
            @endif    
        </div>
                     
                     
                    
                    </div> 
                </div><!-- /.box-body -->

            
            </div>
        </div>
    </form>
</div>
</div>
@endsection