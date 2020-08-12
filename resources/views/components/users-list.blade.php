{{$users->links()}}
<div class="table-responsive">
<table class="table table-bordered table-data-div table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">@lang('Action')</th>
      <th scope="col">@lang('Code')</th>
      <th scope="col">@lang('Full Name')</th>
      <th scope="col">@lang('Annee')</th>
      <th scope="col">@lang('Father Name')</th>
      <th scope="col">@lang('Mother Name')</th>
      <th scope="col">@lang('Gender')</th>
      <th scope="col">@lang('Phone Number')</th>
      <th scope="col">@lang('Address')</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $key=>$user)
    <tr>
      <th scope="row">{{ ($current_page-1) * $per_page + $key + 1 }}</th>
      @if(Auth::user()->role == 'admin')
        <td>
          <a class="btn btn-xs btn-danger" href="{{url('edit/user/'.$user->id)}}">@lang('Edit')</a>
        </td>
      @endif
      <td><small>{{$user->student_code}}</small></td>
      <td>
          <a href="{{url('user/'.$user->student_code)}}">
            {{$user->name}}</a>
        </td>
      @if($user->role == 'student')
        <td>
          <small>
          @isset($user->studentInfo['annee'])
            {{$user->studentInfo['annee']}}
          @endisset
          </small>
        </td>
        </td>
        <td><small>
        @isset($user->studentInfo['father_name'])
          {{$user->studentInfo['father_name']}}
        @endisset</small></td>
        <td><small>
        @isset($user->studentInfo['mother_name'])
          {{$user->studentInfo['mother_name']}}
        @endisset</small></td>
      @elseif($user->role == 'teacher')
        <td>
          <small>{{$user->email}}</small>
        </td>
      @endif
      <td><small>{{ucfirst($user->gender)}}</small></td>
      <td><small>{{$user->phone_number}}</small></td>
      <td><small>{{$user->address}}</small></td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
{{$users->links()}}
