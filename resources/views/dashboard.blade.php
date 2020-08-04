@include('layouts.partials._dash_head')

<body class="layout skin-blue sidebar-mini">
    <div class="wrapper boxed-wrapper">
        @include('layouts.partials._dash_nav')
        @include('layouts.partials._dash_sidebar')
        
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    @include('layouts.partials._dash_script')
</body>