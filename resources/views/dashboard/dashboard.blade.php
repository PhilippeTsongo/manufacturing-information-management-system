<!DOCTYPE html>
<html lang="en">

  <title>Kanabe Système</title>
    

  @extends('layouts.app')
  
  @section('content')
    
  <div class="container-scroller">
    <!-- header   -->

    <div class="container-fluid page-body-wrapper">
      {{-- aside --}}
      @include('partials.aside')

      {{-- IMPORTANT VARIABLE --}}
      <?php
        //shortlisting app()->getLocal
        $appLocale = app()->getLocale();  
      ?>


      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#audiences" role="tab" aria-selected="false">Aujourd'hui</a>
                    </li>
                  </ul>
                </div>
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="statistics-details d-flex align-items-center justify-content-between">
                          <div>
                            <p class="statistics-title">{{ GoogleTranslate::trans('Matières premières', $appLocale) }}</p>
                            <h3 class="rate-percentage">@if($matieres) {{ $matieres->count() }} @else {{ 'O' }} @endif</h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-up"></i>
                              <span>
                                <a href="{{ route('matiere.index') }}" style="text-decoration: none"> 
                                <?php $mat = 0 ;?>
                                @foreach($matieres as $matiere)
                                  <?php $mat = $mat + ($matiere->quantity * $matiere->purchase_price); ?>
                                @endforeach
                                {{ number_format($mat, 02) .'$' ;}}
                                </a>
                              </span>
                            </p>
                          </div>
                          <div>
                            <p class="statistics-title">{{ GoogleTranslate::trans('Emballages' , $appLocale)}}</p>
                            <h3 class="rate-percentage">@if($emballages) {{ $emballages->count() }} @else {{ 'O' }} @endif</h3>
                            <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i>
                              <span>
                                <a href="{{ route('emballage.index') }}" style="text-decoration: none"> 
                                <?php $emb = 0 ;?>
                                @foreach($emballages as $emballage)
                                  <?php $emb = $emb + ($emballage->quantity * $emballage->purchase_price); ?>
                                @endforeach
                                {{ number_format($emb, 02) .'$' ;}}
                                </a>
                              </span>
                            </p>
                          </div>
                          <div>
                            <p class="statistics-title">{{ GoogleTranslate::trans('Productions', $appLocale)}}</p>
                            <h3 class="rate-percentage">@if($productions) {{ $productions->count() }} @else {{ 'O' }} @endif</h3>
                            <p class="text-info d-flex"><i class="mdi mdi-menu-up"></i>
                              <span> 
                               
                              </span>
                            </p>
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">{{ GoogleTranslate::trans('Ventes', $appLocale) }}</p>
                            <h3 class="rate-percentage">@if($sales) {{ $sales->count() }} @else {{ 'O' }} @endif</h3>
                            <p class="text-primary d-flex"><i class="mdi mdi-menu-up"></i>
                              <span>
                                <a href="{{ route('sale.index') }}" style="text-decoration: none"> 
                                <?php $sal = 0 ;?>
                                @foreach($sales as $sale)
                                  <?php $sal = $sal + ($sale->price * $sale->quantity); ?>
                                @endforeach
                                {{ number_format($sal, 02) .'$' ;}}
                                </a>
                              </span>
                            </p>
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">{{ GoogleTranslate::trans('Charges Financières', $appLocale)}}</p>
                            <h3 class="rate-percentage">@if($sorties) {{ $sorties->count() }} @else {{ 'O' }} @endif</h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i>
                              <span>
                                <a href="{{ route('sortie.index') }}" style="text-decoration: none"> 
                                <?php $sort = 0 ;?>
                                @foreach($sorties as $sortie)
                                  <?php $sort = $sort + ($sortie->montant); ?>
                                @endforeach
                                {{ number_format($sort, 02) .'$' ;}}
                                </a>
                              </span>
                            </p>
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">{{ GoogleTranslate::trans('Dettes', $appLocale)}}</p>
                            <h3 class="rate-percentage">@if($dettes) {{ $dettes->count() }} @else {{ 'O' }} @endif</h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i>
                              <span>
                                <a href="{{ route('dette.index') }}" style="text-decoration: none"> 
                                <?php $det = 0 ;?>
                                @foreach($dettes as $dette)
                                  <?php $det = $det + ($dette->montant); ?>
                                @endforeach
                                {{ number_format($det, 02) .'$' ;}}
                                </a>
                              </span>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div> 
                    <div class="row">
                      <div class="col-lg-8 d-flex flex-column">
                        <div class="row">
                          <div class="col-md-12 col-lg-12 grid-margin">
                            <div class="card card-rounded bg-danger">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                   <h4 class="card-title card-title-dash text-light">Production dont la quantité est moins de 50 Pcs en stock </h4>
                                   <a href="{{ route('product.requisition')}}" style="text-decoration:none">
                                    <h5 class="card-subtitle card-subtitle-dash text-light">
                                        @if($requisitions)
                                          {{ $requisitions->count() .' Production(s)'}}
                                        @endif
                                    </h5>
                                   </a>
                                  </div>
                                  <div id="performance-line-legend"></div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6 col-lg-12 grid-margin">
                            <div class="card card-rounded bg-primary">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash text-light">Categories de productions</h4>
                                    <a href="{{ route('category.index')}}" style="text-decoration:none">
                                      <h5 class="card-subtitle card-subtitle-dash text-light">
                                        @if($categories)
                                          {{ $categories->count() }}
                                        @endif 

                                        [@foreach($categories as $category)
                                           {{ $category->name }} ,
                                        @endforeach]
                                      </h5>
                                    </a>
                                  </div>
                                  <div id="performance-line-legend"></div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6 col-lg-6 grid-margin">
                            <div class="card card-rounded bg-success text-light">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                   <h4 class="card-title card-title-dash text-light">Clients</h4>
                                    <a href="{{ route('client.index')}}" style="text-decoration:none">
                                      <h5 class="card-subtitle card-subtitle-dash text-light">
                                        @if($clients)
                                          {{ $clients->count() }}
                                        @endif
                                      </h5>
                                    </a>
                                  </div>
                                  <div id="performance-line-legend"></div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6 col-lg-6 grid-margin">
                            <div class="card card-rounded bg-warning">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                  <h4 class="card-title card-title-dash text-light">Bonus</h4>
                                  <a href="{{ route('bonus.index')}}" style="text-decoration:none">
                                    <h5 class="card-subtitle card-subtitle-dash text-light">
                                      @if($bonus)
                                        {{ $bonus->count() . ' Aujourd\'hui' }}
                                      @endif
                                    </h5>
                                  </a>
                                  </div>
                                  <div id="performance-line-legend"></div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6 col-lg-6 grid-margin">
                            <div class="card card-rounded bg-info text-light">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                   <h4 class="card-title card-title-dash text-light">Logistiques</h4>
                                    <a href="{{ route('logistique.index')}}" style="text-decoration:none">
                                      <h5 class="card-subtitle card-subtitle-dash text-light">
                                        @if($logistiques)
                                          {{ $logistiques->count() }}
                                        @endif
                                      </h5>
                                    </a>
                                  </div>
                                  <div id="performance-line-legend"></div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6 col-lg-6 grid-margin">
                            <div class="card card-rounded bg-primary">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                  <h4 class="card-title card-title-dash text-light">Bureaux</h4>
                                  <a href="{{ route('office.index')}}" style="text-decoration:none">
                                    <h5 class="card-subtitle card-subtitle-dash text-light">
                                      @if($offices)
                                        {{ $offices->count() }}
                                      @endif
                                    </h5>
                                  </a>
                                  </div>
                                  <div id="performance-line-legend"></div>
                                </div>
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
                                    <p class="status-summary-ight-white mb-1"></p>
                                    <h2 class="text-info">
                                      @if($users) 
                                        {{ $users->count() }} 
                                      @endif
                                    </h2>
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

                          <div class="col-md-6 col-lg-12 grid-margin">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                      <div>
                                        <h4 class="card-title card-title-dash">Utilisateurs Connectés</h4>
                                      </div>
                                    </div>
                                    @foreach($online_users as $online_user)  
                                    <div class="mt-3">
                                      <div class="wrapper d-flex align-items-center justify-content-between py-2">
                                          @if($online_user->userToken)
                                            <div class="d-flex">
                                              <img class="img-sm rounded-10" src="{{ asset($online_user->image) }}" alt="{{ $online_user->name }}">
                                              <div class="wrapper ms-3">
                                                <p class="ms-1 mb-1 fw-bold">{{ $online_user->name}}</p>
                                                <small class="text-muted mb-0">
                                                  {{ $online_user->name}}
                                                </small>
                                              </div>
                                            </div>
                                            <div class="text-muted text-small">
                                              {{ now()->setTimezone('GMT+2')->format('h:ia') }}
                                            </div>
                                          @endif
                                      </div>
                                    </div>
                                    @endforeach
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
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="vendors/progressbar.js/progressbar.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/jquery.cookie.js" type="text/javascript"></script>
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->

 


</html>

