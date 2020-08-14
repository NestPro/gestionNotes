@extends('dashboard')

@section('title', __('Students'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
            @if(count($users) > 0)
              @foreach ($users as $user)
                {{--<ol class="breadcrumb" style="margin-top: 3%;">
                    <li><a href="{{url('school/sections?att=1')}}" style="color:#3b80ef;">@lang('Classes &amp; Sections')</a></li>
                    <li class="active">{{ucfirst($user->role)}}s</li>
                </ol>--}}
                <div class="page-panel-title">@lang('List of all') {{ucfirst($user->role)}}s</div>
                 @break($loop->first)
              @endforeach
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif                        
                    @component('components.users-list',['users'=>$users,'current_page'=>$current_page,'per_page'=>$per_page])
                    @endcomponent
                </div>
            @else
                <div class="panel-body">
                    @lang('No Data Found.')
                </div>
            @endif
            </div>
        </>
    </div>
</div>
@endsection
