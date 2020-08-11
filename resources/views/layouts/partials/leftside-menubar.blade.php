 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar"> 
    <!-- sidebar: style can be found in sidebar.less -->
    <div class="sidebar"> 
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="nav-item active">
          <a class="nav-link" href="{{ url('home') }}"><span class="nav-link-text">@lang('Dashboard')</span></a>
        </li>
        @if(Auth::user()->role == 'master')
        <li class="nav-item">
          <a class="nav-link" href="{{ url('schools') }}"><span class="nav-link-text">@lang('Schools')</span></a>
        </li>
        @endif
        @if(Auth::user()->role == 'admin')
        <li class="nav-item">
          <a class="nav-link" href="{{ url('school/sections?course=1') }}"><i class="material-icons">class</i> <span class="nav-link-text">@lang('Classes')</span></a>
        </li>
        @endif
        @if(Auth::user()->role == 'admin')
        <li class="nav-item">
          <a class="nav-link" href="{{url('users/'.Auth::user()->school->code.'/1/0')}}"><i class="material-icons">contacts</i>
            <span class="nav-link-text">@lang('Students')</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('users/'.Auth::user()->school->code.'/0/1')}}"><i class="material-icons">contacts</i>
            <span class="nav-link-text">@lang('Teachers')</span></a>
        </li>
        @endif
        @if(Auth::user()->role == 'admin')        
        <li class="nav-item" style="border-bottom: 1px solid #dbd8d8;"></li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('settings.index') }}"><i class="material-icons">settings</i> <span class="nav-link-text">@lang('Academic Settings')</span></a>
        </li>
        @endif

 

        
        
        
        
        
        
        
        
        {{--<li class="header text-uppercase">Admin</li>
        <li><a href="{{ route('schools.index') }}"> <i class="fa fa-users"></i> <span>Liste de vos écoles</span></span> </a></li>
        
        <!--<li class="treeview"> <a href="index.html#"> <i class="fa fa-envelope-o "></i> <span>Inbox</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="apps-mailbox.html">Mailbox</a></li>
            <li><a href="apps-mailbox-detail.html">Mailbox Detail</a></li>
            <li><a href="apps-compose-mail.html">Compose Mail</a></li>
          </ul>
        </li>-->
        <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="nav-icon fa fa-circle-o text-danger"></i>
                                        {{ __('Se déconnecter') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>--}}
      </ul>
    </div>
    <!-- /.sidebar --> 
  </aside>