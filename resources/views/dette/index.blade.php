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
                        </ul>
                        <div>
                            <div class="btn-wrapper">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-otline-dark"><i class="icon-printer"></i>Imprimer</button>
                                    <button type="button" class="btn btn-otline-dark dropdown-toggle" id="dropdownMenuSplitButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuSplitButton1">
                                        @foreach($mois as $month)
                                            <a target="blank" href="{{ route('rapport.dette', ['month' => $month->name ]) }}" method="GET" class="dropdown-item">{{ $month->name }}</a>
                                        @endforeach                             
                                    </div>
                                </div>
                                <a href="{{ route('dette.create')}}" class="btn btn-primary text-white me-0"><i class="mdi mdi-plus-circle-outline"></i> Nouvelle dette</a>
                            </div>
                        </div>
                    </div>
                
                <div class="tab-content tab-content-basic">
                  
                    {{-- daily --}}
                <div class="tab-pane fade show" id="daily" role="tabpanel" aria-labelledby="daily"> 
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title">Liste de Dettes Journalières [{{ $today }}]</h4>
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
                                                <th>production</th> 
                                                <th>Quantité</th>
                                                <th>Montant</th>
                                                <th>Reste</th>
                                                <th>Montant Payé</th>
                                                <th>Déscription</th>
                                                <th>Date</th>
                                                <th>Nom Du Client</th>
                                                <th>Numéro de Tél</th>
                                                <th>Adresse</th>
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
                                                <td>{{ $daily->dette_number}}</td>
                                                <td>
                                                    @if($daily->production->emballages)
                                                        @foreach($daily->production->emballages as $production_emb)
                                                            @if($production_emb->type_emballage)
                                                                {{ $production_emb->type_emballage->name }}
                                                            @endif
                                                        @endforeach
                                                    @endif                                                    
                                                </td>
                                                <td> 
                                                    {{ $daily->quantity }}
                                                    @if($daily->production)
                                                        @if($daily->production->unit)
                                                            {{ $daily->production->unit->name}}
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="text-danger">{{  number_format($daily->montant, 02) .'$' }}</td>
                                                <td class="text-danger">{{  number_format($daily->montant_paye, 02) .'$' }}</td>
                                                <td class="text-danger">{{  number_format($daily->montant - $daily->montant_paye , 02) .'$' }}</td>

                                                <td> {{ $daily->description }}</td>
                                                <td >{{ $daily->date_dette }}</td>
                                                <td >
                                                    @if($daily->client)
                                                        {{ $daily->client->name}}
                                                    @endif
                                                </td>
                                                <td >
                                                    @if($daily->client)
                                                        {{ $daily->client->tel}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($daily->client)
                                                        {{ $daily->client->address}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(Auth()->check())
                                                        @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Financier')
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                {{--  payement  --}}
                                                                <a href="{{ route('dette_pay_create', ['dette' => $daily->id]) }}" _method="GET" >
                                                                    Paiement
                                                                </a>
                                                            </div>  
                                                           
                                                            <div class="col-lg-6">
                                                                {{-- delete --}}
                                                                <form action="{{ route('dette.destroy', ['dette' => $daily->id ]  ) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette dette?');">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <button type="submit" style="border:none; background: none" title="Supprimez cette dette" > <i class="mdi mdi-delete-forever text-danger"></i></button>
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
                                                <td colspan="3">
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

                {{-- month --}}
                <div class="tab-pane fade show" id="month" role="tabpanel" aria-labelledby="month"> 
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title">Liste de Dettes Mensuelles [{{ date('M') }}]</h4>
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
                                                <th>production</th> 
                                                <th>Quantité</th>
                                                <th>Montant</th>
                                                <th>Montant Payé</th>
                                                <th>Reste</th>
                                                <th>Déscription</th>
                                                <th>Date</th>
                                                <th>Nom Du Client</th>
                                                <th>Numéro de Tél</th>
                                                <th>Adresse</th>
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
                                                <td>{{ $month->dette_number}}</td>
                                                <td>
                                                    @if($month->production)
                                                        @if($month->production->emballages)
                                                            @foreach($month->production->emballages as $production_emb)
                                                                @if($production_emb->type_emballage)
                                                                    {{ $production_emb->type_emballage->name }}
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endif                                                    

                                                </td>
                                                <td>
                                                    {{ $month->quantity }}
                                                    @if($month->production)
                                                        @if($month->production->unit)
                                                            {{ $month->production->unit->name}}
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="text-danger">{{  number_format($month->montant, 02) .'$' }}</td>
                                                <td class="text-danger">{{  number_format($month->montant_paye, 02) .'$' }}</td>
                                                <td class="text-danger">{{  number_format($month->montant - $month->montant_paye , 02) .'$' }}</td>

                                                <td> {{ $month->description }}</td>
                                                <td >{{ $month->date_dette }}</td>
                                                <td >
                                                    @if($month->client)
                                                        {{ $month->client->name}}
                                                    @endif
                                                </td>
                                                <td >
                                                    @if($month->client)
                                                        {{ $month->client->tel}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($month->client)
                                                        {{ $month->client->address}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(Auth()->check())
                                                        @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Financier')
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                {{--  payement  --}}
                                                                <a href="{{ route('dette_pay_create', ['dette' => $month->id]) }}" _method="GET" >
                                                                    Paiement
                                                                </a>
                                                            </div>  
                                                           
                                                            <div class="col-lg-6">
                                                                {{-- delete --}}
                                                                <form action="{{ route('dette.destroy', ['dette' => $month->id ]  ) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette dette?');">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <button type="submit" style="border:none; background: none" title="Supprimez cette dette" > <i class="mdi mdi-delete-forever text-danger"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    @endif

                                                </td>
                                            </tr>

                                            <?php  $total = $total + ( $month->montant); ?>
                                            @endforeach
                                            <tr>
                                                <td colspan="3">
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

                {{-- year --}}
                <div class="tab-pane fade show active" id="year" role="tabpanel" aria-labelledby="month"> 
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="card-title">Liste de Dettes Annuelles [{{ $year }}]</h4>
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
                                                <th>production</th> 
                                                <th>Quantité</th>
                                                <th>Montant</th>
                                                <th>Montant Payé</th>
                                                <th>Reste</th>
                                                <th>Déscription</th>
                                                <th>Date</th>
                                                <th>Nom Du Client</th>
                                                <th>Numéro de Tél</th>
                                                <th>Adresse</th>
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
                                                <td>{{ $year->dette_number}}</td>
                                                <td>
                                                    @if($year->production)
                                                        @if($year->production->emballages)
                                                            @foreach($year->production->emballages as $production_emb)
                                                                @if($production_emb->type_emballage)
                                                                    {{ $production_emb->type_emballage->name }}
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endif                                                    

                                                </td>
                                                <td> 
                                                    {{ $year->quantity }}
                                                    @if($year->production)
                                                        @if($year->production->unit)
                                                            {{ $year->production->unit->name}}
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="text-danger">{{  number_format($year->montant, 02) .'$' }}</td>
                                                <td class="text-danger">{{  number_format($year->montant_paye, 02) .'$' }}</td>
                                                <td class="text-danger">{{  number_format($year->montant - $year->montant_paye , 02) .'$' }}</td>
                                                <td> {{ $year->description }}</td>
                                                <td >{{ $year->date_dette }}</td>
                                                <td >
                                                    @if($year->client)
                                                        {{ $year->client->name}}
                                                    @endif
                                                </td>
                                                <td >
                                                    @if($year->client)
                                                        {{ $year->client->tel}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($year->client)
                                                        {{ $year->client->address}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(Auth()->check())
                                                        @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Financier')
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                {{--  payement  --}}
                                                                <a href="{{ route('dette_pay_create', ['dette' => $year->id]) }}" _method="GET" >
                                                                    Paiement
                                                                </a>
                                                            </div>  
                                                           
                                                            <div class="col-lg-6">
                                                                {{-- delete --}}
                                                                <form action="{{ route('dette.destroy', ['dette' => $year->id ]  ) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette dette?');">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <button type="submit" style="border:none; background: none" title="Supprimez cette dette" > <i class="mdi mdi-delete-forever text-danger"></i></button>
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
                                                <td colspan="3">
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

