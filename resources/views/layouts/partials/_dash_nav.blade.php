<header class="main-header"> 
    {{--<a href="{{ (\Auth::user()->role == 'master')? '/masters' : '/home' }}" class="logo blue-bg text-uppercase h1 text-white text-decoration-none">Gestion</a>--}}
    
    <a class="logo blue-bg text-uppercase h1 text-white text-decoration-none" href="{{ (\Auth::user()->role == 'master')? '/masters' : '/home' }}" style="color: #000;">
      {{ (Auth::check() && (Auth::user()->role == 'teacher' ||
      Auth::user()->role == 'admin'))?Auth::user()->school->name:config('app.name') }}
  </a>
    
    <nav class="navbar blue-bg navbar-static-top"> 
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu p-ph-res"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="{{ asset('dashboard_assets/img/img1.jpg') }}"  class="user-image" alt="User Image"> <span class="hidden-xs">{{ Auth::user()->name }}</span> </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <div class="pull-left user-img"><img src="{{ asset('dashboard_assets/img/img1.jpg') }}"  class="img-responsive" alt="User"></div>
                <p class="text-left"><span class="label label-danger">{{ ucfirst(\Auth::user()->role) }}</span>&nbsp;&nbsp;</p>
                <p class="text-left">{{ Auth::user()->name }}<small>{{ Auth::user()->email }}</small> </p>
                <div class="view-link text-left"><a href="#">View Profile</a> </div>
              </li><br><br>
              <li><a href="#"><i class="icon-profile-male"></i> My Profile</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#"><i class="icon-gears"></i> Account Setting</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a><form action="{{ route('logout') }}" method="POST">
                @csrf
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>