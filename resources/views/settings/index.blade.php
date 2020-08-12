@extends('layouts.app')

@section('title', __('Settings'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.partials.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <div class="panel panel-default">
                    <div class="page-panel-title">@lang('Settings')</div>
                    <div class="panel-body table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('Name')</th>
                                    <th scope="col">@lang('Code')</th>
                                </tr>
                                <tr>
                                    <td>{{ $school->name }}</td>
                                    <td>{{ $school->code }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">@lang('Classes')</th>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#collapse" role="button" class="btn btn-danger btn-sm" data-toggle="collapse" aria-expanded="false" aria-controls="collapse">
                                            @lang('Classe')
                                        </a>
                                    </td>
                                </tr>
                                <tr class="collapse" id="collapse" aria-labelledby="heading" aria-expanded="false">
                                    <td colspan="12">
                                        @include('layouts.master.add-class-form')
                                        <div><small>@lang('Click Class')</small></div>
                                        <div class="row">
                                            @foreach($classes as $class)
                                                @if($class->school_id == $school->id)
                                                    <div class="col-sm-3">
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal{{$class->id}}" style="margin-top: 5%;">@lang('Manage') {{$class->class_number}} {{!empty($class->group)? '- '.$class->group:''}}</button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="myModal{{$class->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        <h4 class="modal-title" id="myModalLabel">@lang('All Sections of Class') {{$class->class_number}}</h4>
                                                                    </div>
                                                                    <div class="modal-body">
																		<div class="form-check">
																			<?php 
																				$checked = Session::has('ignoreSessions') ? (Session::get('ignoreSessions') == "true" ? "checked='checked'" : "") : "";
																			?>
																			<input class="form-check-input position-static" type="checkbox" name="ignoreSessionsCheck" id="ignoreSessionsId" <?php echo $checked ?>>
																			@lang("Ignore Sessions when listing students for promoting")
																		</div>
                                                                                                                                           </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">@lang('Close')</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                        </table>

                        <h4>@lang('Add Users')</h4>
                        <table class="table table-condensed" style="width:600px">
                            <thead>
                                <tr>
                                    <th scope="col">+@lang('Student')</th>
                                    <th scope="col">+@lang('Teacher')</th>
                            
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="{{url('register/student')}}">+ @lang('Add Student')</a>
                                        <br>
                                        
                                    </td>
                                    <td>
                                        <a class="btn btn-success btn-sm" href="{{url('register/teacher')}}">+ @lang('Add Teacher')</a>
                                        <br>
                                        
                                    </td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<script>
		$(document).ready(function(){
		  $("#ignoreSessionsId").change(function() {
			var ignoreSessions = $("#ignoreSessionsId").is(":checked");

			$.ajax({
					type:'POST',
					url:'/school/set-ignore-sessions',
					headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
					data: { "ignoreSessions" : ignoreSessions },
					success: function(data){
					  if(data.data.success){
						  console.log("Result = " + data.data.success);
					  }
					}
				});
			});
		});	
	</script>
@endsection
