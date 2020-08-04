@extends('dashboard')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/csss/font-awesome/css/font-awesome.min.css') }}">
    <!--DataTables -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
    <!-- jsgrid Tables -->
<!--<link type="text/css" rel="stylesheet" href="dashboard_assets/plugins/jsgrid/jsgrid.css" />
<link type="text/css" rel="stylesheet" href="dashboard_assets/plugins/jsgrid/theme.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>-->
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')

    <!-- Main content -->
   
      <div class="content">
      
        <div class="info-box">
            <h4 class="text-black mb-4">Lites des élèves</h4>
            <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Classe</th>
                        <th>Action</th>

                      </tr>
                      </thead>
                      <tbody>
                        @foreach ($etudiants as $etudiant)
                        <tr>
                            <td>{{ $etudiant->first_name }}</td>
                            <td>{{ $etudiant->last_name }}</td>
                            <td>{{ $etudiant->classe }}</td>
                        </tr>
                      @endforeach
                
                      </tbody>
                  </table>
                </div>
            </div>
    </div>
     <!-- </div>-->
      
<!--
    </div>
     /.content 
  </div>--> 
  <!-- /.content-wrapper -->
@endsection

@section('javascripts')
<!-- jsgrid Tables 
<script src="{{ asset('dashboard_assets/plugins/jsgrid/db.js') }}"></script>
<script src="{{ asset('dashboard_assets/plugins/jsgrid/jsgrid.min.js') }}"></script>
<script src="{{ asset('dashboard_assets/plugins/jsgrid/jsgrid.int.js') }}"></script>-->
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

      ajax: '{!! route('see_students') !!}',

      columns: [
            {  },
            {  },
            {  }
        ]
    });
} );
</script>
@endsection