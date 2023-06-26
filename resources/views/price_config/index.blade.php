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
                            <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">{{ GoogleTranslate::trans('Prix de réduction', $appLocale)}}</a>
                        </li>
                        </ul>
                        <div>
                            <div class="btn-wrapper">
                                <a href="{{ route('price_config.create')}}" class="btn btn-primary text-white me-0"><i class="mdi mdi-plus-circle-outline"></i>{{ GoogleTranslate::trans('Nouveau prix de réduction', $appLocale)}}</a>
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
                                        <h4 class="card-title">{{ GoogleTranslate::trans('Liste de prix de réduction', $appLocale)}}</h4>
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
                                                <th>{{ GoogleTranslate::trans('Type d\'emballage', $appLocale)}}</th>
                                                <th>{{ GoogleTranslate::trans('Quantité minimum', $appLocale)}}</th>
                                                <th>{{ GoogleTranslate::trans('Quantité maximum', $appLocale)}}</th>
                                                <th>{{ GoogleTranslate::trans('Prix de vente unitaire', $appLocale)}}</th>
                                                <th>{{ GoogleTranslate::trans('Date', $appLocale)}}</th>
                                                @if(Auth()->check())
                                                    @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Producteur')
                                                        <th>{{ GoogleTranslate::trans('Action', $appLocale)}}</th>
                                                    @endif
                                                @endif
                                            </tr>
                                        </thead>
                                    <tbody>
                                        @foreach($price_reductions as $price_reduction)
                                        <tr>
                                            <td>
                                                @if($price_reduction->type_emballage)
                                                    {{ $price_reduction->type_emballage->name }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $price_reduction->quantity_min . ' {{ GoogleTranslate::trans('bouteilles', $appLocale)}} ' }}  
                                            </td>
                                            <td>
                                                {{ $price_reduction->quantity_max .' {{ GoogleTranslate::trans('bouteilles', $appLocale)}} ' }} 
                                            </td>
                                            <td>
                                                <div class="badge badge-opacity-warning">{{ number_format($price_reduction->price, 02) .'$' }}</div>
                                            </td>
                                            <td>{{ $price_reduction->created_at->format('d-M-Y') }}</td>
                                            <td>
                                                @if(Auth()->check())
                                                    @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Producteur')
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            {{--  edit  --}}
                                                            <a href="{{ route('price_config.edit', ['price_config' => $price_reduction->id]) }}" _method="GET" 
                                                                onClick="return confirm(' {{ GoogleTranslate::trans('Voulez-vous vraiment modifier ce prix de réduction?', $appLocale)}} ');" title="{{ GoogleTranslate::trans('Modifier ce prix de réduction', $appLocale)}}"> 
                                                                <i class="mdi mdi-pencil text-info"></i>
                                                            </a>
                                                        </div>  
                                                        <div class="col-lg-6">
                                                            {{-- delete --}}
                                                            <form action="{{ route('price_config.destroy', ['price_config' => $price_reduction->id ]  ) }}" method="POST" onsubmit="return confirm(' {{ GoogleTranslate::trans('Voulez-vous vraiment supprimer ce prix de réduction?', $appLocale)}} ');">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <button type="submit" style="border:none; background: none" title="{{ GoogleTranslate::trans('Supprimez ce prix de réduction', $appLocale)}}" > <i class="mdi mdi-delete-forever text-danger"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endif

                                            </td>
                                        </tr>
                                        @endforeach
                                        <br>

                                        {{ $price_reductions->links('vendor.pagination.bootstrap-5')}}
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

