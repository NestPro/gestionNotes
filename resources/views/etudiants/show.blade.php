@extends('dashboard')

@section('stylesheets')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('dashboard_assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="content pt-4">
        <div class="row mb-4">
            <div class="col-lg-4 mr-auto ml-auto">
                <div>
                  <!-- Widget: user widget style 1 -->
                  <div class="box box-widget widget-user-2"> 
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username">{{ $etudiant->nom }}</h3>
                        <h3 class="widget-user-username">{{ $etudiant->prenom }}</h3>
                    </div>
                    <div class="box-footer no-padding">
                      <ul class="nav nav-stacked">
                        <li class="pl-4 text-capitalize mt-4 mb-4">Ecole :<span class="pull-right pr-4">{{ $etudiant->ecole }}</span></li>
                        <li class="pl-4 text-capitalize mb-4">Classe :<span class="pull-right pr-4">{{ $etudiant->ecole }}</span></li>
                      </ul>
                    </div>
                  </div>
                </div>
            </div>
        </div>
@endsection

@section('javascripts')
<script src="{{ asset('dashboard_assets/plugins/datatables/jquery.dataTables.min.js') }}"></script> 
<script src="{{ asset('dashboard_assets/plugins/datatables/dataTables.bootstrap.min.js') }}"></script> 
<script>
    $(function () {
    $('#dataTable').DataTable()
  })
</script>
@endsection