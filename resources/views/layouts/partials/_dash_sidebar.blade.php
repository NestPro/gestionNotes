 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar"> 
    <!-- sidebar: style can be found in sidebar.less -->
    <div class="sidebar"> 
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="image text-center"><img src="{{ asset('dashboard_assets/img/img1.jpg') }}"  class="img-circle" alt="User Image"> </div>
        <div class="info">
          <p>Alexander Pierce</p>
          <!--<a href="index.html#"><i class="fa fa-cog"></i></a> <a href="index.html#"><i class="fa fa-envelope-o"></i></a> <a href="index.html#"><i class="fa fa-power-off"></i></a> </div>-->
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header text-uppercase">Admin</li>
        <li><a href="{{ route('see_students')}}"> <i class="fa fa-users"></i> <span>Liste élèves</span></span> </a></li>
        <li><a href=""> <i class="fa fa-building"></i> <span>Listes des Immeubles</span></span> </a></li>
        <li><a href=""> <i class="fa fa-bed"></i> <span>Listes des Logements</span></span> </a></li>
                
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
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
      </ul>
    </div>
    <!-- /.sidebar --> 
  </aside>