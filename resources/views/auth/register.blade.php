

@extends('layouts.app')

@section('title', __('Register'))

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row">
        @if(\Auth::user()->role != 'master')
        <div class="col-md-2" id="side-navbar">
            @include('layouts.partials.leftside-menubar')
        </div>
        @else
        <div class="col-md-3" id="side-navbar">
            <ul class="nav flex-column">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('schools.index') }}"><span class="nav-link-text">@lang('Back to Manage School')</span></a>
                </li>
            </ul>
        </div>
        @endif
        <div class="col-md-8" id="main-container">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
                {{-- Display View admin links --}}
                @if (session('register_school_id'))
                    <a href="{{ url('school/admin-list/' . session('register_school_id')) }}" target="_blank" class="text-white pull-right">@lang('View Admins')</a>
                @endif
            </div>
            @endif
            <div class="panel panel-default">
                <div class="page-panel-title">@lang('Register') {{ucfirst(session('register_role'))}}</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" id="registerForm" action="{{ url('register/'.session('register_role')) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">* @lang('Full Name')</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                    required>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">* @lang('E-Mail Address')</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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
                                <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}">

                                @if ($errors->has('phone_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">* @lang('Password')</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">* @lang('Confirm Password')</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                    required>
                            </div>
                        </div>
                        @if(session('register_role', 'student') == 'student')
                        <div class="form-group{{ $errors->has('section') ? ' has-error' : '' }}">
                            <label for="section" class="col-md-4 control-label">* @lang('Class and Section')</label>

                            <div class="col-md-6">
                                <select id="section" class="form-control" name="section" required>
                                    @foreach (session('register_sections') as $section)
                                    <option value="{{$section->id}}">@lang('Section'): {{$section->section_number}} @lang('Class'):
                                        {{$section->class->class_number}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('section'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('section') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                            <label for="birthday" class="col-md-4 control-label">* @lang('Birthday')</label>

                            <div class="col-md-6">
                                <input id="birthday" type="text" class="form-control" name="birthday" value="{{ old('birthday') }}"
                                    required>

                                @if ($errors->has('birthday'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('birthday') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        @if(session('register_role', 'teacher') == 'teacher')
                        <div class="form-group{{ $errors->has('classe') ? ' has-error' : '' }}">
                            <label for="classe" class="col-md-4 control-label">* @lang('Classe')</label>

                            <div class="col-md-6">
                                <select id="department" class="form-control" name="classe_id" required>
                                    @if (count(session('classes')) > 0)
                                        @foreach (session('classes') as $d)
                                            <option value="{{$d->id}}">{{$d->name}}</option>
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

                        <div class="form-group{{ $errors->has('nationality') ? ' has-error' : '' }}">
                            <label for="nationality" class="col-md-4 control-label">* @lang('Nationality')</label>

                            <div class="col-md-6">
                                <input id="nationality" type="text" class="form-control" name="nationality" value="{{ old('nationality') }}"
                                    required>

                                @if ($errors->has('nationality'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nationality') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">@lang('Gender')</label>

                            <div class="col-md-6">
                                <select id="gender" class="form-control" name="gender">
                                    <option selected="selected">@lang('Male')</option>
                                    <option>@lang('Female')</option>
                                </select>

                                @if ($errors->has('gender'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @if(session('register_role', 'student') == 'student')
                        
                        <div class="form-group{{ $errors->has('annee') ? ' has-error' : '' }}">
                            <label for="session" class="col-md-4 control-label">* @lang('Annee')</label>

                            <div class="col-md-6">
                                <input id="session" type="text" class="form-control" name="annee" value="{{ old('annee') }}"
                                    required>

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
                                <input id="classe" type="text" class="form-control" name="classe" value="{{ old('classe') }}"
                                    placeholder="">

                                @if ($errors->has('classe'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('classe') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">* @lang('address')</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}"
                                    required>

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
                                <textarea id="about" class="form-control" name="about">{{ old('about') }}</textarea>

                                @if ($errors->has('about'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('about') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('father_name') ? ' has-error' : '' }}">
                            <label for="father_name" class="col-md-4 control-label">* @lang('Father\'s Name')</label>

                            <div class="col-md-6">
                                <input id="father_name" type="text" class="form-control" name="father_name" value="{{ old('father_name') }}"
                                    required>

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
                                <input id="father_phone_number" type="text" class="form-control" name="father_phone_number"
                                    value="{{ old('father_phone_number') }}">

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
                                <input id="mother_name" type="text" class="form-control" name="mother_name" value="{{ old('mother_name') }}"
                                    required>

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
                                <input id="mother_phone_number" type="text" class="form-control" name="mother_phone_number"
                                    value="{{ old('mother_phone_number') }}">

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
                                <button type="submit" id="registerBtn" class="btn btn-primary">
                                    @lang('Register')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
    $(function () {
        $('#birthday').datepicker({
            format: "yyyy-mm-dd",
        });
        $('#session').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
    });
    $('#registerBtn').click(function () {
        $("#registerForm").submit();
    });
</script>
@endsection


{{--
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection--}}

{{--@extends('layouts.app')

@section('content')
<div class="login-box">
    <div class="login-box-body">
      <h3 class="login-box-msg">Sign Up</h3>
      <form action="{{ route('register') }}" method="post">
        @csrf

        <div class="form-group has-feedback">
          <!--<input type="email" class="form-control sty1" placeholder="Name"> -->
          <input id="name" type="text" class="form-control sty1 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
          @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        </div>
        <div class="form-group has-feedback">
          <!--<input type="email" class="form-control sty1" placeholder="Email">-->
          <input id="email" type="email" class="form-control sty1 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        </div>
        <div class="form-group has-feedback">
          <!--<input type="password" class="form-control sty1" placeholder="Password">-->
          <input id="password" type="password" class="form-control sty1 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        </div>
        <div class="form-group has-feedback">
          <!--<input type="password" class="form-control sty1" placeholder="Conform Password">-->
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Conform Password">
        </div>
        <div>
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox">
                 I agree to all Terms </label>
               </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4 m-t-1">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign UP</button>
          </div>
          <!-- /.col --> 
        </div>
      </form>
      <div class="m-t-2">Already have an account? <a href="pages-login.html" class="text-center">Sign In</a></div>
    </div>
    <!-- /.login-box-body --> 
  </div>
  <!-- /.login-box --> 
@endsection--}}
