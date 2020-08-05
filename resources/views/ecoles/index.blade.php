@extends('dashboard')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/csss/font-awesome/css/font-awesome.min.css') }}">
    <!--DataTables -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')

    <!-- Main content -->
   
      <div class="content">
      
        <div class="info-box">
            <h4 class="text-black mb-4">Lites des écoles</h4>
            <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach ($ecoles as $ecole)
                        <tr>
                            <td>{{ $ecole->id }}</td>
                            <td>{{ $ecole->nom }}</td>
                            <td>{{ $ecole->addresse }}</td>
                            <td class="d-flex">
                              <a href="{{ route('see.classes') }} " class="p-2 bg-info  text-black"><i class="fa fa-eye"></i></a>
                              <a href="{{ route('edit.school', ['id'=>$ecole->id]) }}" class="p-2 bg-warning  text-black"><i class="fa fa-pencil"></i></a>
                              <a href="{{ route('delete.school', ['id'=>$ecole->id]) }}" class="p-2 bg-danger  text-white"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                      @endforeach
                
                      </tbody>
                  </table>
                </div>
            </div>
    </div>
     <!-- </div>-->

@endsection

@section('javascripts')

<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready( function () {
    $('#myTable').DataTable({
      processing: true,
      serverSide: true,

      ajax: '{!! route('see.schools') !!}',

      columns: [
            { data: 'Nom', name: 'nom' },
            { data: 'Addresse', name: 'addresse' },
            { data: 'Action', name: 'action' },
            { data: '', name: '' },
            { data: '', name: '' }
            { data: '', name: '' },
            { data: '', name: '' },
            { data: '', name: '' }
        ]
    });
} );
</script>
@endsection