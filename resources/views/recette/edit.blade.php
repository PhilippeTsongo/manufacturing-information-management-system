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
                          <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">{{ GoogleTranslate::trans('Liste de Recettes', $appLocale)}}</a>
                      </li>
                  </ul>
                  <div>
                      <div class="btn-wrapper">
                          <a href="{{ route('recette.index')}}" class="btn btn-primary text-white me-2"><i class="mdi mdi-plus-circle-outline"></i>{{ GoogleTranslate::trans('Liste de Recettes', $appLocale)}}</a>
                      </div>
                  </div>
                </div>

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
                                        <h4 class="card-title card-title-dash">{{ GoogleTranslate::trans('Enregistrez une nouvelle Recette', $appLocale)}}</h4>
                                        <h5 class="card-subtitle card-subtitle-dash">{{ GoogleTranslate::trans('Complétez ce formulaire pour Enregistrer une nouvelle Recette', $appLocale)}}</h5>
                                    </div>
                                    <div id="performance-line-legend"></div>
                                </div>
                                <div>
                                  @include('../../partials/message')
                                </div>
                                <form class="forms-sample" method="POST" action="{{ route('autre_recette.update', $autre_recette) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                       
                                        <div class="col-lg 6">    
                                          <div class="form-group">
                                            <label for="type">{{ GoogleTranslate::trans('Type de Recettes', $appLocale)}}</label>
                                            <select id="type" name="type" class="form-control" required>
                                                @if($autre_recette->type_recette)
                                                    <option value="{{$autre_recette->type_recette->id }}">{{$autre_recette->type_recette->name }}</option>
                                                @endif
                                                @foreach($type_recettes as $type_recette)
                                                    <option value="{{ $type_recette->id }}">{{ $type_recette->name }}</option>
                                                @endforeach  
                                            </select>
                                          </div>
                                        </div>

                                        <div class="col-lg 6">   
                                            <div class="form-group">
                                                <label for="exampleInputEmail2">{{ GoogleTranslate::trans('Montant', $appLocale)}}</label>
                                                <input type="text" name="montant" value="{{ old('montant') ?? $autre_recette->montant }}" required class="form-control" id="exampleInputEmail2" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg 6">   
                                            <div class="form-group">
                                                <label for="exampleInputEmail11">{{ GoogleTranslate::trans('Déscription', $appLocale)}}</label>
                                                <textarea name="description" {{ old('description') ?? $autre_recette->description }}" required class="form-control form-control-lg" id="exampleInputEmail11">{{ old('description') ?? $autre_recette->description }}
                                                </textarea>
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

