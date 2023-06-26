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
            @include('../../partials.aside')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="home-tab">
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link" id="home-tab" data-bs-toggle="tab" href="#daily" role="tab" aria-selected="false">Aujourd'hui [{{ $today }}]</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#month" role="tab" aria-selected="false">Mensuelles [{{ $month }}]</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active ps-0" id="contact-tab" data-bs-toggle="tab" href="#year" role="tab" aria-controls="year" aria-selected="true">Annuelles [{{ $year }}]</a>
                                        </li>
                                    </ul>
                                    <div>
                                        <div class="btn-wrapper">
                                            {{-- <a href="{{ route('sortie.create')}}" class="btn btn-primary text-white me-0"><i class="mdi mdi-plus-circle-outline"></i> Nouvelle Charge</a> --}}
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="tab-content tab-content-basic">
                                    {{-- Daily --}}
                                    <div class="tab-pane fade show" id="daily" role="tabpanel" aria-labelledby="daily"> 
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="card card-rounded">
                                                    <div class="card-body">
                                                        <div class="d-sm-flex justify-content-between align-items-start">
                                                            <div>
                                                                <h4 class="card-title card-title-dash">{{ GoogleTranslate::trans('Balance Financière Journalièrs', $appLocale)}} [{{ $today }}]</h4>
                                                                <p class="card-subtitle card-subtitle-dash">{{ GoogleTranslate::trans('Cette partie illustre la différence entre toutes les recettes et les charges Journalièrs', $appLocale)}} </p>
                                                            </div>
                                                        </div>
                                                        <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                                                            <div class="d-sm-flex align-items-center mt-4 justify-content-between">
                                                                <h2 class="me-2 fw-bold">
                                                                    <span class="text-info"> 
                                                                        <?php $total_daily_recette = 0; ?>
                                                                        <?php $total_autre_daily_recette = 0; ?>

                                                                        @foreach($daily_recettes as $daily_recette)
                                                                            <?php $total_daily_recette = $total_daily_recette + ($daily_recette->quantity * $daily_recette->price); ?>
                                                                        @endforeach

                                                                        @foreach($daily_autre_recettes as $daily_autre_recette)
                                                                            <?php $total_autre_daily_recette = $total_autre_daily_recette + $daily_autre_recette->montant ; ?>
                                                                        @endforeach
                                                                        <?php $daily_recette = $total_daily_recette + $total_autre_daily_recette; ?>
                                                                        {{'Recettes: '. number_format($daily_recette, 02) }}$ 
                                                                    </span> |

                                                                        {{-- Total charges --}}
                                                                        <?php $total_daily_charge = 0; ?>
                                                                        @foreach($daily_charges as $daily_charge)
                                                                            <?php $total_daily_charge = $total_daily_charge + $daily_charge->montant; ?>
                                                                        @endforeach
                                                                        
                                                                       {{-- total de charges  --}}
                                                                   <span class="text-danger"> 
                                                                       {{'Charges: '. number_format($daily_charges = $total_daily_charge, 02) }}$
                                                                   </span>

                                                                   {{-- balance ou différence entre les recettes et les charges --}}
                                                                   <span class="text-success">
                                                                       =  {{ 'Différence: '. number_format($daily_recette - $daily_charges, 02) }}$  
                                                                   </span>

                                                                </h2>

                                                            </div>
                                                            <div class="me-3"><div id="marketing-overview-legend"></div></div>
                                                        </div>                               
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                            
                                            <div class="col-md-6 grid-margin stretch-card">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">{{ GoogleTranslate::trans('Recettes', $appLocale)}}</h4>
                                                        <div class="media">
                                                            <i class="ti-world icon-md text-info d-flex align-self-end me-3"></i>
                                                            <div class="media-body">
                                                                <div class="media-body text-info">
                                                                    <p class="card-text">{{ number_format($daily_recette, 02) .'$'}} </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 grid-margin stretch-card">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">{{ GoogleTranslate::trans('Charges', $appLocale)}}</h4>
                                                        <div class="media">
                                                            <i class="ti-world icon-md text-info d-flex align-self-start me-3"></i>
                                                            <div class="badge badge-opacity-warning">
                                                                <p class="card-text text-danger">{{ number_format($daily_charges, 02) .'$' }} </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Month --}}
                                    <div class="tab-pane fade show" id="month" role="tabpanel" aria-labelledby="month"> 
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="card card-rounded">
                                                    <div class="card-body">
                                                        <div class="d-sm-flex justify-content-between align-items-start">
                                                            <div>
                                                                <h4 class="card-title card-title-dash">{{ GoogleTranslate::trans('Balance Financière Mensuelles', $appLocale)}} [{{ $month }}]</h4>
                                                                <p class="card-subtitle card-subtitle-dash">{{ GoogleTranslate::trans('Cette partie illustre la différence entre toutes les recettes et les charges Mensuelles', $appLocale)}} </p>
                                                            </div>
                                                        </div>
                                                        <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                                                            <div class="d-sm-flex align-items-center mt-4 justify-content-between">
                                                                <h2 class="me-2 fw-bold">
                                                                    <span class="text-info"> 
                                                                        <?php $total_month_recette = 0; ?>
                                                                        <?php $total_autre_month_recette = 0; ?>

                                                                        @foreach($month_recettes as $month_recette)
                                                                            <?php $total_month_recette = $total_month_recette + ($month_recette->quantity * $month_recette->price); ?>
                                                                        @endforeach

                                                                        @foreach($month_autre_recettes as $month_autre_recette)
                                                                            <?php $total_autre_month_recette = $total_autre_month_recette + $month_autre_recette->montant ; ?>
                                                                        @endforeach
                                                                        <?php $month_recette = $total_month_recette + $total_autre_month_recette; ?>
                                                                        {{'Recettes: '. number_format($month_recette, 02) }}$ 
                                                                    </span> |

                                                                        {{-- Total charges --}}
                                                                        <?php $total_month_charge = 0; ?>
                                                                        @foreach($month_charges as $month_charge)
                                                                            <?php $total_month_charge = $total_month_charge + $month_charge->montant; ?>
                                                                        @endforeach


                                                                        {{-- total de charges et de cout de productions --}}
                                                                    <span class="text-danger"> 
                                                                        {{'Charges: '. number_format($month_charges = $total_month_charge, 02) }}$
                                                                    </span>

                                                                    {{-- balance ou différence entre les recettes et les charges  --}}
                                                                    <span class="text-success">
                                                                        =  {{ 'Différence: '. number_format($month_recette - $month_charges, 02) }}$  
                                                                    </span>

                                                                </h2>

                                                            </div>
                                                            <div class="me-3"><div id="marketing-overview-legend"></div></div>
                                                        </div>                               
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                            
                                            <div class="col-md-6 grid-margin stretch-card">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">{{ GoogleTranslate::trans('Recettes', $appLocale)}}</h4>
                                                        <div class="media">
                                                            <i class="ti-world icon-md text-info d-flex align-self-end me-3"></i>
                                                            <div class="media-body">
                                                                <div class="media-body text-info">
                                                                    <p class="card-text">{{ number_format($month_recette, 02) .'$'}} </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 grid-margin stretch-card">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">{{ GoogleTranslate::trans('Charges', $appLocale)}}</h4>
                                                        <div class="media">
                                                            <i class="ti-world icon-md text-info d-flex align-self-start me-3"></i>
                                                            <div class="badge badge-opacity-warning">
                                                               
                                                                <p class="card-text text-danger">
                                                                    {{ number_format($month_charges, 02 ) }}$
                                                                </p>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Year --}}
                                    <div class="tab-pane fade show active" id="year" role="tabpanel" aria-labelledby="year"> 
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="card card-rounded">
                                                    <div class="card-body">
                                                        <div class="d-sm-flex justify-content-between align-items-start">
                                                            <div>
                                                                <h4 class="card-title card-title-dash">{{ GoogleTranslate::trans('Balance Financière Annuelles', $appLocale)}} [{{ $year }}]</h4>
                                                                <p class="card-subtitle card-subtitle-dash">{{ GoogleTranslate::trans('Cette partie illustre la différence entre toutes les recettes et les charges Annuelles', $appLocale)}} </p>
                                                            </div>
                                                        </div>
                                                        <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                                                            <div class="d-sm-flex align-items-center mt-4 justify-content-between">
                                                                <h2 class="me-2 fw-bold">
                                                                    <span class="text-info"> 
                                                                        <?php $total_year_recette = 0; ?>
                                                                        <?php $total_autre_year_recette = 0; ?>

                                                                        @foreach($year_recettes as $year_recette)
                                                                            <?php $total_year_recette = $total_year_recette + ($year_recette->quantity * $year_recette->price); ?>
                                                                        @endforeach

                                                                        @foreach($year_autre_recettes as $year_autre_recette)
                                                                            <?php $total_autre_year_recette = $total_autre_year_recette + $year_autre_recette->montant ; ?>
                                                                        @endforeach
                                                                        <?php $year_recette = $total_year_recette + $total_autre_year_recette; ?>
                                                                        {{'Recettes: '. number_format($year_recette, 02) }}$ 
                                                                    </span> |

                                                                        {{-- Total charges --}}
                                                                        <?php $total_year_charge = 0; ?>
                                                                        @foreach($year_charges as $year_charge)
                                                                            <?php $total_year_charge = $total_year_charge + $year_charge->montant; ?>
                                                                        @endforeach

                                                                        {{-- total de charges --}}
                                                                    <span class="text-danger"> 
                                                                        {{'Charges: '. number_format($year_charges = $total_year_charge, 02) }}$
                                                                    </span>

                                                                    {{-- balance ou différence entre les recettes et les charges --}}
                                                                    <span class="text-success">
                                                                        =  {{ 'Différence: '. number_format($year_recette - $year_charges, 02) }}$  
                                                                    </span>
                                                                </h2>

                                                            </div>
                                                            <div class="me-3"><div id="marketing-overview-legend"></div></div>
                                                        </div>                               
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                            
                                            <div class="col-md-6 grid-margin stretch-card">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">{{ GoogleTranslate::trans('Recettes', $appLocale)}}</h4>
                                                        <div class="media">
                                                            <i class="ti-world icon-md text-info d-flex align-self-end me-3"></i>
                                                            <div class="media-body">
                                                                <div class="media-body text-info">
                                                                    <p class="card-text">{{ number_format($year_recette, 02) .'$'}} </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 grid-margin stretch-card">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">{{ GoogleTranslate::trans('Charges', $appLocale)}}</h4>
                                                        <div class="media">
                                                            <i class="ti-world icon-md text-info d-flex align-self-start me-3"></i>
                                                            <div class="badge badge-opacity-warning">
                                                               
                                                                <p class="card-text text-danger">
                                                                    {{ number_format($year_charges, 02 ) .'$' }}
                                                                </p>
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
        
        
        @include('../../partials.footer')
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

