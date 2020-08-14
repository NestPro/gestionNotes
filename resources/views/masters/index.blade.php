@include('layouts.partials._dash_head')
<body>
    @include('layouts.partials._dash_nav')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default"><br><br>
                <div class="panel-body">
                    <a class="btn btn-secondary btn-lg btn-block" href="{{ route('schools.index') }}" role="button">
                        @lang('Gérer vos schools')
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.partials._dash_script')

</body>
</html>