@extends('dashboard')

@section('stylesheets')
    <!-- dropify -->
<link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/dropify/dropify.min.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="row">
      <div class="col-lg-8 mr-auto ml-auto">
        <div class="card card-outline ">
          <div class="card-header bg-blue ">
          <h5 class="text-white m-b-0">Modifier</h5>
          </div>
          <div class="card-body row">
            <form class="col-lg-8 mr-auto ml-auto" action="{{ route('edit.school.post', ['id' => $ecole->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                <label >Nom</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"  placeholder="Nom" value="{{ $ecole->nom }}">
                    @error('name')
                            <span class="small text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label >Addresse</label>
                    <input type="text" min="1" class="form-control @error('address') is-invalid @enderror" name="address"  placeholder="Addresse" value="{{ $ecole->addresse }}">

                    @error('address')
                            <span class="small text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success btn-block">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('javascripts')
<!-- dropify --> 
<script src="{{ asset('dashboard_assets/plugins/dropify/dropify.min.js') }}"></script> 
<script>
            $(document).ready(function(){
                // Basic
                $('.dropify').dropify();

                // Translated
                $('.dropify-fr').dropify({
                    messages: {
                        default: 'Glissez-déposez un fichier ici ou cliquez',
                        replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                        remove:  'Supprimer',
                        error:   'Désolé, le fichier trop volumineux'
                    }
                });

                // Used events
                var drEvent = $('#input-file-events').dropify();

                drEvent.on('dropify.beforeClear', function(event, element){
                    return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
                });

                drEvent.on('dropify.afterClear', function(event, element){
                    alert('File deleted');
                });

                drEvent.on('dropify.errors', function(event, element){
                    console.log('Has Errors');
                });

                var drDestroy = $('#input-file-to-destroy').dropify();
                drDestroy = drDestroy.data('dropify')
                $('#toggleDropify').on('click', function(e){
                    e.preventDefault();
                    if (drDestroy.isDropified()) {
                        drDestroy.destroy();
                    } else {
                        drDestroy.init();
                    }
                })
            });
        </script>
@endsection