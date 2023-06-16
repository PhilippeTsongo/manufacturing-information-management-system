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
                                <a class="nav-link" id="home-tab" data-bs-toggle="tab" href="#rec_basic" role="tab" aria-selected="true" >Moins de 10</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#rec_bus" role="tab" aria-selected="false">Moins de 30</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active ps-0" id="contact-tab" data-bs-toggle="tab" href="#rec_pro" role="tab" aria-selected="false" aria-controls="rec_pro">Moins de 50</a>
                            </li>
                        </ul>
                        <div>
                            <div class="btn-wrapper">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-otline-dark"><i class="icon-printer"></i>Imprimer</button>
                                    <button type="button" class="btn btn-otline-dark dropdown-toggle" id="dropdownMenuSplitButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuSplitButton1">
                                        @foreach($mois as $month)
                                            <a target="blank" href="{{ route('rapport.requisition', ['month' => $month->name ]) }}" method="GET" class="dropdown-item">{{ $month->name }}</a>
                                        @endforeach                             
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                <div class="tab-content tab-content-basic">
                    {{-- rec_basic--}}
                    <div class="tab-pane fade show" id="rec_basic" role="tabpanel" aria-labelledby="rec_basic"> 
                        
                        <div class="row">
                        
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                    
                                        <div>
                                            <h4 class="card-title">Liste de Productions Avec Moins de  10 pcs</h4>
                                        </div>
                                        <div id="performance-line-legend"></div>

                                    </div>
                                    <div>
                                        <div>
                                            @include('../partials/message')
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Catégorie</th>
                                                    <th>Quantité</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                        <tbody>
                                            @foreach($rec_basics as $rec_basic)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('production.show', ['production' => $rec_basic->id ])}}" style="text-decoration:none" title="Voir le detail production">
                                                        {{ $rec_basic->number }}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if($rec_basic->category)
                                                        <div class="badge badge-opacity-warning">{{$rec_basic->category->name}}</div>
                                                    @endif
                                                </td>
                                                
                                                <td>{{ $rec_basic->quantity }}  
                                                    @if($rec_basic->unit)
                                                        {{ $rec_basic->unit->name }}
                                                    @endif
                                                </td>
                                                
                                                <td>{{ $rec_basic->created_at->format('d-M-Y') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- rec_Business--}}
                    <div class="tab-pane fade show" id="rec_bus" role="tabpanel" aria-labelledby="rec_bus"> 
                        
                        <div class="row">
                        
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                    
                                        <div>
                                            <h4 class="card-title">Liste de productions Avec Moins de 30 Pcs</h4>
                                        </div>
                                        <div id="performance-line-legend"></div>

                                    </div>
                                    <div>
                                        <div>
                                            @include('../partials/message')
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Catégorie</th>
                                                    <th>Quantité</th>
                                                    <th>Date</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($rec_businesses as $rec_business)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('production.show', $rec_business)}}" style="text-decoration:none" title="Voir le detail production">
                                                        {{ $rec_business->number }}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if($rec_business->category)
                                                        <div class="badge badge-opacity-warning">{{$rec_business->category->name}}</div>
                                                    @endif
                                                </td>
                                                
                                                <td>{{ $rec_business->quantity }}  
                                                    @if($rec_business->unit)
                                                        {{ $rec_business->unit->name }}
                                                    @endif
                                                </td>
                                                
                                                <td>{{ $rec_business->created_at->format('d-M-Y') }}</td>
                                                
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                </div>
                            </div>
                        
                        </div>
                        
                    </div>

                    {{-- rec_pros--}}
                    <div class="tab-pane fade show active" id="rec_pro" role="tabpanel" aria-labelledby="rec_pro"> 
                        
                        <div class="row">
                        
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                    
                                        <div>
                                            <h4 class="card-title">Liste de productions Avec Moins de 50 Pcs</h4>
                                        </div>
                                        <div id="performance-line-legend"></div>

                                    </div>
                                    <div>
                                        <div>
                                            @include('../partials/message')
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Catégorie</th>
                                                    <th>Quantité</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($rec_pros as $rec_pro)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('production.show', $rec_pro)}}" style="text-decoration:none" title="Voir le detail production">
                                                        {{ $rec_pro->number }}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if($rec_pro->category)
                                                        <div class="badge badge-opacity-warning">{{$rec_pro->category->name}}</div>
                                                    @endif
                                                </td>
                                                
                                                <td>{{ $rec_pro->quantity }}  
                                                    @if($rec_pro->unit)
                                                        {{ $rec_pro->unit->name }}
                                                    @endif
                                                </td>
                                                
                                                <td>{{ $rec_pro->created_at->format('d-M-Y') }}</td>
                                                
                                            </tr>
                                            @endforeach

                                            <br>
                                            {{ $rec_pros->links('vendor.pagination.bootstrap-5') }}
                                            </tbody>
                                        </table>
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

