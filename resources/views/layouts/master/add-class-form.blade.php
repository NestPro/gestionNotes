<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#addClassModal{{$school->id}}">+@lang('Add New Class')</button>

<!-- Modal -->
<div class="modal fade" id="addClassModal{{$school->id}}" tabindex="-1" role="dialog" aria-labelledby="addClassModal{{$school->id}}Label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">@lang('Add New Class')</h4>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" action="{{url('school/add-class')}}" method="post">
          @csrf
          <div class="form-group">
            <label for="classNumber{{$school->id}}" class="col-sm-4 control-label">@lang('Class Number')</label>
            <div class="col-sm-8">
              <input type="text" name="code" class="form-control" id="classNumber{{$school->id}}" placeholder="@lang('Class Number')" required>
            </div>
          </div>
          <div class="form-group">
            <label for="classRoomNumber{{$school->id}}" class="col-sm-4 control-label">@lang('Class Name')</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="name" id="classRoomNumber{{$school->id}}" placeholder="@lang('CI, CP, CE1, CE2, CM1, CM2')">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-danger btn-sm">@lang('Submit')</button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">@lang('Close')</button>
      </div>
    </div>
  </div>
</div>
