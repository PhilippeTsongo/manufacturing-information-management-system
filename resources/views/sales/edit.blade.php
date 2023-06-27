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
                                        <h4 class="card-title card-title-dash">{{ GoogleTranslate::trans('Modifiez La vente Numéro', $appLocale)}} {{ $sale->sale_number }}</h4>
                                        <h5 class="card-subtitle card-subtitle-dash">{{ GoogleTranslate::trans('Complétez ce formulaire pour Modifier cette Vente', $appLocale)}}</h5>
                                    </div>
                                    <div id="performance-line-legend"></div>
                                </div>
                                <div>
                                  @include('../../partials/message')
                                </div>
                                <form class="forms-sample" method="POST" action="{{ route('sale.update', $sale) }}">
                                    @csrf
                                    @method('PUT')
                                    {{-- hidden values --}}
                                    <input type="hidden" name="production_id" value="{{ $sale->production_id }}">
                                    <input type="hidden" name="sale_number" value="{{ $sale->sale_number }}">
                                    
                                    <div class="row">
                                        
                                        <div class="col-lg 12">   
                                            <div class="form-group">
                                                <label for="exampleInputEmail2">{{ GoogleTranslate::trans('Quantité de la Vente', $appLocale)}}</label>
                                                <input type="number" name="quantity" value="{{ old('quantity') ?? $sale->quantity }}" required class="form-control" id="exampleInputEmail2" placeholder="{{ GoogleTranslate::trans('Quantité', $appLocale)}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg 4">   
                                            <div class="form-group">
                                                <label for="exampleInputEmail3">{{ GoogleTranslate::trans('Prix de Vente', $appLocale)}}</label>
                                                <input type="number" name="sale_price" value="{{ old('sale_price') ?? $sale->price }}" required class="form-control" id="exampleInputEmail3" placeholder="{{ GoogleTranslate::trans('Prix de vente', $appLocale)}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-lg 4">   
                                            <div class="form-group">
                                                <label for="exampleInputEmail4">{{ GoogleTranslate::trans('Prix Total', $appLocale)}}</label>
                                                <input type="number" name="sale_price" value="{{ old('sale_price') ?? $sale->price * $sale->quantity  }}" required class="form-control" id="exampleInputEmail4" placeholder="{{ GoogleTranslate::trans('Prix de Total', $appLocale)}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-lg 4">   
                                            <div class="form-group">
                                                <label for="exampleInputEmail6">{{ GoogleTranslate::trans('Catégorie de la Production', $appLocale)}}</label>
                                                <input type="text" name="category" value="{{ old('category') ?? $sale->production->category->name }}" required class="form-control" id="exampleInputEmail6" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary me-2 text-light">{{ GoogleTranslate::trans('Modifiez', $appLocale)}}</button>
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
                                            <h4 class="card-title card-title-dash text-white mb-4">{{ GoogleTranslate::trans('Numéro de la vente ', $appLocale)}} {{ $sale->sale_number }}</h4>
                                            
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

