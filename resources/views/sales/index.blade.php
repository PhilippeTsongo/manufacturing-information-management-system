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
                              <a class="nav-link" id="home-tab" data-bs-toggle="tab" href="#daily" role="tab" aria-selected="false">Aujourd'hui [{{ $today }}]</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#month" role="tab" aria-selected="false">Mensuelles [{{ $month }}] </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link active ps-0" id="contact-tab" data-bs-toggle="tab" href="#year" role="tab" aria-controls="year"  aria-selected="true">Annuelles [{{ $year }}]</a>
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
                                        <a target="blank" href="{{ route('rapport.sale', ['month' => $month->name ]) }}" method="GET" class="dropdown-item">{{ $month->name }}</a>
                                    @endforeach                             
                                </div>
                              </div>
                              <a href="{{ route('production.search')}}" class="btn btn-primary text-white me-2"><i class="mdi mdi-plus-circle-outline"></i>Nouvelle Vente</a>
                            </div>
                        </div>
                    </div>
                
                <div class="tab-content tab-content-basic">
                  

                  {{-- Daily --}}
                  <div class="tab-pane fade show " id="daily" role="tabpanel" aria-labelledby="daily"> 
                    <div class="row">
                        {{-- Liveware --}}
                        <div class="col-lg-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                      <h4 class="card-title">Liste de Ventes journalières [{{ $today }}]</h4>
                                  </div>    
                                  <div id="performance-line-legend"></div>
                                  
                              </div>
                            
                              <div>
                                @include('../partials/message')
                              </div>

                              <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>catégorie</th>
                                            <th>Type d'emballage</th>
                                            <th>Quantité</th>
                                            <th>Prix Unitaire</th>
                                            <th>Prix Total</th>
                                            <th>Date</th>
                                            <th>Client</th>
                                            @if(Auth()->check())
                                                @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Vendeur')
                                                    <th>Action</th>
                                                @endif
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <form action="{{ route('facture.index') }}" target="_blank" method="post">
                                        @csrf
                                        @method('GET')
                                        <?php $total = 0; ?>  

                                        @foreach($dailys_sales as $daily_sale)
                                          <tr>
                                            <td>
                                              @if($daily_sale->production)
                                                {{ $daily_sale->sale_number }}
                                              @endif  
                                            </td>
                                            <td>
                                              @if($daily_sale->production->category)
                                                <div class="badge badge-opacity-warning">{{ $daily_sale->production->category->name }}</div>
                                              @endif  
                                            </td>
                                            <td>
                                              @if($daily_sale->production)
                                                @if($daily_sale->production->emballage)
                                                  @if($daily_sale->production->emballage->type_emballage)
                                                    {{ $daily_sale->production->emballage->type_emballage->name }}
                                                  @endif
                                                @endif
                                              @endif
                                            </td>
                                            <td>
                                              {{ $daily_sale->quantity }} 
                                              @if($daily_sale->production->unit)
                                                {{$daily_sale->production->unit->name}}
                                              @endif
                                            </td>
                                            <td><span class="text-danger"> {{  number_format($daily_sale->price, 02) .'$'}} </span></td>
                                            <td>{{  number_format($daily_sale->quantity * $daily_sale->price, 02) .'$'}} </td>
                                            <td>{{ $daily_sale->date_sale}}</td>
                                            <td>
                                              @if($daily_sale->client)
                                                {{ $daily_sale->client->name}} [{{ $daily_sale->client->client_number}}]
                                              @endif
                                            </td>
                                            <td>
                                              <input type="checkbox" name="select_fac[]" value="{{ $daily_sale->id }}">
                                            </td>
                                            
                                          </tr>
                                          <?php  $total = $total + ( $daily_sale->quantity * $daily_sale->price); ?>
                                        @endforeach
                                        <tr>
                                          <td colspan="4">
                                            Total 
                                          </td>
                                          <td colspan="3"> <div class="badge badge-opacity-warning"><b><?= number_format($total, 02) .'$' ?></b></div> </td>
                                          
                                          <td>
                                            <input type="submit" class="btn btn-primary text-light" title="Imprimez les factures de ventes sélectionées" value="Imprimer la facture"> 
                                          </td>
                                        </tr>
                                      </form>
                                      <br>
                                    </tbody>
                                </table>
                              </div>
                              
                            </div>
                          </div>
                        </div>
                      
                    </div>
                    
                  </div>

                  {{-- Month --}}
                  <div class="tab-pane fade show" id="month" role="tabpanel" aria-labelledby="month"> 
                    <div class="row">
                      
                        <div class="col-lg-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                      <h4 class="card-title">Liste de Ventes Mensuelles [{{ date('M') }}]</h4>
                                  </div>    
                                  <div id="performance-line-legend"></div>
                              </div>
                            
                              <div>
                                @include('../partials/message')
                              </div>

                              <div class="table-responsive">
                                <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>catégorie</th>
                                          <th>Type d'emballage</th>
                                          <th>Quantité</th>
                                          <th>Prix Unitaire</th>
                                          <th>Prix Total</th>
                                          <th>Date</th>
                                          <th>Client</th>
                                          @if(Auth()->check())
                                              @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Vendeur')
                                                  <th>Action</th>
                                              @endif
                                          @endif
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <form action="{{ route('facture.index') }}" target="_blank" method="post">
                                      @csrf
                                      {{ method_field('GET')}}
                                      <?php $total = 0; ?>  

                                      @foreach($months as $month)
                                        <tr>
                                          <td>
                                            @if($month->production)
                                              {{ $month->sale_number }}
                                            @endif  
                                          </td>
                                          <td>
                                            @if($month->production)
                                              @if($month->production->category)
                                                <div class="badge badge-opacity-warning">{{ $month->production->category->name }}</div>
                                              @endif 
                                            @endif 
                                          </td>
                                          <td>
                                            @if($month->production)
                                              @if($month->production->emballage)
                                                @if($month->production->emballage->type_emballage)
                                                  {{ $month->production->emballage->type_emballage->name }}
                                                @endif
                                              @endif
                                            @endif
                                          </td>
                                          <td>
                                            {{ $month->quantity }}
                                            @if($month->production) 
                                              @if($month->production->unit)
                                                {{$month->production->unit->name}}
                                              @endif
                                            @endif
                                          </td>
                                          <td><span class="text-danger"> {{  number_format($month->price, 02) .'$'}} </span></td>
                                          <td>{{  number_format($month->quantity * $month->price, 02) .'$'}} </td>
                                          <td>{{ $month->date_sale}}</td>
                                          <td>
                                            @if($month->client)
                                              {{ $month->client->name}} [{{ $month->client->client_number}}]
                                            @endif
                                          </td>
                                          <td>
                                            <input type="checkbox" name="select_fac[]" value="{{ $month->id }}"> 
                                          </td>
                                          
                                        </tr>
                                        <?php  $total = $total + ( $month->quantity * $month->price); ?>
                                      @endforeach
                                      <tr>
                                        <td colspan="4">
                                          Total 
                                        </td>
                                        <td colspan="3"> <div class="badge badge-opacity-warning"><b><?= number_format($total, 02) .'$' ?></b></div> </td>
                                        
                                        <td>
                                          <input type="submit" class="btn btn-primary text-light" title="Imprimez les factures de ventes sélectionées" value="Imprimer la facture"> 
                                        </td>
                                      </tr>

                                    </form>
                                    <br>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    
                  </div>
                  
                  {{-- year --}}
                  <div class="tab-pane fade show active" id="year" role="tabpanel" aria-labelledby="year"> 
                    <div class="row">
                      
                        <div class="col-lg-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                      <h4 class="card-title">Liste de Ventes Annuelles [{{ $year }}]</h4>
                                  </div>    
                                  <div id="performance-line-legend"></div>
                                  
                              </div>
                            
                              <div>
                                @include('../partials/message')
                              </div>

                              <div class="table-responsive">
                                <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>catégorie</th>
                                          <th>Type d'emballage</th>
                                          <th>Quantité</th>
                                          <th>Prix Unitaire</th>
                                          <th>Prix Total</th>
                                          <th>Date</th>
                                          <th>Client</th>
                                          @if(Auth()->check())
                                               @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Vendeur')
                                                  <th>Action</th>
                                              @endif
                                          @endif
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @csrf
                                      @method('GET')
                                      <?php $total = 0; ?>  

                                      @foreach($years as $year)
                                        <tr>
                                          <td>
                                            @if($year->production)
                                              {{ $year->sale_number }}
                                            @endif  
                                          </td>
                                          <td>
                                            @if($year->production)
                                              @if($year->production->category)
                                                <div class="badge badge-opacity-warning">{{ $year->production->category->name }}</div>
                                              @endif
                                            @endif
                                          </td>
                                          <td>
                                            @if($year->production)
                                              @if($year->production->emballage)
                                                @if($year->production->emballage->type_emballage)
                                                  {{ $year->production->emballage->type_emballage->name }}
                                                @endif
                                              @endif
                                            @endif
                                          </td>
                                          <td>
                                            {{ $year->quantity }}
                                            @if($year->production) 
                                              @if($year->production->unit)
                                                {{$year->production->unit->name}}
                                              @endif
                                            @endif
                                          </td>
                                          <td><span class="text-danger"> {{  number_format($year->price, 02) .'$'}} </span></td>
                                          <td>{{  number_format($year->quantity * $year->price, 02) .'$'}} </td>
                                          <td>{{ $year->date_sale}}</td>
                                          <td>
                                            @if($year->client)
                                              {{ $year->client->name}}
                                            @endif
                                          </td>
                                          <td>
                                              @if(Auth()->check())
                                                @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Vendeur')
                                                  <div class="row">
                                                      
                                                      <div class="col-lg-6">
                                                          {{-- delete --}}
                                                          <form action="{{ route('sale.destroy', ['sale' => $year->id ]  ) }}" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer cette Vente?');">
                                                              @csrf
                                                              @method('DELETE')
                                                              <button type="submit" style="border:none; background: none" title="Supprimez cette Vente" > <i class="mdi mdi-delete-forever text-danger"></i></button>
                                                          </form>
                                                      </div>
                                                  </div>
                                                @endif
                                              @endif

                                          </td>
                                        </tr>
                                        <?php  $total = $total + ( $year->quantity * $year->price); ?>
                                      @endforeach
                                      <tr>
                                        <td colspan="4">
                                          Total 
                                        </td>
                                        <td > <div class="badge badge-opacity-warning"><b><?= number_format($total, 02) .'$' ?></b></div> </td>
                                        
                                      </tr>
                                    <br>
                                    {{ $years->links('vendor.pagination.bootstrap-5')}}
                                  </tbody>
                                </table>
                              </div>
                              
                            </div>
                          </div>
                        </div>

                        {{-- <div class="col-lg-3 d-flex flex-column">
                            <div class="row flex-grow">
                                <div class="col-md-6 col-lg-12 grid-margin">
                                    <div class="card bg-primary card-rounded">
                                        <div class="card-body pb-0">
                                            <h4 class="card-title card-title-dash text-white mb-4">Nombre total de ventes Mensuelles</h4>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p class="status-summary-ight-white mb-1">Total</p>
                                                    <h2 class="text-info">{{ $years->count() }}</h2>
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

