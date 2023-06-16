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
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#month" role="tab" aria-selected="false">Mensuelles [{{ $monthly }}]</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active ps-0" id="contact-tab" data-bs-toggle="tab" href="#year" role="tab" aria-controls="year" aria-selected="true">Annuelles [{{ $yearly }}]</a>
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
                                        <a target="blank" href="{{ route('rapport.production', ['month' => $month->name ]) }}" method="GET" class="dropdown-item">{{ $month->name }}</a>
                                    @endforeach                             
                                </div>
                            </div>

                            <a href="{{ route('production.create')}}" class="btn btn-primary text-white me-0"><i class="mdi mdi-plus-circle-outline"></i> Nouvelle production</a>
                        </div>
                    </div>
                </div>
                
                <div class="tab-content tab-content-basic">
                    {{-- Daily--}}
                    <div class="tab-pane fade show" id="daily" role="tabpanel" aria-labelledby="daily"> 
                        
                        <div class="row">
                        
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                    
                                        <div>
                                            <h4 class="card-title">Liste de productions journalières [{{ $today }}]</h4>
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
                                                    <th>Prix de vente</th>
                                                    <th>Cout de production</th>
                                                    <th>Matière première</th>
                                                    <th>Emballage</th>
                                                    <th>Date</th>

                                                    @if(Auth()->check())
                                                        @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Producteur')
                                                            <th>Action</th>
                                                        @endif
                                                    @endif
                                                </tr>
                                            </thead>
                                        <tbody>
                                            @foreach($dailys as $daily)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('production.show', $daily)}}" style="text-decoration:none" title="Voir le detail production">
                                                        {{ $daily->number }}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if($daily->category)
                                                        <div class="badge badge-opacity-warning">{{$daily->category->name}}</div>
                                                    @endif
                                                </td>
                                                
                                                <td>{{ $daily->quantity }}  
                                                    @if($daily->unit)
                                                        {{ $daily->unit->name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($daily->emballage)
                                                    @if($daily->emballage->type_emballage)
                                                        @foreach($daily->emballage->type_emballage->price_config as $config_price)
                                                            <div class="text-danger mt-2">
                                                                {{ 'Qté: ' . $config_price->quantity_min . 'Pc ' . $config_price->quantity_max.'Pc ' }}
                                                                <div class="badge badge-opacity-warning">
                                                                    {{ 'Prix: '. $config_price->price .'$'}}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    @endif

                                                </td>

                                                <td class="text-danger">
                                                    <?php //calcul du cout de production
                                                        $cout_productions = DB::table('cout_productions')->where('production_number', $daily->number)->get();
                                                        if(!empty($cout_productions['0'])){?>
                                                        <div class="badge badge-opacity-warning">
                                                            {{ number_format($cout_productions['0']->{'montant'}, 02) .'$' }}
                                                        </div>                                                    
                                                    <?php } ?>
                                                </td>
                                                
                                                <td>
                                                    {{-- matiere --}}
                                                    @if($daily->matieres)
                                                    @if(count($daily->matieres) >= 1)
                                                        @foreach($daily->matieres as $daily_prod_matiere)
                                                            {{ $daily_prod_matiere->name }} 
                                                        @endforeach
                                                        <?php 
                                                            $matiere_quantities = DB::table('production_matiere_quantities')->where('production_id', $daily->id)
                                                                                        ->get(['matiere_quantity', 'unit']); 
                                                            foreach($matiere_quantities as $matiere_quantity){
                                                                echo '[ '.  $matiere_quantity->{'matiere_quantity'} . ' ' . $matiere_quantity->{'unit'} .' ]';
                                                            }
                                                        ?>
                                                    @else
                                                        <span class="text-danger"> {{ 'Aucune matière première Attribuée'}}</span>
                                                    @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($daily->emballage)
                                                        @if($daily->emballage->type_emballage)
                                                            {{ $daily->emballage->type_emballage->name }}
                                                        @endif
                                                    @endif
                                                </td>
                                                
                                                <td>{{ $daily->created_at->format('d-M-Y') }}</td>
                                                <td>
                                                    @if(Auth()->check())
                                                        @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Producteur')
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <a href="{{ route('production.show', $daily)}}" title="Voir la production">
                                                                    <i class="mdi mdi-eye"></i> 
                                                                </a>
                                                            </div>
                                                            
                                                            <div class="col-lg-3">
                                                                {{-- delete --}}
                                                                <form action="{{ route('production.destroy', ['production' => $daily->id ]  ) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette production?');">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <button type="submit" style="border:none; background: none" title="Supprimez cette production" > <i class="mdi mdi-delete-forever text-danger"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    @endif

                                                <td></td>
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

                    {{-- Month--}}
                    <div class="tab-pane fade show" id="month" role="tabpanel" aria-labelledby="month"> 
                        
                        <div class="row">
                        
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                    
                                        <div>
                                            <h4 class="card-title">Liste de productions Mensuelles [{{ $monthly }}]</h4>
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
                                                    <th>Prix de vente</th>
                                                    <th>Cout de production</th>
                                                    <th>Matière première</th>
                                                    <th>Emballage</th>
                                                    <th>Date</th>

                                                    @if(Auth()->check())
                                                        @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Producteur')
                                                            <th>Action</th>
                                                        @endif
                                                    @endif
                                                </tr>
                                            </thead>
                                        <tbody>
                                            @foreach($months as $month)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('production.show', $month)}}" style="text-decoration:none" title="Voir le detail production">
                                                        {{ $month->number }}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if($month->category)
                                                        <div class="badge badge-opacity-warning">{{$month->category->name}}</div>
                                                    @endif
                                                </td>
                                                
                                                <td>{{ $month->quantity }}  
                                                    @if($month->unit)
                                                        {{ $month->unit->name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($month->emballage)
                                                    @if($month->emballage->type_emballage)
                                                        @foreach($month->emballage->type_emballage->price_config as $config_price)
                                                            <div class="text-danger mt-2">
                                                                {{ 'Qté: ' . $config_price->quantity_min . 'Pc ' . $config_price->quantity_max.'Pc ' }}
                                                                <div class="badge badge-opacity-warning">
                                                                    {{ 'Prix: '. $config_price->price .'$'}}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    @endif
                                                </td>

                                                <td class="text-danger">
                                                    <?php //calcul du cout de production
                                                        $cout_productions = DB::table('cout_productions')->where('production_number', $month->number)->get();
                                                        if(!empty($cout_productions['0'])){?>
                                                        <div class="badge badge-opacity-warning">
                                                            {{ number_format($cout_productions['0']->{'montant'}, 02) .'$' }}
                                                        </div>                                                    
                                                    <?php } ?>
                                                </td>
                                                
                                                <td>
                                                    {{-- matiere --}}
                                                    @if($month->matieres)
                                                    @if(count($month->matieres) >= 1)
                                                        @foreach($month->matieres as $month_prod_matiere)
                                                            {{ $month_prod_matiere->name }} 
                                                        @endforeach
                                                        <?php 
                                                            $matiere_quantities = DB::table('production_matiere_quantities')->where('production_id', $month->id)
                                                                                        ->get(['matiere_quantity', 'unit']); 
                                                            foreach($matiere_quantities as $matiere_quantity){
                                                                echo '[ '.  $matiere_quantity->{'matiere_quantity'} . ' ' . $matiere_quantity->{'unit'} .' ]';
                                                            }
                                                        ?>
                                                    @else
                                                        <span class="text-danger"> {{ 'Aucune matière première Attribuée'}}</span>
                                                    @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($month->emballage)
                                                        @if($month->emballage->type_emballage)
                                                            {{ $month->emballage->type_emballage->name }}
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>{{ $month->created_at->format('d-M-Y') }}</td>
                                                <td>
                                                    @if(Auth()->check())
                                                        @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Producteur')
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <a href="{{ route('production.show', $month)}}" title="Voir la production">
                                                                    <i class="mdi mdi-eye"></i> 
                                                                </a>
                                                            </div>
                                                           
                                                            <div class="col-lg-3">
                                                                {{-- delete --}}
                                                                <form action="{{ route('production.destroy', ['production' => $month->id ]  ) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette production?');">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <button type="submit" style="border:none; background: none" title="Supprimez cette production" > <i class="mdi mdi-delete-forever text-danger"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    @endif

                                                <td></td>
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

                    {{-- Years --}}
                    <div class="tab-pane fade show active" id="year" role="tabpanel" aria-labelledby="year"> 
                        
                        <div class="row">
                        
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                    
                                        <div>
                                            <h4 class="card-title">Liste de productions Annuelles [{{ $yearly }}]</h4>
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
                                                    <th>Prix de vente</th>
                                                    <th>Cout de production</th>
                                                    <th>Matière première</th>
                                                    <th>Emballage</th>
                                                    <th>Date</th>

                                                    @if(Auth()->check())
                                                        @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Producteur')
                                                            <th>Action</th>
                                                        @endif
                                                    @endif
                                                </tr>
                                            </thead>
                                        <tbody>
                                            @foreach($years as $year)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('production.show', $year)}}" style="text-decoration:none" title="Voir le detail production">
                                                        {{ $year->number }}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if($year->category)
                                                        <div class="badge badge-opacity-warning">{{$year->category->name}}</div>
                                                    @endif
                                                </td>
                                                
                                                <td>{{ $year->quantity }}  
                                                    @if($year->unit)
                                                        {{ $year->unit->name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($year->emballage)
                                                    @if($year->emballage->type_emballage)
                                                        @foreach($year->emballage->type_emballage->price_config as $config_price)
                                                            <div class="text-danger mt-2">
                                                                {{ 'Qté: ' . $config_price->quantity_min . 'Pc ' . $config_price->quantity_max.'Pc ' }}
                                                                <div class="badge badge-opacity-warning">
                                                                    {{ 'Prix: '. $config_price->price .'$'}}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    @endif
                                                </td>

                                                
                                                <td class="text-danger">
                                                    <?php //calcul du cout de production
                                                        $cout_productions = DB::table('cout_productions')->where('production_number', $year->number)->get();
                                                        if(!empty($cout_productions['0'])){?>
                                                        <div class="badge badge-opacity-warning">
                                                            {{ number_format($cout_productions['0']->{'montant'}, 02) .'$' }}
                                                        </div>                                                    
                                                    <?php } ?>
                                                </td>
                                                
                                                <td>
                                                    {{-- matiere --}}
                                                    @if($year->matieres)
                                                    @if(count($year->matieres) >= 1)
                                                        @foreach($year->matieres as $year_prod_matiere)
                                                            {{ $year_prod_matiere->name }} 
                                                        @endforeach
                                                        <?php 
                                                            $matiere_quantities = DB::table('production_matiere_quantities')->where('production_id', $year->id)
                                                                                        ->get(['matiere_quantity', 'unit']); 
                                                            foreach($matiere_quantities as $matiere_quantity){
                                                                echo '[ '.  $matiere_quantity->{'matiere_quantity'} . ' ' . $matiere_quantity->{'unit'} .' ]';
                                                            }
                                                        ?>
                                                    @else
                                                        <span class="text-danger"> {{ 'Aucune matière première Attribuée'}}</span>
                                                    @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($year->emballage)
                                                        @if($year->emballage->type_emballage)
                                                            {{ $year->emballage->type_emballage->name }}
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>{{ $year->created_at->format('d-M-Y') }}</td>
                                                <td>
                                                    @if(Auth()->check())
                                                         @if(Auth::user()->userType->name == 'Administrateur' OR Auth::user()->userType->name == 'Producteur')
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <a href="{{ route('production.show', $year)}}" title="Voir la production">
                                                                    <i class="mdi mdi-eye"></i> 
                                                                </a>
                                                            </div>
                                                            
                                                            <div class="col-lg-3">
                                                                {{-- delete --}}
                                                                <form action="{{ route('production.destroy', ['production' => $year->id ]  ) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette production?');">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <button type="submit" style="border:none; background: none" title="Supprimez cette production" > <i class="mdi mdi-delete-forever text-danger"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    @endif

                                                <td></td>
                                            </tr>
                                            @endforeach
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

