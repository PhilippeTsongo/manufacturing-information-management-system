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
                                        <h4 class="card-title card-title-dash">Attribuer une matière première à la production numéro {{ $production->number}}</h4>
                                        <h5 class="card-subtitle card-subtitle-dash">Complétez ce formulaire pour Attribuer une matière première à une production</h5>
                                        
                                    </div>
                                    <div id="performance-line-legend"></div>
                                </div>

                                <div>
                                  <div>
                                      @include('../../partials/message')
                                  </div>
                                </div>
                                
                                <form class="forms-sample" method="POST" action="{{ route('allocate_matiere.store') }}">
                                    @csrf
                                    <div class="row">
                                      <div class="col-lg 6">   
                                          <div class="form-group">
                                              <label for="exampleInputUsername1">Sélectionnez la matière</label>
                                              <select id="exampleInputUsername1" name="matiere" class="form-control" required>
                                                @foreach($matieres as $matiere)
                                                  <option value="{{ $matiere->id }}">{{ $matiere->name }} {{ ' Quantité disponible: ' .$matiere->quantity }}</option>
                                                @endforeach  
                                              </select>
                                          </div>
                                      </div> 

                                      <div class="col-lg 4">   
                                        <div class="form-group">
                                            <label for="exampleInputUsername2">Quantité</label>
                                            <input type="text" name="matiere_quantity"  :value="old('quantity')" required autofocus  class="form-control" id="exampleInputUsername2" placeholder="quantité">
                                            {{-- hidden input --}}
                                            <input type="hidden" name="production" value="{{ $production->id }}"  class="form-control" id="exampleInputUsername2">
                                            <input type="hidden" name="number" value="{{ $production->number }}"  class="form-control" id="exampleInputUsername2">
                                            @forelse($production->matieres as $product_matiere)
                                              @if($product_matiere->unit)
                                                <input type="hidden" name="unit" value="{{ $product_matiere->unit->name }}"  class="form-control" id="exampleInputUsername2">
                                              @endif
                                            @empty
                                            @endforelse
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

