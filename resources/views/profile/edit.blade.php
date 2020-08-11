{{--@extends('dashboard')--}}
@extends('layouts.app')
@section('title', __('Edit'))

@section('content')
<div class="container{{ (\Auth::user()->role == 'master')? '' : '-fluid' }}">
    <div class="row">
        @if(\Auth::user()->role != 'master')
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        @endif
        <div class="col-md-{{ (\Auth::user()->role == 'master')? 12 : 8 }}" id="main-container">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <div class="panel panel-default">
                <div class="page-panel-title">@lang('Edit')</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('edit/user') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <input type="hidden" name="user_role" value="{{$user->role}}">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">* @lang('Full Name')</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}"
                                    required>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">@lang('E-Mail Address')</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ $user->email }}">

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <label for="phone_number" class="col-md-4 control-label">* @lang('Phone Number')</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control" name="phone_number"
                                    value="{{ $user->phone_number }}">

                                @if ($errors->has('phone_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        @if($user->role == 'teacher')
                        <div class="form-group{{ $errors->has('classe') ? ' has-error' : '' }}">
                            <label for="department" class="col-md-4 control-label">@lang('Classe')</label>

                            <div class="col-md-6">
                                <select id="department" class="form-control" name="classe_id">
                                    @if (count($classes)) > 0)
                                    @foreach ($classes as $d)
                                    <option value="{{$d->id}}" @if ($d->id == old('classe_id', $user->classe_id))
											selected="selected"
										@endif
										>{{$d->name}}</option>
                                    @endforeach
                                    @endif
                                </select>

                                @if ($errors->has('classe'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('classe') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">@lang('address')</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address"
                                    value="{{ $user->address }}">

                                @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                            <label for="about" class="col-md-4 control-label">@lang('About')</label>

                            <div class="col-md-6">
                                <textarea id="about" class="form-control" name="about">{{ $user->about }}</textarea>

                                @if ($errors->has('about'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('about') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        @if($user->role == 'student')

                        <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                            <label for="birthday" class="col-md-4 control-label">* @lang('Birthday')</label>

                            <div class="col-md-6">
                                <input id="birthday" type="text" class="form-control" name="birthday" required>

                                @if ($errors->has('birthday'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('birthday') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('annee') ? ' has-error' : '' }}">
                            <label for="session" class="col-md-4 control-label">* @lang('annee')</label>

                            <div class="col-md-6">
                                <input id="annee" type="text" class="form-control" name="annee" required>

                                @if ($errors->has('annee'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('annee') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('classe') ? ' has-error' : '' }}">
                            <label for="classe" class="col-md-4 control-label">@lang('Classe')</label>

                            <div class="col-md-6">
                                <input id="group" type="text" class="form-control" name="classe"
                                    value="@php if(isset($user->studentInfo['classe'])){echo $user->studentInfo['classe'];} @endphp"
                                    placeholder="">

                                @if ($errors->has('classe'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('classe') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group" {{ $errors->has('father_name') ? ' has-error' : '' }}">
                            <label for="father_name" class="col-md-4 control-label">* @lang('Father\'s Name')</label>

                            <div class="col-md-6">
                                <input id="father_name" type="text" class="form-control" name="father_name"
                                    value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['father_name'];} @endphp" required>

                                @if ($errors->has('father_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('father_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('father_phone_number') ? ' has-error' : '' }}">
                            <label for="father_phone_number" class="col-md-4 control-label">@lang('Father\'s Phone Number')</label>

                            <div class="col-md-6">
                                <input id="father_phone_number" type="text" class="form-control"
                                    name="father_phone_number" value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['father_phone_number'];} @endphp">

                                @if ($errors->has('father_phone_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('father_phone_number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group{{ $errors->has('mother_name') ? ' has-error' : '' }}">
                            <label for="mother_name" class="col-md-4 control-label">* @lang('Mother\'s Name')</label>

                            <div class="col-md-6">
                                <input id="mother_name" type="text" class="form-control" name="mother_name"
                                    value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['mother_name'];} @endphp" required>

                                @if ($errors->has('mother_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mother_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mother_phone_number') ? ' has-error' : '' }}">
                            <label for="mother_phone_number" class="col-md-4 control-label">@lang('Mother\'s Phone Number')</label>

                            <div class="col-md-6">
                                <input id="mother_phone_number" type="text" class="form-control"
                                    name="mother_phone_number" value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['mother_phone_number'];} @endphp">

                                @if ($errors->has('mother_phone_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mother_phone_number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="javascript:history.back()" class="btn btn-danger" style="margin-right: 2%;"
                                    role="button">@lang('Cancel')</a>
                                <input type="submit" role="button" class="btn btn-success" value="@lang('Save')">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"
    rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
    $(function () {
        $('#birthday').datepicker({
            format: "yyyy-mm-dd",
        });
        $('#birthday').datepicker('setDate',
            "@php if(isset($user->studentInfo['birthday'])){echo Carbon\Carbon::parse($user->studentInfo['birthday'])->format('Y-d-m');} @endphp
");
        $('#session').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
        $('#session').datepicker('setDate',
            "@php if(isset($user->studentInfo['session'])){echo Carbon\Carbon::parse($user->studentInfo['session'])->format('Y');} @endphp
");
    });
</script>
@endsection