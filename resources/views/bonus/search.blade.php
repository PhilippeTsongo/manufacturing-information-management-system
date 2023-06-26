<!DOCTYPE html>
<html lang="en">
 
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

    <title>Kanabe Système</title>


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
                                <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">{{ GoogleTranslate::trans('Offrir un bonus', $appLocale)}}</a>
                            </li>
                        </ul>
                        <div>
                            <div class="btn-wrapper">
                                <a href="{{ route('bonus.index')}}" class="btn btn-primary text-white me-2"><i class="mdi mdi-plus-circle-outline"></i>{{ GoogleTranslate::trans('Liste de bonus accordés', $appLocale)}}</a>
                            </div>
                        </div>
                    </div>
                
                <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                        
                        <div class="row">
                            <div>
                                @include('../partials/message')
                            </div>
                            
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ GoogleTranslate::trans('Accourder un Bonus au Client', $appLocale)}}</h4>
                                    
                                        <form method="GET" action="{{ route('bonus.create') }}" >
                                            <div class="row">
                                                <div class="col-lg-9">
                                                    <input type="search" name="query" value="" placeholder="{{ GoogleTranslate::trans('Recherchez une production', $appLocale)}}" class="form-control" title="{{ GoogleTranslate::trans('Entrer le numéro de la production', $appLocale)}}">
                                                </div>
                                                <div class="col-lg-3">
                                                    <button type="submit" class="form-control btn btn-primary text-white"><i class="icon-search"></i></button>
                                                </div>   
                                            </div>    
                                        </form>

                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ GoogleTranslate::trans('catégorie', $appLocale)}}</th>
                                                        <th>{{ GoogleTranslate::trans('Disponible', $appLocale)}}</th>
                                                        <th>{{ GoogleTranslate::trans('Quantité', $appLocale)}}</th>
                                                        <th>{{ GoogleTranslate::trans('Client', $appLocale)}}</th>
                                                        <th>{{ GoogleTranslate::trans('Prix de vente', $appLocale)}}</th>
                                                        @if(Auth()->check())
                                                            @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Vendeur')
                                                                <th>
                                                                    {{ GoogleTranslate::trans('Action', $appLocale)}}
                                                                </th>
                                                            @endif
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                @forelse($productions as $production)    
                                                    <form action="{{ route('bonus.store') }}" method="post" onSubmit="return confirm('Voulez-vous vendre cette production?');">
                                                        @csrf
                
                                                        {{-- FORM HIDDEN VALUES FOR PRODUCTS --}}
                                                        <input type="hidden" name="production_id" value="{{ $production->id }}">
                                                        <input type="hidden" name="total_quantity" value="{{ $production->quantity }}">
                                                        <input type="hidden" name="bonus_price" value="{{ $production->sale_price }}">

                                                        <tr>
                                                            <td>{{ $production->number }}</td>
                                                            <td>
                                                                @if($production->category)
                                                                <div class="badge badge-opacity-warning">
                                                                    {{ $production->category->name }}
                                                                </div>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($production->unit)
                                                                {{ $production->quantity }} {{ $production->unit->name }} 
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control" name="quantity" required>
                                                            </td>
                                                            <td>
                                                                <select name="client" class="form-control">
                                                                    @foreach ($clients as $client)
                                                                        @if($client->ventes)
                                                                            <option value="{{ $client->id }}"> {{ $client->name}} [{{ $client->client_number}}] </option>
                                                                        @else
                                                                           <option value="">{{ 'Le client doit avoir acheté plusieurs fois pour'}}</option> 
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td> <div class="text-danger"> {{ number_format($production->sale_price, 02) .'$' }} </div></td>
                                                            
                                                            @if(Auth()->check())
                                                                @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Vendeur')
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <button type="submit" class=" btn btn-primary text-white"> <i class="mdi mdi-check-circle-outline"></i></button>
                                                                        </div>  
                                                                    </div>
                                                                </td>
                                                                @endif
                                                            @endif
                                                        
                                                        </tr>
                                                    </form>
                                                @empty
                                                <br><span class="alert alert-danger"> {{ GoogleTranslate::trans('Aucun résultat', $appLocale) }} </span><br><br>
                                                @endforelse

                                                {{ $productions->links('vendor.pagination.bootstrap-5')}}
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

