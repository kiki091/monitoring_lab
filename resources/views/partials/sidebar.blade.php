<div class="col-md-3 left_col menu_fixed">
	<div class="left_col scroll-view">
    	<div class="navbar nav_title">
          <!-- <center>
              <img style="margin-top: 15%" src="{{ asset('themes/images/logo.png') }}" class="img-responsive">
          </center> -->
    	</div>

    	<div class="clearfix"></div>
    	<br />

    	<!-- sidebar menu -->
    	<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      		<div class="menu_section">

            @foreach(DataHelper::userMenu() as $key_system=> $system_menu)
            @if($key_system == RouteUsersLocation::setUsersLocation())
            @foreach($system_menu as $system_key=> $user_system)
        		<h3>{{$system_key}}</h3>
        		<ul class="nav side-menu">

            
            @foreach($user_system as $key=> $user_menu)
                @foreach($user_menu as $key_icon=> $menu)
                <li>
                  <a>
                    <i class="fa {{ $key_icon }}"></i> 
                    {{ $key }} <span class="fa fa-chevron-down"></span>
                  </a>
                  <ul class="nav child_menu">
                      @foreach($menu as $key_menu=> $menu_navigation)
                          @if($menu_navigation['have_sub_menu'] == '0')
                          <li>
                            <a href="#{{ $menu_navigation['slug'] }}" onclick="{{ $menu_navigation['url'] }}">
                                {{ $menu_navigation['title'] }}     
                            </a>
                          </li>
                          @else
                          <li>
                              <a href="#{{ $menu_navigation['slug'] }}">
                                {{ $menu_navigation['title'] }}
                                <span class="fa fa-chevron-down"></span>
                              </a>
                              <ul class="nav child_menu">
                                  @foreach($menu_navigation['sub_menu'] as $key=> $sub_menu)
                                  <li class="sub_menu">
                                      <a href="#{{ $sub_menu['slugh_sub_menu'] }}" onclick="{{ $sub_menu['url_sub_menu'] }}">
                                        {{ $sub_menu['title_sub_menu'] }}
                                      </a>
                                  </li>
                                  @endforeach
                              </ul>
                          </li>
                          @endif
                      @endforeach
                  </ul>
                </li>
                @endforeach
            @endforeach
            </ul>
            @endforeach
            @endif
            @endforeach

      		</div>

    	</div>
    	<!-- /sidebar menu -->
  	</div>
</div>