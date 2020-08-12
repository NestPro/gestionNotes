<div class="row">
    <div class="col-md-10" id="main-container">
      <h3>{{$user->name}} <span class="label label-danger">{{ucfirst($user->role)}}</span> <span class="label label-primary">{{ucfirst($user->gender)}}</span>
        @if ($user->role == 'teacher' && $user->classe_id > 0)
          <small>@lang('Class Teacher'): <span class="label label-info">{{ucfirst($user->classe)}}</span></small>
        @endif
        
        @if($user->role == "student")
         <button class="btn btn-xs btn-success pull-right" role="button" id="btnPrint"><i class="material-icons">print</i> @lang('Print Profile')</button>
         <div class="visible-print-block" id="profile-content">
         <div class="row">
            <div class="col-md-12">
              <div class="col-xs-8">
                <h2>{{$user->classe->school->name}}</h2>
                <div style="font-size: 10px;">{{$user->classe->school->about}}</div>
              </div>
              <div class="col-xs-4">
                <h3>@lang('Student Profile')</h3>
                <div style="font-size: 10px;">@lang('Printing Date'): {{Carbon\Carbon::now()->format('d/m/Y')}}</div>
              </div>
            </div>
          </div>
          <br/>
          <div class="row">
            <div class="col-md-12">
              <p class="bg-primary" style="text-align:center;">
                @lang('Information')
              </p>
              <div class="col-xs-9">
                <table class="table">
                  <tr>
                    <td>@lang('Student ID'):</td>
                    <td>{{$user->student_code}}</td>
                    <td>@lang('Student\'s Name'):</td>
                    <td>{{$user->name}}</td>
                  </tr>
                  <tr>
                    <td>@lang('Annee'):</td>
                    <td>@isset($user->studentInfo['annee']){{$user->studentInfo['annee']}}@endisset</td>
                    
                  </tr>
                  <tr>
                    <td>@lang('Classe'):</td>
                    <td>@isset($user->studentInfo['classe']){{$user->studentInfo['classe']}}@endisset</td>
                    <td colspan="2"></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p class="bg-primary" style="text-align:center;">
                @lang('Personal informations')
              </p>
              <div class="col-xs-12">
                <table class="table">
                  <tr>
                    <td>@lang('Email'):</td>
                    <td>{{$user->email}}</td>
                    <td>@lang('Contact Number')</td>
                    <td>{{$user->phone_number}}</td>
                  </tr>
                  <tr>
                    <td>@lang('Gender'):</td>
                    <td>{{$user->gender}}</td>
                  </tr>
                  <tr>
                    <td>@lang('Nationality'):</td>
                    <td>{{$user->nationality}}</td>
                    <td>@lang('Birthday'):</td>
                    <td>{{Carbon\Carbon::parse($user->birthday)->format('d/m/Y')}}</td>
                  </tr>
                  <tr>
                    <td>@lang('Father Name'):</td>
                    <td>@isset($user->studentInfo['father_name']){{$user->studentInfo['father_name']}}@endisset</td>
                  </tr>
                  <tr>
                    <td>@lang('Mother Name'):</td>
                    <td>@isset($user->studentInfo['mother_name']){{$user->studentInfo['mother_name']}}@endisset</td>
                    <td>@lang('Address'):</td>
                    <td>{{$user->address}}</td>
                  </tr>
                  <tr>
                    <td>@lang('Phone Number'):</td>
                    <td>{{$user->phone_number}}</td>
                    <td>@lang('Father\'s Phone Number'):</td>
                    <td>@isset($user->studentInfo['father_phone_number']){{$user->studentInfo['father_phone_number']}}@endisset</td>
                  </tr>
                  <tr>
                    <td>@lang('Mother\'s Phone Number'):</td>
                    <td>@isset($user->studentInfo['mother_phone_number']){{$user->studentInfo['mother_phone_number']}}@endisset</td>
                  </tr>
                  <tr>
                    <td>@lang('About'):</td>
                    <td>{{$user->about}}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
         </div>
         <script>
          $("#btnPrint").on("click", function () {
              var tableContent = $('#profile-content').html();
              var printWindow = window.open('', '', 'height=720,width=1280');
              printWindow.document.write('<html><head>');
              printWindow.document.write('<link href="{{url('css/app.css')}}" rel="stylesheet">');
              printWindow.document.write('</head><body>');
              printWindow.document.write('<div class="container"><div class="col-md-12" id="academic-part">');
              printWindow.document.write(tableContent);
              printWindow.document.write('</div></div></body></html>');
              printWindow.document.close();
              printWindow.print();
            });
          </script>
        @endif
       </h3>
      <div class="table-responsive" style="margin-top: 3%;">
      <table class="table table-bordered table-striped">
        <tbody>
          <tr>
            @if($user->role == "student")
            <td><b>@lang('Code'):</b></td>
            <td>{{$user->student_code}}</td>
            <td><b>@lang('Annee'):</b></td>
            <td>@isset($user->studentInfo['annee']){{$user->studentInfo['annee']}}@endisset</td>
            @else
            <td><b>@lang('Code'):</b></td>
            <td>{{$user->student_code}}</td>
            <td><b>@lang('About'):</b></td>
            <td>{{$user->about}}</td>
            @endif
          </tr>
          @if($user->role == "student")
          <tr>
            <td><b>@lang('Classe'):</b></td>
            <td>@isset($user->studentInfo['classe']){{$user->studentInfo['classe']}}@endisset</td>
            <td><b>@lang('Birthday'):</b></td>
            <td>{{Carbon\Carbon::parse($user->birthday)->format('d/m/Y')}}</td>
          </tr>
          @endif
          <tr>
            <td><b>@lang('Nationality'):</b></td>
            <td>{{$user->nationality}}</td>
          </tr>
          @if($user->role == "student")
          <tr>
            <td><b>@lang('Father Name'):</b></td>
            <td>@isset($user->studentInfo['father_name']){{$user->studentInfo['father_name']}}@endisset</td>
            <td><b>@lang('Mother Name'):</b></td>
            <td>@isset($user->studentInfo['mother_name']){{$user->studentInfo['mother_name']}}@endisset</td>
          </tr>
          @endif
          <tr>
            <td><b>@lang('Address'):</b></td>
            <td>{{$user->address}}</td>
            <td><b>@lang('Phone Number'):</b></td>
            <td>{{$user->phone_number}}</td>
          </tr>
          @if($user->role == "student")
          <tr>
            <td><b>@lang('Father\'s Phone Number'):</b></td>
            <td>@isset($user->studentInfo['father_phone_number']){{$user->studentInfo['father_phone_number']}}@endisset</td>
          </tr>
          <tr>
            <td><b>@lang('Mother\'s Phone Number'):</b></td>
            <td>@isset($user->studentInfo['mother_phone_number']){{$user->studentInfo['mother_phone_number']}}@endisset</td>
          </tr>
          <tr>
            <td><b>@lang('About'):</b></td>
            <td colspan="3">{{$user->about}}</td>
          </tr>
          @endif
        </tbody>
      </table>
      </div>
    </div>
  </div>
  