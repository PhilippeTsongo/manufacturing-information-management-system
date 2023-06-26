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

  {{-- IMPORTANT VARIABLE --}}
  <?php
    //shortlisting app()->getLocal
    $appLocale = app()->getLocale();  
  ?>
    
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
                                <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Liste de Matériels (Mobilers)</a>
                            </li>
                        </ul>
                        <div>
                            <div class="btn-wrapper">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-otline-dark"><i class="icon-printer"></i>{{ GoogleTranslate::trans('Imprimer', $appLocale)}}</button>
                                    <button type="button" class="btn btn-otline-dark dropdown-toggle" id="dropdownMenuSplitButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuSplitButton1">
                                        <a target="blank" href="{{ route('rapport.logistique') }}" method="GET" class="dropdown-item">{{ GoogleTranslate::trans('Liste de Matériels (Mobilers)', $appLocale)}}</a>
                                    </div>
                                </div>
                                <a href="{{ route('logistique.create')}}" class="btn btn-primary text-white me-0"><i class="mdi mdi-plus-circle-outline"></i>{{ GoogleTranslate::trans('Nouveau Matériel', $appLocale)}}</a>
                            </div>
                        </div>
                    </div>
                
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                     
                    <div class="row">
                      
                        <div class="col-lg-9 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title">{{ GoogleTranslate::trans('Liste de Matériels (Mobilers)', $appLocale)}}</h4>
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
                                                <th>{{ GoogleTranslate::trans('Nom', $appLocale)}}</th>
                                                <th>{{ GoogleTranslate::trans('Quantité', $appLocale)}}</th>
                                                <th>{{ GoogleTranslate::trans('Prix d\'acaht', $appLocale)}}</th>
                                                <th>{{ GoogleTranslate::trans('Prix Total', $appLocale)}}</th>
                                                <th>{{ GoogleTranslate::trans('Bureau', $appLocale)}}</th>
                                                @if(Auth()->check())
                                                    @if(Auth::user()->userType->name == 'Administrateur')
                                                        <th>{{ GoogleTranslate::trans('Action', $appLocale)}}</th>
                                                    @endif
                                                @endif
                                            </tr>
                                        </thead>
                                    <tbody>
                                        @foreach($logistiques as $logistique)
                                        <tr>
                                            <td>{{ $logistique->logistique_number}}</td>
                                            <td>{{$logistique->name}}</td>
                                            <td>
                                                {{ $logistique->quantity }}
                                                @if($logistique->unit)
                                                    {{ $logistique->unit->name }}
                                                @endif
                                            </td>
                                            <td class="text-danger">{{ $logistique->purchase_price . '$'}}</td>
                                            <td class="text-warning" >{{ number_format($logistique->quantity * $logistique->purchase_price, 02) . '$' }}</td>
                                            <td>
                                                @if($logistique->office)
                                                    {{ $logistique->office->name }}
                                                @endif
                                            </td>
                                    
                                            <td>
                                                @if(Auth()->check())
                                                    @if(Auth::user()->userType->name == 'Administrateur')
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            {{--  edit  --}}
                                                            <a href="{{ route('logistique.edit', ['logistique' => $logistique->id]) }}" _method="GET" 
                                                                onClick="return confirm(' {{ GoogleTranslate::trans('Voulez-vous vraiment modifier cette logistique?', $appLocale)}}');" title="{{ GoogleTranslate::trans('Modifier cette logistique', $appLocale)}}"> 
                                                                <i class="mdi mdi-pencil text-info"></i>
                                                            </a>
                                                        </div>  
                                                        <div class="col-lg-6">
                                                            {{-- delete --}}
                                                            <form action="{{ route('logistique.destroy', ['logistique' => $logistique->id ]  ) }}" method="POST" onsubmit="return confirm(' {{ GoogleTranslate::trans('Voulez-vous vraiment supprimer cette logistique?', $appLocale)}}');">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <button type="submit" style="border:none; background: none" title="{{ GoogleTranslate::trans('Supprimez cette logistique', $appLocale)}}" > <i class="mdi mdi-delete-forever text-danger"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endif

                                            <td></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                      
                        <div class="col-lg-3 d-flex flex-column">
                            <div class="row flex-grow">
                                <div class="col-md-6 col-lg-12 grid-margin">
                                    <div class="card bg-primary card-rounded">
                                        <div class="card-body pb-0">
                                            <h4 class="card-title card-title-dash text-white mb-4">{{ GoogleTranslate::trans('Nombre de Logistiques', $appLocale)}}</h4>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p class="status-summary-ight-white mb-1">{{ GoogleTranslate::trans('Total', $appLocale)}}</p>
                                                    <h2 class="text-info">{{ $logistiques->count()}}</h2>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="status-summary-chart-wrapper pb-4">
                                                        <canvas id="status-summary"></canvas>
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

