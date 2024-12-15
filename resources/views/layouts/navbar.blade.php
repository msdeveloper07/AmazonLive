@if(Auth::check())
@if(Auth::user()->user_group_id == '1')

<header>
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="page_header">
                <div class="row">
                <div class="logo col-md-4 col-sm-6">
                    <h4><a href="/">Product tester <span>ADMIN</span></a></h4>
                </div>
                <div class="col-md-8 col-sm-6 text-right">
                    <nav class="navbar navbar-default">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <p class="top_menu_text">Menu</p>
                          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                          <ul class="nav navbar-nav">
                             @if((isset($active_dashboard_navbar)? $active_dashboard_navbar : '') == 'dashboard_active') 
                            <li class="active"><a href="/dashboard">Dashboard <span class="sr-only"></span></a></li>
                            @else<li><a href="/dashboard">Dashboard <span class="sr-only"></span></a></li>@endif
                            
                            @if((isset($active_user_navbar)? $active_user_navbar : '') == 'user_active')
                            <li class="active"><a href="/users">Users</a></li>
                            @else<li><a href="/users">Users</a></li>@endif
                            
                            @if((isset($active_promo_navbar)? $active_promo_navbar : '') == 'promo_active')
                            <li class="active"><a href="/promos">Promos</a></li>
                            @else<li><a href="/promos">Promos</a></li>@endif
                            
                            @if (Auth::guest())
                             
                            @else
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                          @endif
                          </ul>
                        </div><!-- /.navbar-collapse -->
                    </nav>
                </div>
                <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    </div>
</header>

@else
<header>
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="page_header">
                <div class="row">
                <div class="logo col-md-4 col-sm-6">
                    <h4><a href="#">Product tester <span>APP</span></a></h4>
                </div>
                <div class="col-md-8 col-sm-6 text-right">
                    <nav class="navbar navbar-default">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                           <p class="top_menu_text">Menu</p>
                          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                          <ul class="nav navbar-nav">
                            @if((isset($active_profile_navbar)? $active_profile_navbar : '') == 'profile_active')
                            <li class="active"><a href="/userprofile/{{Auth::user()->user_slug}}">Profile <span class="sr-only">(current)</span></a></li>
                            @else
                            <li ><a href="/userprofile/{{Auth::user()->user_slug}}">Profile <span class="sr-only">(current)</span></a></li>
                            @endif
                            
                            @if((isset($active_product_navbar)? $active_product_navbar : '') == 'product_active')
                            <li class="active"><a href="/products">Products</a></li>
                            @else<li><a href="/products">Products</a></li>@endif
                            
                            @if((isset($active_support_navbar)? $active_support_navbar : '') == 'support_active')
                            <li class="active"><a href="/supports">Support</a></li>
                            @else<li ><a href="/supports">Support</a></li>@endif
                            
                            <li class="dropdown">
                             @if (Auth::guest())
                             
                             @else
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                          @endif

                            
                        </li>
                          </ul>
                        </div><!-- /.navbar-collapse -->
                    </nav>
                </div>
                <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    </div>
</header>
@endif


@else
<header>
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="page_header">
                <div class="row">
                <div class="logo col-md-4 col-sm-6">
                    <h4><a href="#">Product tester <span>APP</span></a></h4>
                </div>
                <div class="col-md-8 col-sm-6 text-right">
                    <nav class="navbar navbar-default">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                          <p class="top_menu_text">Menu</p>
                          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                          <ul class="nav navbar-nav">
                           
                            <li><a href="/supports">Support</a></li>
                          </ul>
                        </div><!-- /.navbar-collapse -->
                    </nav>
                </div>
                <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    </div>
</header>
@endif