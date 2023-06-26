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
                            <a class="nav-link active ps-0" id="contact-tab" data-bs-toggle="tab" href="#year" role="tab" aria-controls="year" aria-selected="true">Welcome</a>
                        </li>
                      </ul>
                    </div>
                
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="year" role="tabpanel" aria-labelledby="year"> 
                     
                    <div class="row">
                      <div class="col-lg-3 grid-margin stretch-card"> </div>                      
                      @auth

                      <div class="col-lg-6 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                  
                                <img class="img-lg rounded-circle mx-auto d-block" src="{{ asset(Auth::user()->image) }}" alt="{{ Auth::user()->name }}"> 
                                
                                <hr>

                                <div class="text-center" >{{ GoogleTranslate::trans('Nom:', $appLocale) }}  {{ Auth::user()->name }}</div>
                                <div class="text-center" >{{ GoogleTranslate::trans('Email:', $appLocale) }} {{ Auth::user()->email }}</div>
                                <div class="text-center" >{{ GoogleTranslate::trans('Depuis:', $appLocale) }} {{ Auth::user()->created_at->format('d-M-Y') }}</div>
                                <br>
                                @if(Auth::user()->userType)  
                                  <div class="text-center">
                                      <div class="badge badge-primary"> 
                                        {{ Auth::user()->userType->name }}
                                      </div>
                                  </div>
                                @endif
                                <br>
                                <div class="text-center">  
                                  <form class="dropdown-item" method="post" action="{{ route('logout') }}">
                                    @csrf
                                    <input type="hidden" name="user_email" value="{{ Auth::user()->email }}">
                                    <button type="submit" :href="route('logout')" class="border border-0 bg bg-primary text-light rounded-3">
                                      <i class="dropdown-item-icon mdi mdi-power text-light"></i>
                                      Déconnexion</button>
                                  </form>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endauth



                      <div class="col-lg-3 grid-margin stretch-card"> </div>
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

