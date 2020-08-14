 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar"> 
    <!-- sidebar: style can be found in sidebar.less -->
    <div class="sidebar"> 
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="image text-center"><img src="{{ asset('dashboard_assets/img/img1.jpg') }}"  class="img-circle" alt="User Image"> </div>
        <div class="info">
          <p>{{ Auth::user()->name }}</p>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header text-uppercase">{{ Auth::user()->role }}</li>
        <li class="active treeview"> <a href="#"> <i class="fa fa-dashboard"></i> <span>Data</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            @if((\Auth::user()->role == 'master'))
            <li><a href="{{ url('/schools') }} ">All Schools</a></li>
            @endif
            @if(Auth::user()->role != 'master')
            <li class="nav-item">
              <a class="nav-link" href="{{url('users/'.Auth::user()->school->code.'/1/0')}}"><i class="material-icons"></i>
                <span class="nav-link-text">@lang('Students')</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('users/'.Auth::user()->school->code.'/0/1')}}"><i class="material-icons"></i>
                <span class="nav-link-text">@lang('Teachers')</span></a>
            </li>
            @endif
            @if(Auth::user()->role == 'admin')        
            <li class="nav-item">
              <a class="nav-link" href="{{ route('settings.index') }}"><span class="nav-link-text">@lang('Settings')</span></a>
            </li>
            @endif
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              @lang('Logout')
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
              </form>
          </li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.sidebar --> 
  </aside>