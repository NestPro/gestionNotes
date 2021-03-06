@extends('dashboard')

@if(count($user) > 0)
  @section('title', $user->name)
@endif

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
              @if(count($user) > 0)
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.user-profile',['user'=>$user])
                    @endcomponent
                </div>
              @else
                <div class="panel-body">
                    @lang('No Data Found.')
                </div>
              @endif
            </div>
            <br/>
        </div>
    </div>
</div>
@endsection
