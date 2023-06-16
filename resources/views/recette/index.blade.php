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
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#month" role="tab" aria-selected="false">Mensuelles [{{ date('M') }}]</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active ps-0" id="contact-tab" data-bs-toggle="tab" href="#year" role="tab" aria-controls="year" aria-selected="true">Annuelles [{{ $year }}]</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#recette_list" role="tab" aria-controls="recette_list" aria-selected="flse">Autres recettes</a>
                            </li>
                        </ul>
                        <div>
                            <div class="btn-wrapper">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-otline-dark"><i class="icon-printer"></i>Imprimer</button>
                                    <button type="button" class="btn btn-otline-dark dropdown-toggle" id="dropdownMenuSplitButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuSplitButton1">
                                        @foreach($mois as $month)
                                            <a target="blank" href="{{ route('rapport.recette', ['month' => $month->name ]) }}" method="GET" class="dropdown-item">{{ $month->name }}</a>
                                        @endforeach                             
                                    </div>
                                  </div>
                                <a href="{{ route('autre_recette.create')}}" class="btn btn-primary text-white me-0"><i class="mdi mdi-plus-circle-outline"></i> Nouvelle Recette</a>
                            </div>
                        </div>
                    </div>
                
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show" id="daily" role="tabpanel" aria-labelledby="daily"> 
                     
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title">Liste de Recettes Journalières [{{ $today }}]</h4>
                                    </div>
                                    <div id="performance-line-legend"></div>
                                    
                                    <div>
                                        {{-- <a href="{{ route('sortie.create')}}" class="btn btn-primary btn-lg text-white mb-0 me-0"><i class="mdi mdi-plus-circle-outline"></i>Nouvelle sortie</a> --}}
                                    </div>
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
                                                <th>Libellé</th>
                                                <th>Prix</th>
                                                <th>Qunatité</th>
                                                <th>Montant</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                        <?php $total = 0; ?>  
                                        @foreach($dailys as $daily)
                                            <tr>
                                                <td>{{ $daily->sale_number}}</td>
                                                <td>{{ 'Vente numéro '. $daily->sale_number }}</td>
                                                <td>{{ $daily->price }}</td>
                                                <td>
                                                    {{ $daily->quantity }} 
                                                </td>
                                                <td class="text-danger">{{  number_format($daily->price * $daily->quantity, 02) .'$' }}</td>
                                                <td >{{ $daily->date_sale }}</td>
                                                <td >{{ $daily->description}}</td>
                                        
                                            </tr>
                                            <?php  $total = $total + ( $daily->price * $daily->quantity); ?>
                                        @endforeach
                                        <tr>
                                          <td colspan="4">
                                            Total 
                                          </td>
                                          <td colspan="3"> <div class="badge badge-opacity-warning"><b><?= number_format($total, 02) .'$' ?></b></div> </td>

                                        </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                    
                    </div>
                    
                  </div>

                  <div class="tab-pane fade show" id="month" role="tabpanel" aria-labelledby="month"> 
                     
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title">Liste de Recettes Mensuelles [{{ date('M') }}]</h4>
                                    </div>
                                    <div id="performance-line-legend"></div>
                                    
                                    <div>
                                        {{-- <a href="{{ route('sortie.create')}}" class="btn btn-primary btn-lg text-white mb-0 me-0"><i class="mdi mdi-plus-circle-outline"></i>Nouvelle Charge</a> --}}
                                    </div>
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
                                                <th>Libellé</th>
                                                <th>Prix</th>
                                                <th>Qunatité</th>
                                                <th>Montant</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                        <?php $total = 0 ;?>
                                        @foreach($months as $month)
                                        <tr>
                                            <td>{{ $month->sale_number}}</td>
                                            <td>{{ 'Vente numéro '. $month->sale_number}}</td>
                                            <td>{{ $month->price }}</td>
                                            <td>
                                                {{ $month->quantity }} 
                                            </td>
                                            <td class="text-danger">{{  number_format($month->price * $month->quantity, 02) .'$' }}</td>
                                            <td >{{ $month->date_sale }}</td>
                                
                                            <?php  $total = $total + ( $month->price * $month->quantity); ?>
                                        <tr>
                                        @endforeach
                                            <td colspan="2">
                                                Total 
                                            </td>
                                            <td colspan="3"> <div class="badge badge-opacity-warning"><b><?= number_format($total, 02) .'$' ?></b></div> </td>
                                        </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                    
                    </div>
                    
                  </div>

                  <div class="tab-pane fade show active" id="year" role="tabpanel" aria-labelledby="year"> 
                     
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title">Liste de Recettes Annuelles [{{ $year }}]</h4>
                                    </div>
                                    <div id="performance-line-legend"></div>
                                    
                                    <div>
                                        {{-- <a href="{{ route('sortie.create')}}" class="btn btn-primary btn-lg text-white mb-0 me-0"><i class="mdi mdi-plus-circle-outline"></i>Nouvelle Charge</a> --}}
                                    </div>
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
                                                <th>Libellé</th>
                                                <th>Prix</th>
                                                <th>Qunatité</th>
                                                <th>Montant</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                        <?php $total = 0 ;?>
                                        @foreach($years as $year)
                                            <tr>
                                                <td>{{ $year->sale_number}}</td>
                                                <td>{{ 'Vente numéro '. $year->sale_number}}</td>
                                                <td>{{ $year->price .'$'}}</td>
                                                <td>
                                                    {{ $year->quantity }} 
                                                </td>
                                                <td class="text-danger">{{  number_format($year->price * $year->quantity, 02) .'$' }}</td>

                                                <td >{{ $year->date_sale }}</td>
                                        
                                                <?php  $total = $total + ( $year->price * $year->quantity); ?>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2">
                                                Total 
                                            </td>
                                            <td colspan="3"> <div class="badge badge-opacity-warning"><b><?= number_format($total, 02) .'$' ?></b></div> </td>
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


                  <div class="tab-pane fade show" id="recette_list" role="tabpanel" aria-labelledby="recette_list"> 
                     
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title">Autres Recettes</h4>
                                    </div>
                                    <div id="performance-line-legend"></div>
                                    
                                    <div>
                                        {{-- <a href="{{ route('sortie.create')}}" class="btn btn-primary btn-lg text-white mb-0 me-0"><i class="mdi mdi-plus-circle-outline"></i>Nouvelle Charge</a> --}}
                                    </div>
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
                                                <th>Libellé</th>
                                                <th>Montant</th>
                                                <th>Déscription</th>
                                                <th>Date</th>
                                                @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Financier')
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                    <tbody>
                                        <?php $total = 0 ;?>
                                        @foreach($recettes as $recette)
                                            <tr>
                                                <td>{{ $recette->recette_number}}</td>
                                                <td>
                                                  @if($recette->type_recette)
                                                    {{ $recette->type_recette->name}}
                                                  @endif
                                                </td>
                                                <td class="text-danger">{{  number_format($recette->montant, 02) .'$' }}</td>
                                                <th> {{ $recette->description}}</th>
                                                <td >{{ $recette->date_creation }}</td>
                                                
                                                <td>
                                                  @if(Auth()->check())
                                                  @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Financier')
                                                      <div class="row">
                                                          <div class="col-lg-6">
                                                              {{--  edit  --}}
                                                              <a href="{{ route('autre_recette.edit', ['autre_recette' => $recette->id]) }}" _method="GET" 
                                                                  onClick="return confirm('Voulez-vous vraiment modifier cette recette ?');" title="Modifier cette recette"> 
                                                                  <i class="mdi mdi-pencil text-info"></i>
                                                              </a>
                                                          </div>  
                                                          <div class="col-lg-6">
                                                              {{-- delete --}}
                                                              <form action="{{ route('autre_recette.destroy', ['autre_recette' => $recette->id ]  ) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette recette?');">
                                                                  {{ csrf_field() }}
                                                                  {{ method_field('DELETE') }}
                                                                  <button type="submit" style="border:none; background: none" title="Supprimez cette recette " > <i class="mdi mdi-delete-forever text-danger"></i></button>
                                                              </form>
                                                          </div>
                                                      </div>
                                                      @endif
                                                  @endif
    
                                                </td>

                                                <?php  $total = $total + ( $recette->montant); ?>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2">
                                                Total 
                                            </td>
                                            <td colspan="3"> <div class="badge badge-opacity-warning"><b><?= number_format($total, 02) .'$' ?></b></div> </td>
                                            
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

