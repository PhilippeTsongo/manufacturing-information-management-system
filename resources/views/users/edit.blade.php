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
                                        <h4 class="card-title card-title-dash">Enregistrez un nouvel utilisateur</h4>
                                        <h5 class="card-subtitle card-subtitle-dash">Complétez ce formulaire pour Enregistrer un nouvel utilisateur</h5>
                                    </div>
                                    <div id="performance-line-legend"></div>
                                </div>
                                <div>
                                  @include('../../partials/message')
                                </div>
                                
                                <form class="forms-sample" method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-lg 6">   
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Nom d'utilisateur</label>
                                                <input type="text" type="text" name="name" value="{{ old('name') ?? $user->name}}" required autofocus  class="form-control" id="exampleInputUsername1" placeholder="nom">
                                            </div>
                                        </div>
                                        <div class="col-lg 6">   
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Addresse Email</label>
                                                <input type="email" name="email" value="{{ old('email') ?? $user->email }}" required class="form-control" id="exampleInputEmail1" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg 6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Mot de passe</label>
                                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe">
                                            </div>
                                        </div>
                                        <div class="col-lg 6">
                                            <div class="form-group">
                                                <label for="exampleInputConfirmPassword1">Confirmez le mot de passe</label>
                                                <input type="password" name="password_confirmation" class="form-control" id="exampleInputConfirmPassword1" placeholder="Comfirmez le mot de passe">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                      <div class="col-lg 6">
                                        <div class="form-group">
                                          <label for="exampleInputConfirmPassword5">Choisissez l'image</label>
                                          <input type="file" name="image" accept="image/png, image/gif, image/jpeg" class="form-control" id="exampleInputConfirmPassword5" placeholder="Choisissez une image">
                                        </div>
                                      </div>

                                      <div class="form-check form-check-flat form-check-primary">
                                        <select name="user_type" class="form-control">
                                          @if($user->userType)
                                            <option value="{{ $user->userType->id }}">{{ $user->userType->name }}</option>
                                          @endif
                                          @foreach ($user_types as $user_type)
                                            <option value="{{ $user_type->id }}">{{ $user_type->name }}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary me-2">Enregistrez</button>
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
                                            <h4 class="card-title card-title-dash text-white mb-4">Nombre d'utilisateurs</h4>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p class="status-summary-ight-white mb-1">Total</p>
                                                    <h2 class="text-info">{{ $users->count()}}</h2>
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

