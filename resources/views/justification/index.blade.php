<!DOCTYPE html>
<html lang="en">
 

  <title>Kanabe Système</title>

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../vendors/feather/feather.css">
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../vendors/typicons/typicons.css">
    <link rel="stylesheet" href="../../vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../../vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../../js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../images/favicon.png" />
</head>
      

  @extends('layouts.app')
  
  @section('content')
    
  <div class="container-scroller">
    <!-- header   -->

    <div class="container-fluid page-body-wrapper">
      {{-- aside --}}
      @include('partials.aside')


      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">

                    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="home-tab active" data-bs-toggle="tab" href="#daily" role="tab"  aria-controls="daily" aria-selected="true">Liste de Pièces Justificatives</a>
                            </li>
                        </ul>
                        <div>
                            <div class="btn-wrapper">
                                <a href="{{ route('justification.create')}}" class="btn btn-primary text-white me-0"><i class="mdi mdi-plus-circle-outline"></i>Nouvelle Pièce Justificative</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="daily" role="tabpanel" aria-labelledby="daily"> 
                            
                            <div class="row">
                                <div class="col-lg-12 grid-margin stretch-card">
                                    <div class="card">
                                    <div class="card-body">
                                        <div class="d-sm-flex justify-content-between align-items-start">
                                            <div>
                                                <h4 class="card-title">Liste de Pièces Justificatives</h4>
                                            </div>
                                            <div id="performance-line-legend"></div>
                                        </div>

                                        <div>
                                            <div>
                                                @include('../partials/message')
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Libellé</th>
                                                        <th>Document</th>
                                                        <th>Date</th>
                                                        @if(Auth()->check())
                                                            @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Financier')
                                                                <th>Action</th>
                                                            @endif
                                                        @endif
                                                    </tr>
                                                </thead>
                                            <tbody>
                                                <?php $total = 0; ?>
                                                @foreach($justifications as $justification)
                                                <tr>
                                                    <td>{{ $justification->justification_number }}</td>
                                                    <td>{{ $justification->justification }}</td>
                                                    <td>
                                                        <a target="_blank" href="{{ asset($justification->image) }}">
                                                            @if($justification->image)
                                                                <img src="{{ asset($justification->image) }}" alt="{{  $justification->justification }}">
                                                            @else
                                                                {{ 'pas d\'image' }}
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td >{{ $justification->justification_date }}</td>
                                                    <td>
                                                        @if(Auth()->check())
                                                            @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Financier')
                                                            <div class="row">
                                                                {{--  edit  --}}
                                                                {{-- <div class="col-lg-6">
                                                                    <a href="{{ route('justification.edit', ['justification' => $justification->id]) }}" _method="GET" 
                                                                        onClick="return confirm('Voulez-vous vraiment modifier cette pièce justification?');" title="Modifier cette pièce justification"> 
                                                                        <i class="mdi mdi-pencil text-info"></i>
                                                                    </a>
                                                                </div>   --}}
                                                                <div class="col-lg-6">
                                                                    {{-- delete --}}
                                                                    <form action="{{ route('justification.destroy', ['justification' => $justification->id ]  ) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette pièce justification?');">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('DELETE') }}
                                                                        <button type="submit" style="border:none; background: none" title="Supprimez cette pièce justification" > <i class="mdi mdi-delete-forever text-danger"></i></button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                                <br>
                                                {{ $justifications->links('vendor.pagination.bootstrap-5') }}

                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
        
        @include('partials.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->

  <!-- plugins:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../../vendors/chart.js/Chart.min.js"></script>
  <script src="../../vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="../../vendors/progressbar.js/progressbar.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../../js/jquery.cookie.js" type="text/javascript"></script>
  <script src="../../js/dashboard.js"></script>
  <script src="../../js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->


</html>

