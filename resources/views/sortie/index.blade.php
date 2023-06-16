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
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#month" role="tab" aria-selected="false">Mensuelles [{{ $month }}]</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active ps-0" id="contact-tab" data-bs-toggle="tab" href="#year" role="tab" aria-controls="year" aria-selected="true">Annuelles [{{ $year }}]</a>
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
                                            <a target="blank" href="{{ route('rapport.sortie', ['month' => $month->name ]) }}" method="GET" class="dropdown-item">{{ $month->name }}</a>
                                        @endforeach                             
                                    </div>
                                </div>
                                <a href="{{ route('sortie.create')}}" class="btn btn-primary text-white me-0"><i class="mdi mdi-plus-circle-outline"></i> Nouvelle Charge</a>
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
                                        <h4 class="card-title">Liste de Charges Journalières [{{ $today }}]</h4>
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
                                                <th>Libellé/Déescription</th>
                                                <th>Montant</th>
                                                <th>Date</th>
                                                @if(Auth()->check())
                                                    @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Financier')
                                                        <th>Action</th>
                                                    @endif
                                                @endif
                                            </tr>
                                        </thead>
                                    <tbody>
                                        <?php $total = 0; ?>
                                        @foreach($dailys as $daily)
                                        <tr>
                                            <td>{{ $daily->sortie_number}}</td>
                                            <td>{{$daily->libelle}} ({{ $daily->description }})</td>
                                            <td class="text-danger">{{  number_format($daily->montant, 02) .'$' }}</td>
                                            <td >{{ $daily->date_sortie }}</td>
                                    
                                            <td>
                                                @if(Auth()->check())
                                                    @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Financier')
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            {{--  edit  --}}
                                                            <a href="{{ route('sortie.edit', ['sortie' => $daily->id]) }}" _method="GET" 
                                                                onClick="return confirm('Voulez-vous vraiment modifier cette charge?');" title="Modifier cette charge"> 
                                                                <i class="mdi mdi-pencil text-info"></i>
                                                            </a>
                                                        </div>  
                                                        <div class="col-lg-6">
                                                            {{-- delete --}}
                                                            <form action="{{ route('sortie.destroy', ['sortie' => $daily->id ]  ) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette charge?');">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <button type="submit" style="border:none; background: none" title="Supprimez cette charge" > <i class="mdi mdi-delete-forever text-danger"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endif

                                            </td>
                                        </tr>

                                        <?php  $total = $total + ( $daily->montant); ?>
                                        @endforeach
                                        <tr>
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

                  <div class="tab-pane fade show" id="month" role="tabpanel" aria-labelledby="month"> 
                     
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title">Liste de Charges Mensuelles [{{ date('M') }}]</h4>
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
                                                <th>Libellé/Déscription</th>
                                                <th>Montant</th>
                                                <th>Date</th>
                                                
                                                @if(Auth()->check())
                                                    @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Financier')
                                                        <th>Action</th>
                                                    @endif
                                                @endif
                                            </tr>
                                        </thead>
                                    <tbody>
                                        <?php $total = 0; ?>
                                        @foreach($months as $month)
                                        <tr>
                                            <td>{{ $month->sortie_number}}</td>
                                            <td>{{$month->libelle}} ({{ $month->description }})</td>
                                            <td class="text-danger">{{  number_format($month->montant, 02) .'$' }}</td>
                                            <td >{{ $month->date_sortie }}</td>
                                    
                                            <td>
                                                @if(Auth()->check())
                                                    @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Financier')
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            {{--  edit  --}}
                                                            <a href="{{ route('sortie.edit', ['sortie' => $month->id]) }}" _method="GET" 
                                                                onClick="return confirm('Voulez-vous vraiment modifier cette charge?');" title="Modifier cette charge"> 
                                                                <i class="mdi mdi-pencil text-info"></i>
                                                            </a>
                                                        </div>  
                                                        <div class="col-lg-6">
                                                            {{-- delete --}}
                                                            <form action="{{ route('sortie.destroy', ['sortie' => $month->id ]  ) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette charge?');">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <button type="submit" style="border:none; background: none" title="Supprimez cette charge" > <i class="mdi mdi-delete-forever text-danger"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endif

                                            <td></td>
                                        </tr>

                                        <?php  $total = $total + ( $month->montant); ?>
                                        @endforeach
                                        <tr>
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

                  <div class="tab-pane fade show active" id="year" role="tabpanel" aria-labelledby="month"> 
                     
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title">Liste de Charges Annuelles [{{ $year }}]</h4>
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
                                                <th>Libellé/Déescription</th>
                                                <th>Montant</th>
                                                <th>Date</th>
                                                @if(Auth()->check())
                                                    @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Financier')
                                                        <th>Action</th>
                                                    @endif
                                                @endif
                                            </tr>
                                        </thead>
                                    <tbody>
                                        <?php $total = 0; ?>
                                        @foreach($years as $year)
                                        <tr>
                                            <td>{{ $year->sortie_number}}</td>
                                            <td>{{ $year->libelle}} ({{ $year->description }})</td>
                                            <td class="text-danger">{{  number_format($year->montant, 02) .'$' }}</td>
                                            <td >{{ $year->date_sortie }}</td>
                                    
                                            <td>
                                                @if(Auth()->check())
                                                    @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Financier')
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            {{--  edit  --}}
                                                            <a href="{{ route('sortie.edit', ['sortie' => $year->id]) }}" _method="GET" 
                                                                onClick="return confirm('Voulez-vous vraiment modifier cette charge?');" title="Modifier cette charge"> 
                                                                <i class="mdi mdi-pencil text-info"></i>
                                                            </a>
                                                        </div>  
                                                        <div class="col-lg-6">
                                                            {{-- delete --}}
                                                            <form action="{{ route('sortie.destroy', ['sortie' => $year->id ]  ) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette charge?');">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <button type="submit" style="border:none; background: none" title="Supprimez cette charge" > <i class="mdi mdi-delete-forever text-danger"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <?php  $total = $total + ( $year->montant); ?>
                                        @endforeach
                                        <tr>
                                            <td colspan="2">
                                                Total 
                                            </td>
                                            <td colspan="3"> <div class="badge badge-opacity-warning"><b><?= number_format($total, 02) .'$' ?></b></div> </td>
                                        </tr>

                                        <br>
                                        {{ $years->links('vendor.pagination.bootstrap-5') }}
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

