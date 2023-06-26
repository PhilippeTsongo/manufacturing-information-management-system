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
                            <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">{{ GoogleTranslate::trans('emballage', $appLocale)}}/a>
                        </li>
                        </ul>
                        <div>
                            <div class="btn-wrapper">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-otline-dark"><i class="icon-printer"></i>{{ GoogleTranslate::trans('Imprimer', $appLocale)}}</button>
                                    <button type="button" class="btn btn-otline-dark dropdown-toggle" id="dropdownMenuSplitButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuSplitButton1">
                                        @foreach($mois as $month)
                                            <a target="blank" href="{{ route('rapport.emballage', ['month' => $month->name ]) }}" method="GET" class="dropdown-item">{{ $month->name }}</a>
                                        @endforeach                             
                                    </div>
                                </div>
                                <a href="{{ route('emballage.create')}}" class="btn btn-primary text-white me-0"><i class="mdi mdi-plus-circle-outline"></i>{{ GoogleTranslate::trans('Nouvel emballage', $appLocale)}}</a>
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
                                        <h4 class="card-title">{{ GoogleTranslate::trans('Liste d\'emballage', $appLocale)}}</h4>
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
                                                <th>{{ GoogleTranslate::trans('Type d\'emballage', $appLocale)}}</th>
                                                <th>{{ GoogleTranslate::trans('Quantité', $appLocale)}}</th>
                                                <th>{{ GoogleTranslate::trans('Casse', $appLocale)}}</th>
                                                <th>{{ GoogleTranslate::trans('Prix d\'achat', $appLocale)}}</th>
                                                <th>{{ GoogleTranslate::trans('Date', $appLocale)}} </th>
                                                @if(Auth()->check())
                                                    @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Producteur' OR Auth::user()->userType->name == 'Financier' OR Auth::user()->userType->name == 'Comptable')
                                                        <th>{{ GoogleTranslate::trans('Action', $appLocale)}}</th>
                                                    @endif
                                                @endif
                                            </tr>
                                        </thead>
                                    <tbody>
                                        @foreach($emballages as $emballage)
                                        <tr>
                                            <td>{{ $emballage->emballage_number }}</td>
                                            <td>{{ $emballage->name }}</td>
                                            <td>
                                                @if($emballage->type_emballage)
                                                    {{ $emballage->type_emballage->name}}</td>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $emballage->quantity }} 
                                                @if($emballage->unit)
                                                    {{ $emballage->unit->name }}
                                                @endif
                                            </td>
                                            <td class="text-danger">
                                                @forelse($emballage->emballageCasse as $emballage_casse)
                                                    {{ $emballage_casse->quantity }}
                                                @empty
                                                    {{'0'}}
                                                @endforelse
                                                @if($emballage->unit)
                                                    {{ $emballage->unit->name }}
                                                @endif
                                            </td>
                                            <td class="text-warning">{{ number_format($emballage->purchase_price, 02) .'$'}} </td>
                                            <td>{{ $emballage->date_emballage }}</td>
                                            <td>
                                                @if(Auth()->check())
                                                    @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Producteur' OR Auth::user()->userType->name == 'Financier' OR Auth::user()->userType->name == 'Comptable')
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            {{--  edit  --}}
                                                            <a href="{{ route('emballage.edit', ['emballage' => $emballage->id]) }}" _method="GET" 
                                                                onClick="return confirm('{{ GoogleTranslate::trans('Voulez-vous vraiment modifier cet emballage?', $appLocale)}}');" title="{{ GoogleTranslate::trans('Modifier cet emballage', $appLocale)}}"> 
                                                                <i class="mdi mdi-pencil text-info"></i>
                                                            </a>
                                                        </div>  
                                                        <div class="col-lg-6">
                                                            {{-- delete --}}
                                                            <form action="{{ route('emballage.destroy', ['emballage' => $emballage->id ]  ) }}" method="POST" onsubmit="return confirm('{{ GoogleTranslate::trans('Voulez-vous vraiment supprimer cet emballage?', $appLocale)}}');">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <button type="submit" style="border:none; background: none" title="{{ GoogleTranslate::trans('Supprimez cet emballage', $appLocale)}}" > <i class="mdi mdi-delete-forever text-danger"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endif

                                            </td>
                                        </tr>
                                        @endforeach
                                        <br>

                                        {{ $emballages->links('vendor.pagination.bootstrap-5')}}
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

