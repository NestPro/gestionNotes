{{--@extends('layouts.admin')

@include('layouts.partials._dash_head')

<body class="layout skin-blue sidebar-mini">
    <div class="wrapper boxed-wrapper">
        @include('layouts.partials._dash_nav')
        @include('layouts.partials.leftside-menubar')
        
        <div class="content-wrapper">
            <h1 class="text-uppercase" style="padding-top: 50px; text-align:center">Welcome to your admin panel</h1>
            @yield('content')
        </div>
    </div>
    @include('layouts.partials._dash_script')
</body>--}}
{{--
@extends('layouts.app')

@section('content')
<style>
    .badge-download {
        background-color: transparent !important;
        color: #464443 !important;
    }
    .list-group-item-text{
      font-size: 12px;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.partials.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default" style="border-top: 0px;">
                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="page-panel-title">@lang('Dashboard')</div>
                        <div class="col-sm-2">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-header">@lang('Students') - <b>{{$totalStudents}}</b></div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-header">@lang('Teachers') - <b>{{$totalTeachers}}</b></div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card text-white bg-danger mb-3">
                                <div class="card-header">@lang('Classes') - <b>{{$totalClasses}}</b></div>
                            </div>
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="panel panel-default" style="background-color: rgba(242,245,245,0.8);">
                                <div class="panel-body">
                                    <h3>@lang('Welcome to') {{Auth::user()->school->name}}</h3>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('dashboard')

@section('content')
 
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1>Dashboard</h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('home') }} ">Home</a></li>
        <li><i class="fa fa-angle-right"></i> Dashboard</li>
      </ol>
    </div>
    
    <!-- Main content -->
    <div class="content">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="info-box bg-darkblue"> <span class="info-box-icon bg-transparent"><i class="ti-stats-up text-white"></i></span>
            <div class="info-box-content">
              <h6 class="info-box-text text-white">All Students</h6>
              <h1 class="text-white">{{ $totalStudents }}</h1>
              <span class="progress-description text-white"></span> </div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
        <!-- /.col -->
        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="info-box bg-green text-white"> <span class="info-box-icon bg-transparent"><i class="ti-face-smile"></i></span>
            <div class="info-box-content">
              <h6 class="info-box-text text-white">All Teachers</h6>
              <h1 class="text-white">{{$totalTeachers}}</h1>
              <span class="progress-description text-white"></span> </div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
        <!-- /.col -->
        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="info-box bg-orange"> <span class="info-box-icon bg-transparent"><i class="ti-bar-chart"></i></span>
            <div class="info-box-content">
              <h6 class="info-box-text text-white">All Classes</h6>
              <h1 class="text-white">{{ $totalClasses }}</h1>
              <span class="progress-description text-white"></span> </div>
            <!-- /.info-box-content --> 
          </div>
          <!-- /.info-box --> 
        </div>
        <!-- /.col -->
        
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default" style="background-color: rgba(242,245,245,0.8);">
                    <div class="panel-body">
                        <h3>@lang('Welcome to') {{Auth::user()->school->name}}</h3>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@endsection