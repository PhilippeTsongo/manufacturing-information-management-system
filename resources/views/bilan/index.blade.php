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
                                    <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Elément du Bilan</a>
                                </li>
                            </ul>
                            <div>
                                <div class="btn-wrapper">
                                    {{-- <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
                                    <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a> --}}
                                    <a href="{{ route('bilan_config.index')}}" class="btn btn-primary text-white me-0"><i class="mdi mdi-plus-circle-outline"></i>Elément du Bilan</a>
                                </div>
                            </div>
                        </div>
                    
                        <div class="tab-content tab-content-basic">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                                <div class="row">
                                    <div class="col-lg-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-sm-flex justify-content-between align-items-start">
                                                
                                                    <div>
                                                        <h4 class="card-title">{{ GoogleTranslate::trans('Bilan de l\'exercice Comptable', $appLocale)}} [ {{ $year }} ]</h4>
                                                    </div>
                                                    <div id="performance-line-legend"></div>

                                                </div>

                                                <div>
                                                    <div>
                                                        @include('../partials/message')
                                                    </div>
                                                </div>
                                                <br>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        {{-- <div class="table-responsive"> --}}
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <th colspan="2" style="text-align:center">{{ GoogleTranslate::trans('Actif', $appLocale)}}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>{{ GoogleTranslate::trans('Intitulé de Comptes', $appLocale)}}</th>
                                                                    <th>{{ GoogleTranslate::trans('Montant', $appLocale)}}</th>
                                                                </tr>
                                                                <?php $total_imm = 0; ?>
                                                                @foreach($immobilises as $immobilise)
                                                                <tr>
                                                                    <td>
                                                                        @if($immobilise->plan_comptable)
                                                                            {{ $immobilise->plan_comptable->account_name }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        {{ $immobilise->amount .'$' }}
                                                                    </td>
                                                                </tr>
                                                                <?php $total_imm = $total_imm + $immobilise->amount; ?>
                                                                @endforeach

                                                                <?php $total_cir = 0; ?>
                                                                @foreach($circulants as $circulant)
                                                                <tr>
                                                                    <td>
                                                                        @if($circulant->plan_comptable)
                                                                            {{ $circulant->plan_comptable->account_name }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        {{ $circulant->amount .'$' }}
                                                                    </td>
                                                                </tr>
                                                                <?php $total_cir = $total_cir + $circulant->amount; ?>
                                                                @endforeach
                                                                <tr>
                                                                    <td>{{ GoogleTranslate::trans('Total', $appLocale)}}</td>
                                                                    <td>
                                                                        <div class="badge badge-opacity-warning"><b> 
                                                                            {{ number_format($total_imm + $total_cir, 02).'$' }} 
                                                                        </b>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        {{-- </div> --}}
                                                    </div>
                                                    <div class="col-md-6 d-flex flex-column">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <th colspan="2" style="text-align:center">{{ GoogleTranslate::trans('Passif', $appLocale)}}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>{{ GoogleTranslate::trans('Intitulé de Comptes', $appLocale)}}</th>
                                                                    <th>{{ GoogleTranslate::trans('Montant', $appLocale)}}</th>
                                                                </tr>
                                                                <?php $total_cap = 0; ?>
                                                                @foreach($capitaux as $capital)
                                                                <tr>
                                                                    <td>
                                                                        @if($capital->plan_comptable)
                                                                            {{ $capital->plan_comptable->account_name }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        {{ $capital->amount .'$' }}
                                                                    </td>
                                                                </tr>
                                                                <?php $total_cap = $total_cap + $capital->amount; ?>
                                                                @endforeach

                                                                <?php $total_det = 0; ?>
                                                                @foreach($dettes as $dette)
                                                                <tr>
                                                                    <td>
                                                                        @if($dette->plan_comptable)
                                                                            {{ $dette->plan_comptable->account_name }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        {{ $dette->amount .'$' }}
                                                                    </td>
                                                                </tr>
                                                                <?php $total_det = $total_det + $capital->amount; ?>
                                                                @endforeach
                                                                <tr>
                                                                    <td>{{ GoogleTranslate::trans('Total', $appLocale)}}</td>
                                                                    <td>
                                                                        <div class="badge badge-opacity-warning"><b> 
                                                                            {{ number_format($total_cap + $total_det, 02).'$' }} 
                                                                        </b>
                                                                    </td>
                                                                </tr>
                                                                
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

