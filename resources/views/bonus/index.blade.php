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
                              <a class="nav-link" id="home-tab" data-bs-toggle="tab" href="#daily" role="tab" aria-selected="false">{{ GoogleTranslate::trans('Aujourd\'hui', $appLocale)}} [{{ $today }}]</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#month" role="tab" aria-selected="false">{{ GoogleTranslate::trans('Mensuelles', $appLocal)}} [{{ $month }}] </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link active ps-0" id="contact-tab" data-bs-toggle="tab" href="#year" role="tab" aria-controls="year"  aria-selected="true">{{ GoogleTranslate::trans('Annuelles', $appLocale)}} [{{ $year }}]</a>
                          </li>
                        </ul>
                        <div>
                            <div class="btn-wrapper">
                                <a href="{{ route('bonus.create')}}" class="btn btn-primary text-white me-2"><i class="mdi mdi-plus-circle-outline"></i>{{ GoogleTranslate::trans('Accordez un bonus', $appLocale)}}</a>
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
                                      <h4 class="card-title">{{ GoogleTranslate::trans('Liste de bonus journalièrs accordés', $appLocale)}} [{{ $today }}]</h4>
                                  </div>    
                                  <div id="performance-line-legend"></div>
                                  <div>
                                      <a href="{{ route('bonus.create')}}" class="btn btn-primary btn-lg text-white mb-0 me-0"><i class="mdi mdi-plus-circle-outline"></i>{{ GoogleTranslate::trans('Accordez un bonus', $appLocale)}}</a>
                                  </div>
                              </div>
                            
                              <div>
                                @include('../partials/message')
                              </div>

                              <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ GoogleTranslate::trans('catégorie', $appLocale)}}</th>
                                            <th>{{ GoogleTranslate::trans('Quantité', $appLocale)}}</th>
                                            <th>{{ GoogleTranslate::trans('Prix Unitaire', $appLocale)}}</th>
                                            <th>{{ GoogleTranslate::trans('Prix Total', $appLocale)}}</th>
                                            <th>{{ GoogleTranslate::trans('Date', $appLocale)}}</th>
                                            <th>{{ GoogleTranslate::trans('Client', $appLocale)}}</th>
                                            @if(Auth()->check())
                                                @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Vendeur')
                                                    <th>{{ GoogleTranslate::trans('Action', $appLocale)}}</th>
                                                @endif
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <form action="{{ route('facture.index') }}" target="_blank" method="post">
                                        @csrf
                                        @method('GET')
                                        <?php $total = 0; ?>  

                                        @foreach($dailys as $daily_bonus)
                                          <tr>
                                            <td>
                                                {{ $daily_bonus->bonus_number }}
                                            </td>
                                            <td>
                                              @if($daily_bonus->production)
                                                @if($daily_bonus->production->category)
                                                    <div class="badge badge-opacity-warning">{{ $daily_bonus->production->category->name }}</div>
                                                @endif        
                                            @endif  
                                            </td>
                                            <td>
                                              {{ $daily_bonus->quantity }} 
                                              @if($daily_bonus->production)
                                                @if($daily_bonus->production->unit)
                                                    {{$daily_bonus->production->unit->name}}
                                                @endif
                                              @endif
                                            </td>
                                            <td><span class="text-danger"> {{  number_format($daily_bonus->price, 02) .'$'}} </span></td>
                                            <td>{{  number_format($daily_bonus->quantity * $daily_bonus->price, 02) .'$'}} </td>
                                            <td>{{ $daily_bonus->date_bonus}}</td>
                                            <td>
                                              @if($daily_bonus->client)
                                                {{ $daily_bonus->client->name}} [{{ $daily_bonus->client->client_number}}]
                                              @endif
                                            </td>
                                            <td>
                                              <input type="checkbox" name="select_fac[]" value="{{ $daily_bonus->id }}">
                                            </td>
                                          </tr>
                                          <?php  $total = $total + ( $daily_bonus->quantity * $daily_bonus->price); ?>
                                        @endforeach
                                        <tr>
                                          <td colspan="4">
                                            Total 
                                          </td>
                                          <td colspan="3"> <div class="badge badge-opacity-warning"><b><?= number_format($total, 02) .'$' ?></b></div> </td>
                                          <td>
                                            <input type="submit" class="btn btn-primary text-light" title="{{ GoogleTranslate::trans('Imprimez les factures de ventes sélectionées', $appLocale)}}" value="{{ GoogleTranslate::trans('Imprimer la facture', $appLocale)}}"> 
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
                                      <h4 class="card-title">{{ GoogleTranslate::trans('Liste de Bonus Mensuels accordés', $appLocale)}} [{{ $month }}]</h4>
                                  </div>    
                                  <div id="performance-line-legend"></div>
                                  <div>
                                      <a href="{{ route('bonus.create')}}" class="btn btn-primary btn-lg text-white mb-0 me-0"><i class="mdi mdi-plus-circle-outline"></i>Accordez un bonus</a>
                                  </div>
                              </div>
                            
                              <div>
                                @include('../partials/message')
                              </div>

                              <div class="table-responsive">
                                <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>{{ GoogleTranslate::trans('catégorie', $appLocale)}}</th>
                                          <th>{{ GoogleTranslate::trans('Quantité', $appLocale)}}</th>
                                          <th>{{ GoogleTranslate::trans('Prix Unitaire', $appLocale)}}</th>
                                          <th>{{ GoogleTranslate::trans('Prix Total', $appLocale)}}</th>
                                          <th>{{ GoogleTranslate::trans('Date', $appLocale)}}</th>
                                          <th>{{ GoogleTranslate::trans('Client', $appLocale)}}</th>
                                          @if(Auth()->check())
                                              @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Vendeur')
                                                  <th>{{ GoogleTranslate::trans('Action', $appLocale)}}</th>
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
                                              {{ $month->bonus_number }}
                                          </td>
                                          <td>
                                            @if($month->production)
                                                @if($month->production->category)
                                                <div class="badge badge-opacity-warning">{{ $month->production->category->name }}</div>
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
                                          <td>{{ $month->date_bonus}}</td>
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
                                          <input type="submit" class="btn btn-primary text-light" title="{{ GoogleTranslate::trans('Imprimez les factures de ventes sélectionées', $appLocale)}}" value="{{ GoogleTranslate::trans('Imprimer la facture', $appLocale)}}"> 
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
                                      <h4 class="card-title">{{ GoogleTranslate::trans('Liste de Bonus Annuels accordés', $appLocale)}} [{{ $year }}]</h4>
                                  </div>    
                                  <div id="performance-line-legend"></div>
                                  <div>
                                      <a href="{{ route('bonus.create')}}" class="btn btn-primary btn-lg text-white mb-0 me-0"><i class="mdi mdi-plus-circle-outline"></i>{{ GoogleTranslate::trans('Accordez un bonus', $appLocale)}}</a>
                                  </div>
                              </div>
                            
                              <div>
                                @include('../partials/message')
                              </div>

                              <div class="table-responsive">
                                <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>{{ GoogleTranslate::trans('catégorie', $appLocale)}}</th>
                                          <th>{{ GoogleTranslate::trans('Quantité', $appLocale)}}</th>
                                          <th>{{ GoogleTranslate::trans('Prix Unitaire', $appLocale)}}</th>
                                          <th>{{ GoogleTranslate::trans('Prix Total', $appLocale)}}</th>
                                          <th>{{ GoogleTranslate::trans('Date', $appLocale)}}</th>
                                          <th>{{ GoogleTranslate::trans('Client', $appLocale)}}</th>
                                          @if(Auth()->check())
                                              @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Vendeur')
                                                  <th>{{ GoogleTranslate::trans('Action', $appLocale)}}</th>
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
                                              {{ $year->bonus_number }}
                                          </td>
                                          <td>
                                            @if($year->production)
                                                @if($year->production->category)
                                                <div class="badge badge-opacity-warning">{{ $year->production->category->name }}</div>
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
                                          <td>{{ $year->date_bonus}}</td>
                                          <td>
                                            @if($year->client)
                                              {{ $year->client->name}} [{{ $year->client->client_number}}]
                                            @endif
                                          </td>
                                          <td>
                                              @if(Auth()->check())
                                                  @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Vendeur')
                                                  <div class="row">
                                                    {{--  edit  --}}
                                                      {{-- <div class="col-lg-6">
                                                          <a href="{{ route('bonus.edit', ['sale' => $year->id]) }}" _method="GET" 
                                                              onClick="return confirm('Voulez-vous vraiment modifier cette Vente?');" title="Modifier cette Vente"> 
                                                              <i class="mdi mdi-pencil text-info"></i>
                                                          </a>
                                                      </div>   --}}
                                                      <div class="col-lg-6">
                                                          {{-- delete --}}
                                                          <form action="{{ route('bonus.destroy', ['bonu' => $year->id ]) }}" method="post" onsubmit="return confirm('{{ GoogleTranslate::trans('Voulez-vous vraiment supprimer ce bonus?', $appLocale)}}');">
                                                              @csrf
                                                              @method('DELETE')
                                                              <button type="submit" style="border:none; background: none" title="{{ GoogleTranslate::trans('Supprimez ce bonus', $appLocal)}}" > <i class="mdi mdi-delete-forever text-danger"></i></button>
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

