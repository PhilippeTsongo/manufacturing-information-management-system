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
                          <a class="nav-link" id="home-tab" data-bs-toggle="tab" href="#daily" role="tab" aria-selected="false">Nouvelle Production</a>
                      </li>
                  </ul>
                  <div>
                      <div class="btn-wrapper">
                          <a href="{{ route('production.index')}}" class="btn btn-primary text-white me-0"><i class="mdi mdi-plus-circle-outline"></i>Production</a>
                      </div>
                  </div>
                </div>

                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                     
                    <div class="row">
                        <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title card-title-dash">Enregistrez une Nouvelle Production</h4>
                                        <h5 class="card-subtitle card-subtitle-dash">Complétez ce formulaire pour Enregistrer une Nouvelle Production</h5>
                                    </div>
                                    <div id="performance-line-legend"></div>
                                </div>
                                <div>
                                  @include('../../partials/message')
                                </div>
                                <form class="forms-sample" method="POST" action="{{ route('production.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">   
                                          <div class="form-group">
                                            <label for="exampleInputUsername1">Selectionnez la Catégorie de la production</label>
                                            <select id="type" name="category" class="form-control" required>
                                              @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                              @endforeach  
                                            </select>
                                          </div>
                                        </div>

                                        {{-- <div class="col-lg 6">   
                                          <div class="form-group">
                                              <label for="exampleInputEmail3">Prix de Vente</label>
                                              <input type="number" name="sale_price" :value="old('quantity')" required class="form-control" id="exampleInputEmail3" placeholder="Prix de vente">
                                          </div>
                                        </div> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-lg 6">   
                                          <div class="form-group">
                                              <label for="exampleInputEmail2">Quantité de la production</label>
                                              <input type="number" name="quantity" :value="old('quantity')" required class="form-control" id="exampleInputEmail2" placeholder="Quantité">
                                          </div>
                                        </div>

                                        <div class="col-lg 6">   
                                          <div class="form-group">
                                            <label for="exampleInputUsername4">Unité</label>
                                            <select id="exampleInputUsername4" name="unit" class="form-control" required>
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
                                          <label for="exampleInputUsername7">Selectionnez l'emballage</label>
                                          <select id="exampleInputUsername7" name="emballage" class="form-control" required>
                                            @foreach($emballages as $emballage)
                                              <option value="{{ $emballage->id }}"> @if($emballage->type_emballage){{ $emballage->type_emballage->name }}@endif   {{ $emballage->name }} Qté disponible: {{ $emballage->quantity }} @if($emballage->unit){{ $emballage->unit->name }}@endif</option>
                                            @endforeach  
                                          </select>
                                        </div>
                                      </div>

                                      <div class="col-lg 6">   
                                        <div class="form-group">
                                            <label for="exampleInputEmail8">Quantité de l'emballage</label>
                                            <input type="number" name="emballage_quantity" value="{{ old('emballage_quantity') }}" required class="form-control" id="exampleInputEmail8" placeholder="Quantité de l'emballage">
                                        </div>
                                      </div>
                                    </div>

                                    

                                    
                                    <button type="submit" class="btn btn-primary me-2 text-light">Enregistrez</button>
                                    <button type="reset" class="btn btn-light">Cancel</button>
                                  </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        </div>
                      
                      
                        {{-- <div class="col-lg-4 d-flex flex-column">
                            <div class="row flex-grow">
                                <div class="col-md-6 col-lg-12 grid-margin">
                                    <div class="card bg-primary card-rounded">
                                        <div class="card-body pb-0">
                                            <h4 class="card-title card-title-dash text-white mb-4">Nombre de productions</h4>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p class="status-summary-ight-white mb-1">Total</p>
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
                        </div> --}}
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

