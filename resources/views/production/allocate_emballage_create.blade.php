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
                          <a class="nav-link" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-selected="true">{{ GoogleTranslate::trans('Attribution d\'emballage', $appLocale)}}</a>
                      </li>
                  </ul>
                  <div>
                      <div class="btn-wrapper">
                          <a href="{{ route('production.index')}}" class="btn btn-primary text-white me-0"><i class="mdi mdi-plus-circle-outline"></i>{{ GoogleTranslate::trans('Liste de productions', $appLocale)}}</a>
                      </div>
                  </div>
                </div>

                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                     
                    @foreach($production_ as $production)
                    <div class="row">
                        <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title card-title-dash">{{ GoogleTranslate::trans('Attribuer un emballage à la production numéro', $appLocale)}} {{ $production->number}}</h4>
                                        <h5 class="card-subtitle card-subtitle-dash">{{ GoogleTranslate::trans('Complétez ce formulaire pour Attribuer un emballage à une production', $appLocale)}}</h5>
                                        
                                    </div>
                                    <div id="performance-line-legend"></div>
                                </div>

                                <div>
                                  <div>
                                      @include('../../partials/message')
                                  </div>
                                </div>
                                
                                <form class="forms-sample" method="POST" action="{{ route('allocate_emballage.store') }}">
                                    @csrf
                                    <div class="row">
                                      <div class="col-lg 6">   
                                          <div class="form-group">
                                              <label for="exampleInputUsername1">{{ GoogleTranslate::trans('Sélectionnez l\'emballage', $appLocale)}}</label>
                                              <select id="exampleInputUsername1" name="emballage" class="form-control" required>
                                                @foreach($emballages as $emballage)
                                                  <option value="{{ $emballage->id }}">{{ $emballage->name }} @if($emballage->type_emballage) {{ $emballage->type_emballage->name }} @endif {{ ' Quantité disponible: ' .$emballage->quantity }}</option>
                                                @endforeach  
                                              </select>
                                          </div>
                                      </div> 

                                      <div class="col-lg 4">   
                                        <div class="form-group">
                                            <label for="exampleInputUsername2">{{ GoogleTranslate::trans('Quantité', $appLocale)}}</label>
                                            <input type="number" name="emballage_quantity"  :value="old('quantity')" required autofocus  class="form-control" id="exampleInputUsername2" placeholder="{{ GoogleTranslate::trans('quantité', $appLocale)}}">
                                            {{-- hidden input --}}
                                            <input type="hidden" name="production" value="{{ $production->id }}"  class="form-control" >
                                            <input type="hidden" name="number" value="{{ $production->number }}"  class="form-control" >
                                            <input type="hidden" name="unit" value=" @if($production->unit) {{ $production->unit->name }} @endif "  class="form-control" >
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
                      
                    </div>
                    @endforeach
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

