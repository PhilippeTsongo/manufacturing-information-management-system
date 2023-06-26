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
                
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                     
                    <div class="row">
                        <div class="col-lg-8 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title card-title-dash">{{ GoogleTranslate::trans('Modifiez La Production Numéro', $appLocale)}} {{ $production->number }}</h4>
                                        <h5 class="card-subtitle card-subtitle-dash">{{ GoogleTranslate::trans('Complétez ce formulaire pour Modifier cette Production', $appLocale)}}</h5>
                                    </div>
                                    <div id="performance-line-legend"></div>
                                </div>
                                <div>
                                  @include('../../partials/message')
                                </div>
                                <form class="forms-sample" method="POST" action="{{ route('production.update', $production) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-lg 6">   
                                          <div class="form-group">
                                            <label for="exampleInputUsername1">{{ GoogleTranslate::trans('Selectionnez la Catégorie de la production', $appLocale)}}</label>
                                            <select id="type" name="category" class="form-control" required>
                                              <option value="{{ old('category') ?? $production->category->id }}">{{ $production->category->name }}</option>
                                              @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                              @endforeach  
                                            </select>
                                          </div>
                                        </div>

                                        <div class="col-lg 6">   
                                          <div class="form-group">
                                              <label for="exampleInputEmail3">{{ GoogleTranslate::trans('Prix de Vente', $appLocale)}}</label>
                                              <input type="number" name="sale_price" value="{{ old('sale_price') ?? $production->sale_price }}" required class="form-control" id="exampleInputEmail3" placeholder="{{ GoogleTranslate::trans('Prix de vente', $appLocale)}}">
                                          </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg 6">   
                                          <div class="form-group">
                                              <label for="exampleInputEmail2">{{ GoogleTranslate::trans('Quantité de la production', $appLocale)}}</label>
                                              <input type="number" name="quantity" value="{{ old('quantity') ?? $production->quantity }}" required class="form-control" id="exampleInputEmail2" placeholder="{{ GoogleTranslate::trans('Quantité', $appLocale)}}">
                                          </div>
                                        </div>

                                        <div class="col-lg 6">   
                                          <div class="form-group">
                                            <label for="exampleInputUsername4">{{ GoogleTranslate::trans('Unité', $appLocale)}}</label>
                                            <select id="exampleInputUsername4" name="unit" class="form-control" required>
                                              @if($production->unit)
                                              <option value="{{ $production->unit->id }}">{{ $production->unit->name }}</option>
                                              @endif
                                              @foreach($unities as $unity)
                                                <option value="{{ $unity->id }}">{{ $unity->name }}</option>
                                              @endforeach  
                                            </select>
                                          </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-lg 6">   
                                        <div class="form-group">
                                          <label for="exampleInputUsername5">{{ GoogleTranslate::trans('Selectionnez la Matière première utilisée', $appLocale)}}</label>
                                          <select id="exampleInputUsername5" name="matiere" class="form-control" required readOnly>
                                            @if($production->matiere)
                                            <option value="{{ old('matiere') ?? $production->matiere->id }}">{{ $production->matiere->name }}</option>
                                            @endif  
                                            @foreach($matieres as $matiere)
                                              <option value="{{ $matiere->id }}">{{ $matiere->name }}</option>
                                            @endforeach  
                                          </select>
                                        </div>
                                      </div>

                                      <div class="col-lg 6">   
                                        <div class="form-group">
                                            <label for="exampleInputEmail6">{{ GoogleTranslate::trans('Quantité de la matière', $appLocale)}}</label>
                                            <input type="number" name="matiere_quantity" value="{{ old('matiere_quantity') ?? $production->matiere_quantity }}" required readOnly class="form-control" id="exampleInputEmail6" placeholder="{{ GoogleTranslate::trans('Quantité de la matière', $appLocale)}}">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg 6">   
                                        <div class="form-group">
                                          <label for="exampleInputUsername7">{{ GoogleTranslate::trans('Selectionnez l\'emballage', $appLocale)}}</label>
                                          <select id="exampleInputUsername7" name="emballage" class="form-control" required readOnly>
                                            @if($production->emballage)
                                            <option value="{{ old('emballage') ?? $production->emballage->id }}">{{ $production->emballage->name }}</option>
                                            @endif
                                            @foreach($emballages as $emballage)
                                              <option value="{{ $emballage->id }}">{{ $emballage->name }}</option>
                                            @endforeach  
                                          </select>
                                        </div>
                                      </div>

                                      <div class="col-lg 6">   
                                        <div class="form-group">
                                            <label for="exampleInputEmail8">{{ GoogleTranslate::trans('Quantité de l\'emballage', $appLocale)}}</label>
                                            <input type="number" name="emballage_quantity" value="{{ old('emballage_quantity') ?? $production->emballage_quantity }}" required readOnly class="form-control" id="exampleInputEmail8" placeholder="{{ GoogleTranslate::trans('Quantité de l\'emballage', $appLocale)}}">
                                        </div>
                                      </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary me-2 text-light">{{ GoogleTranslate::trans('Enregistrez', $appLocale)}}</button>
                                    <button type="reset" class="btn btn-light">{{ GoogleTranslate::trans('Cancel', $appLocale)}}</button>
                                  </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        </div>
                      
                      
                        <div class="col-lg-4 d-flex flex-column">
                            <div class="row flex-grow">
                                <div class="col-md-6 col-lg-12 grid-margin">
                                    <div class="card bg-primary card-rounded">
                                        <div class="card-body pb-0">
                                            <h4 class="card-title card-title-dash text-white mb-4">{{ GoogleTranslate::trans('Nombre de productions', $appLocale)}}</h4>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p class="status-summary-ight-white mb-1">{{ GoogleTranslate::trans('Total', $appLocale)}}</p>
                                                    <a href="{{ route('production.index')}}">
                                                      <h2 class="text-info">{{ $productions->count() }}</h2>
                                                    </a>
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

