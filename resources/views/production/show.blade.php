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

                            @foreach($production_comptables as $production_comptable)
                            <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">{{ GoogleTranslate::trans('Détail de la production', $appLocale)}} [{{$production_comptable->number}}]</a>
                                    </li>
                                </ul>
                                <div>
                                    <div class="btn-wrapper">
                                        {{-- <a href="{{ route('allocate_emballage', ['production' => $production_comptable->id ])}}" class="btn btn-primary text-white me-0"><i class="mdi mdi-plus-circle-outline"></i> Attribuer un emballage</a> --}}
                                        <a href="{{ route('allocate_matiere', ['production' => $production_comptable->id ])}}" class="btn btn-primary text-white me-0"><i class="mdi mdi-plus-circle-outline"></i>{{ GoogleTranslate::trans('Attribuer une matière', $appLocale)}}</a>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-content tab-content-basic">
                                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                                    <div class="row">
                                        <div class="col-lg-5 stretch-card mt-3">
                                            <div class="card card-rounded">
                                                <div class="card-body">
                                                    <div class="d-sm-flex justify-content-between align-items-start">
                                                        <div>
                                                            <h4 class="card-title card-title-dash">{{ GoogleTranslate::trans('Cout de production', $appLocale)}} [{{$production_comptable->number}}]</h4>
                                                            <p class="card-subtitle card-subtitle-dash">{{ GoogleTranslate::trans('Somme total de coûts de production', $appLocale)}}</p>
                                                        </div>
                                                       
                                                    </div>
                                                    <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                                                        <div class="d-sm-flex align-items-center justify-content-between">
                                                            {{-- <h4 class="text-success me-2 fw-bold">
                                                                {{ number_format($production_comptable->quantity * $production_comptable->sale_price, 02)  .'$ -' }}  
                                                            </h4> --}}
                                                            <h2 class="text-danger me-2 fw-bold">                                                                
                                                                <?php $cout_productions = DB::table('cout_productions')->where('production_number', $production_comptable->number)->get(); ?>
                                                                @if(!empty($cout_productions['0']))
                                                                    {{ number_format($cout_productions['0']->{'montant'}, 02) .'$' }}
                                                                @endif
                                                            </h2>

                                                            {{-- <h2 class="me-2 fw-bold">
                                                                
                                                                @if(!empty($cout_productions['0']))
                                                                    {{ number_format(($production_comptable->quantity * $production_comptable->sale_price) - ($cout_productions['0']->{'montant'}), 02).'$' }}
                                                                @endif
                                                            </h2> --}}
                                                        </div>
                                                        <div class="me-3"><div id="marketing-overview-legend"></div></div>
                                                    </div>                               
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 stretch-card mt-3">

                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title card-title-dash">{{ GoogleTranslate::trans('Catégorie', $appLocale)}}</h4>
                                                        <div class="media">
                                                        <i class="ti-world icon-md text-info d-flex align-self-end me-3"></i>
                                                        <div class="media-body">
                                                            @if($production_comptable->category)
    
                                                            <div class="badge badge-opacity-warning">{{ $production_comptable->category->name }} </div>
                                                        @else
                                                            <p class="card-text text-danger">{{'Pas de catégorie '}}</p>
                                                        @endif
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="col-lg-4 stretch-card mt-3 ">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title card-title-dash">{{ GoogleTranslate::trans('Emballages', $appLocale)}}</h4>
                                                    <div class="media">
                                                        <i class="ti-world icon-md text-info d-flex align-self-center me-3"></i>
                                                        <div class="media-body col-lg-12">
                                                            @if($production_comptable->emballage)
                                                                @if($production_comptable->emballage->type_emballage)
                                                                    {{ $production_comptable->emballage->type_emballage->name }} 
                                                                @else
                                                                    <p class="card-text text-danger">{{ GoogleTranslate::trans('Pas d\'emballage utilisés', $appLocale)}}</p>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row mt-3">
                                        <div class="col-md-12 grid-margin ">
                                       
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title card-title-dash">{{ GoogleTranslate::trans('Matières Premières', $appLocale)}}</h4>
                                                <div class="media">
                                                    <i class="ti-world icon-md text-info d-flex align-self-start me-3"></i>
                                                    <div class="media-body col-lg-12">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-lg-2">
                                                                        <b>Matieres</b>
                                                                    </div>
                                                                    <div class="col-lg-10">
                                                                        @forelse($production_ as $production)
                                                                            @if($production->matieres)
                                                                                @forelse($production->matieres as $product_matiere)
                                                                                    {{ $product_matiere->name }} |
                                                                                @empty
                                                                                    <p class="card-text text-danger">{{ GoogleTranslate::trans('Pas de matière attribuée', $appLocale)}}</p>
                                                                                @endforelse
                                                                            @endif
                                                                        @empty
                                                                            <p class="card-text text-danger">{{ GoogleTranslate::trans('Pas de matières utilisées', $appLocale )}}</p>
                                                                        @endforelse
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-2">
                                                                    <div class="col-lg-2">
                                                                        <b>{{ GoogleTranslate::trans('Quantité')}}</b>
                                                                    </div>
                                                                    <div class="col-lg-10">
                                                                        @if($production->production_matiere_quantities)
                                                                            @foreach($production->production_matiere_quantities as $product_matiere_quantity)
                                                                                {{ $product_matiere_quantity->matiere_quantity}} {{ $product_matiere_quantity->unit}}
                                                                            @endforeach  
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-lg-12 grid-margin stretch-card">
                                            <div class="card">
                                              <div class="card-body">
                                                <h4 class="card-title">{{ GoogleTranslate::trans('Informations de la production', $appLocale)}} {{ $production_comptable->number }}</h4>
                                                
                                                <div class="table-responsive">
                                                  <table class="table table-striped">
                                                    <thead>
                                                      <tr>
                                                        <th>
                                                          #
                                                        </th>
                                                        <th>{{ GoogleTranslate::trans('Quantité', $appLocale)}}</th>
                                                        <th>{{ GoogleTranslate::trans('Prix de vente', $appLocale)}}</th>
                                                        <th>{{ GoogleTranslate::trans('date de production', $appLocale)}}</th>
                                                        
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                      <tr>
                                                        
                                                        <td>{{ $production_comptable->number }}</td>
                                                        <td>
                                                            {{ $production_comptable->quantity }}
                                                            @if($production_comptable->unit)
                                                                {{ $production_comptable->unit->name}}
                                                            @endif
                                                        </td>
                                                        <td class="text-danger">
                                                            @if($production_comptable->emballage)
                                                                @if($production_comptable->emballage->type_emballage)
                                                                    @foreach($production_comptable->emballage->type_emballage->price_config as $config_price)
                                                                        <div class="text-danger mt-2">
                                                                            {{ GoogleTranslate::trans('Quantité', $appLocale )}}  {{ $config_price->quantity_min . 'Pc ' . $config_price->quantity_max.'Pc ' }}
                                                                            <div class="badge badge-opacity-warning">
                                                                                {{ GoogleTranslate::trans('Prix: ', $appLocale)}} {{ $config_price->price .'$'}}
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            @endif
                                                        </td>
                                                        
                                                        <td>{{ $production_comptable->created_at }}</td>
                                                      
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                        

                                    </div>
                                </div>
                            </div>
                            @endforeach
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

