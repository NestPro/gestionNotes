<br><div class="col-md-4">
<button class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#schoolModal" dusk="create-school-button">
    + @lang('Create School')
</button></div><br>

<!-- Modal -->
<div class="modal fade" id="schoolModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form class="form-horizontal" method="POST" action="{{ route('schools.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">@lang('Create School')</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('school_name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">@lang('School Name')</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="@lang('School Name')" required>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                        <label for="address" class="col-md-4 control-label">@lang('School address')</label>

                        <div class="col-md-6">
                            <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" placeholder="@lang('School address')" required>

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
                            <textarea id="about" class="form-control" rows="3" name="about" placeholder="@lang('About School')" required>{{ old('about') }}</textarea>

                            @if ($errors->has('about'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('about') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn-primary">@lang('Save')</button>
                </div>
            </div>
        </form>
    </div>
</div>
