<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
        @if(!isset($title))
        <?php $title = 'Home'; ?>
        @endif
        <title>{{$title}}</title>
         <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
        

        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/font-awesome.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/summernote.css')}}" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>

        
        
        {{App\Libraries\ZnUtilities::load_css_files()}}
        
    </head>
    <body>
        <div id="wrapper">
            
         <div class="container">
          
            

           
            <div class="content-wrapper">
               
            @include('layouts.flashMessage')
                @yield('content')    

            </div>
            
<div class="footer_height"></div>  
<!-- <footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="footer">
                    Footer
                </div>
            </div>
        </div>
    </div>
</footer>-->
</div>
        </div><!-- ./wrapper -->
        
           
            <!-- jQuery 2.1.4 -->
        <script src="{{asset('assets/js/jQuery-2.1.4.min.js')}}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script> 
        <!--<script src="{{asset('assets/https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js')}}"></script>-->
        <script src="{{asset('assets/js/pekeUpload.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
       
        <script src="{{asset('assets/js/jasny-bootstrap.js')}}"></script>
        <script src="{{asset('assets/js/jasny-bootstrap.min.js')}}"></script>
      <script src="{{asset('assets/js/components/promos.js')}}"></script>
       <script src="{{asset('assets/js/components/image_upload.js')}}"></script>
       <script src="{{asset('assets/js/summernote.js')}}"></script>
    <script type="text/javascript" src="{{asset('/assets/js/components/emailTemplate.js')}}" ></script>
        
 
    </body>
</html>