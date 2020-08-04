@extends('layouts.admin')

@include('layouts.partials._dash_head')

<body class="layout skin-blue sidebar-mini">
    <div class="wrapper boxed-wrapper">
        @include('layouts.partials._dash_nav')
        @include('layouts.partials._dash_sidebar')
        
        <div class="content-wrapper">
            <h1 class="text-uppercase" style="padding-top: 50px; text-align:center">Welcome to your admin panel</h1>
            @yield('content')
        </div>
    </div>
    @include('layouts.partials._dash_script')
</body>

