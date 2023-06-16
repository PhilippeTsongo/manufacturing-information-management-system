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
                     
                    <div class="row">
                        <div class="col-lg-8 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title card-title-dash">Enregistrez Une Nouvelle Dette</h4>
                                        <h5 class="card-subtitle card-subtitle-dash">Complétez ce formulaire pour Enregistrer une nouvelle Dette</h5>
                                        
                                    </div>
                                    <div id="performance-line-legend"></div>
                                </div>

                                <div>
                                  <div>
                                      @include('../../partials/message')
                                  </div>
                                </div>
                                
                                <form class="forms-sample" method="POST" action="{{ route('dette.store') }}">
                                    @csrf
                                    <div class="row">
                                      <div class="col-lg 4">   
                                        <div class="form-group">
                                          <label for="exampleInputUsername4">Sélectionnez la production</label>
                                          <select id="exampleInputUsername4" name="production" class="form-control" required>
                                            @foreach($productions as $production)
                                              @if($production->emballages)
                                                    @foreach($production->emballages as $production_emb)
                                                      @if($production_emb->type_emballage)
                                                        <option value="{{ $production->id }}">
                                                          {{$production_emb->type_emballage->name . ' Qté disponible: '. $production->quantity}}
                                                        </option>
                                                      @endif
                                                    @endforeach                                             
                                              @endif
                                            @endforeach  
                                          </select>
                                        </div>
                                      </div>   
                                   
                                      <div class="col-lg 4">   
                                        <div class="form-group">
                                            <label for="exampleInputUsername2">Quantité</label>
                                            <div class="input-group">
                                              <input type="number" name="quantity" :value="old('quantity')" required autofocus  class="form-control" id="exampleInputUsername2" placeholder="quantité">
                                          </div>
                                        </div>
                                      </div>

                                      <div class="col-lg 4">   
                                        <div class="form-group">
                                            <label for="exampleInputUsername6">Montant</label>
                                            <div class="input-group">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                              </div>
                                              <input type="text" name="montant" :value="old('montant')" required autofocus  class="form-control" id="exampleInputUsername6" placeholder="montant">
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg 6">   
                                        <div class="form-group">
                                          <label for="exampleInputUsername4">Sélectionnez le client</label>
                                          <select id="exampleInputUsername4" name="client" class="form-control" required>
                                            @foreach($clients as $client)
                                              <option value="{{ $client->id }}">
                                                {{$client->name . ' '.  $client->tel }}
                                              </option>
                                            @endforeach  
                                          </select>
                                        </div>
                                      </div>   
                                      <div class="col-lg 6">   
                                        <div class="form-group">
                                            <label for="exampleInputUsername7">Déscription</label>
                                            <div class="input-group">
                                              <input type="text" name="description" :value="old('description')" required autofocus  class="form-control" id="exampleInputUsername7" placeholder="déscription">
                                          </div>
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
                      
                      
                        <div class="col-lg-4 d-flex flex-column">
                            <div class="row flex-grow">
                                <div class="col-md-6 col-lg-12 grid-margin">
                                    <div class="card bg-primary card-rounded">
                                        <div class="card-body pb-0">
                                            <h4 class="card-title card-title-dash text-white mb-4">Nombre de dettes</h4>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p class="status-summary-ight-white mb-1">Total</p>
                                                    <a href="{{ route('matiere.index')}}">
                                                      <h2 class="text-info">{{ $dettes->count()}}</h2>
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

