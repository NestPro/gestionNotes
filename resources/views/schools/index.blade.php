@extends('dashboard')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/bootstrap/css/bootstrap.min.css') }}">

@endsection

@section('content')
    <div class="container-fluid">
        <div class="col-md-12" id="main-container">
            <div class="panel panel-default">
                <div class="panel-body table-responsive">
                    @include('schools.form')
                    <h2>@lang('School List')</h2>
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">@lang('Name')</th>
                                <th scope="col">@lang('Code')</th>
                                <th scope="col">@lang('About')</th>
                                <th scope="col">@lang('Edit')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schools as $school)
                                <tr>
                                    <td>{{($loop->index + 1)}}</td>
                                    <td><small>{{$school->name}}</small></td>
                                    <td><small>{{$school->code}}</small></td>
                                    <td><small>{{$school->about}}</small></td>
                                    <td>
                                        <a class="btn btn-success btn-sm" role="button" href="{{ route('schools.edit', $school) }}" dusk="edit-school-link">
                                            <small>@lang('Edit School')</small>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $schools->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
