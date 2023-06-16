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
                                            <a target="blank" href="{{ route('rapport.journal', ['month' => $month->name ]) }}" method="GET" class="dropdown-item">{{ $month->name }}</a>
                                        @endforeach                             
                                    </div>
                                </div>
                                {{-- <a href="{{ route('operation.create')}}" class="btn btn-primary text-white me-0"><i class="mdi mdi-plus-circle-outline"></i> Nouvelle Opéraprion</a> --}}
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
                                            <h4 class="card-title">Opérations Comptables Journalières [{{ $today }}]</h4>
                                        </div>
                                        <div id="performance-line-legend"></div>
                                    </div>
                                    <div>
                                        <div>
                                            @include('../partials/message')
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <br>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <td colspan="6" style="center">Vente</td>
                                                </tr>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Débit</th>
                                                    <th>Crédit</th>
                                                    <th>Intitulé de Comptes & Date & Libellé</th>
                                                    <th>Actif</th>
                                                    <th>Passif</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- sales --}}
                                                @foreach($daily_sales as $daily_sale)
                                                <tr>
                                                    @forelse($year_sale_operations as $year_sale_operation)
                                                    <td> {{ $daily_sale->sale_number }}</td>
                                                    <td><br><br> 
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_sale_operation->actif_account) }} 
                                                    </td>                                                
                                                    <td> <br><br><br><br><br><br>
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_sale_operation->passif_account) }} 
                                                    </td>
                                                    <td>
                                                        {{ $year_sale_operation->transaction->name .' Date '. $daily_sale->date_sale }} 
                                                        <hr>
                                                        {{ preg_replace('/[0-9]+/', '', $year_sale_operation->actif_account) }} 

                                                        <br><br>
                                                        {{ preg_replace('/[0-9]+/', '', $year_sale_operation->passif_account) }} 

                                                    </td>
                                                    @empty
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    @endforelse
                                                    <td>
                                                        <br><br>
                                                        {{ number_format($daily_sale->quantity * $daily_sale->price, 02) .'$' }} 
                                                    </td>
                                                    <td>
                                                        <br><br><br><br><br>
                                                        {{ number_format($daily_sale->quantity * $daily_sale->price, 02) .'$' }} 
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>   
                                            {{-- achat --}}
                                            {{-- matiere --}}
                                            <thead>
                                                <tr>
                                                    <td colspan="6" style="center">Achat matières premières</td>
                                                </tr>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Débit</th>
                                                    <th>Crédit</th>
                                                    <th>Intitulé de Comptes & Date & Libellé</th>
                                                    <th>Actif</th>
                                                    <th>Passif</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($daily_matieres as $daily_matiere)
                                                <tr>
                                                    @forelse($year_matiere_operations as $year_matiere_operation)
                                                    <td> {{ $daily_matiere->matiere_number }}</td>
                                                    <td><br><br> 
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_matiere_operation->actif_account) }} 
                                                    </td>                                                
                                                    <td> <br><br><br><br><br><br>
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_matiere_operation->passif_account) }} 
                                                    </td>
                                                    <td>
                                                        {{ $year_matiere_operation->transaction->name .' Date '. $daily_matiere->date_matiere }} 
                                                        <hr>
                                                        {{ preg_replace('/[0-9]+/', '', $year_matiere_operation->actif_account) }} 

                                                        <br><br>
                                                        {{ preg_replace('/[0-9]+/', '', $year_matiere_operation->passif_account) }} 

                                                    </td>
                                                    @empty
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    @endforelse
                                                    <td>
                                                        <br><br>
                                                        {{ number_format($daily_matiere->quantity * $daily_matiere->purchase_price, 02) .'$' }} 
                                                    </td>
                                                    <td>
                                                        <br><br><br><br><br>
                                                        {{ number_format($daily_matiere->quantity * $daily_matiere->purchase_price, 02) .'$' }} 
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>
                                            
                                            {{-- achat --}}
                                            {{-- emballage --}}
                                            <thead>
                                                <tr>
                                                    <td colspan="6" style="center">Achat d'emballages</td>
                                                </tr>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Débit</th>
                                                    <th>Crédit</th>
                                                    <th>Intitulé de Comptes & Date & Libellé</th>
                                                    <th>Actif</th>
                                                    <th>Passif</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($daily_emballages as $daily_emballage)
                                                <tr>
                                                    @forelse($year_emballage_operations as $year_emballage_operation)
                                                    <td> {{ $daily_emballage->emballage_number }}</td>
                                                    <td><br><br> 
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_emballage_operation->actif_account) }} 
                                                    </td>                                                
                                                    <td> <br><br><br><br><br><br>
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_emballage_operation->passif_account) }} 
                                                    </td>
                                                    <td>
                                                        {{ $year_emballage_operation->transaction->name .' Date '. $daily_emballage->date_emballage }} 
                                                        <hr>
                                                        {{ preg_replace('/[0-9]+/', '', $year_emballage_operation->actif_account) }} 

                                                        <br><br>
                                                        {{ preg_replace('/[0-9]+/', '', $year_emballage_operation->passif_account) }} 

                                                    </td>
                                                    @empty
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    @endforelse
                                                    <td>
                                                        <br><br>
                                                        {{ number_format($daily_emballage->quantity * $daily_emballage->purchase_price, 02) .'$' }} 
                                                    </td>
                                                    <td>
                                                        <br><br><br><br><br>
                                                        {{ number_format($daily_emballage->quantity * $daily_emballage->purchase_price, 02) .'$' }} 
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>


                                            {{-- CHARGES CAS GENERAL --}}
                                            <thead>
                                                <tr>
                                                    <td colspan="6" style="center">Autres Charges </td>
                                                </tr>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Débit</th>
                                                    <th>Crédit</th>
                                                    <th>Intitulé de Comptes & Date & Libellé</th>
                                                    <th>Actif</th>
                                                    <th>Passif</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($daily_charges as $daily_charge)
                                                <tr>
                                                    @forelse($year_charge_operations as $year_charge_operation)
                                                    <td> {{ $daily_charge->sortie_number }}</td>
                                                    <td><br><br> 
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_charge_operation->actif_account) }} 
                                                    </td>                                                
                                                    <td> <br><br><br><br><br><br>
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_charge_operation->passif_account) }} 
                                                    </td>
                                                    <td>
                                                        {{ $year_charge_operation->transaction->name .' Date '. $daily_charge->date_sortie }} 
                                                        <hr>
                                                        {{ preg_replace('/[0-9]+/', '', $year_charge_operation->actif_account) }} 

                                                        <br><br>
                                                        {{ preg_replace('/[0-9]+/', '', $year_charge_operation->passif_account) }} 

                                                    </td>
                                                    @empty
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    @endforelse
                                                    <td>
                                                        <br><br>
                                                        {{ number_format($daily_charge->montant, 02) .'$' }} 
                                                    </td>
                                                    <td>
                                                        <br><br><br><br><br>
                                                        {{ number_format($daily_charge->montant, 02) .'$' }} 
                                                    </td>

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

                    {{-- months --}}
                    <div class="tab-pane fade show" id="month" role="tabpanel" aria-labelledby="month">    
                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                        <div>
                                            <h4 class="card-title">Opérations Comptables Mensuelles [{{ date('M') }}]</h4>
                                        </div>
                                        <div id="performance-line-legend"></div>
                                    </div>
                                    <div>
                                        <div>
                                            @include('../partials/message')
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <br>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <td colspan="6" style="center">Vente</td>
                                                </tr>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Débit</th>
                                                    <th>Crédit</th>
                                                    <th>Intitulé de Comptes & Date & Libellé</th>
                                                    <th>Actif</th>
                                                    <th>Passif</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- sales --}}
                                                @foreach($month_sales as $month_sale)
                                                <tr>
                                                    @forelse($year_sale_operations as $year_sale_operation)
                                                    <td> {{ $month_sale->sale_number }}</td>
                                                    <td><br><br> 
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_sale_operation->actif_account) }} 
                                                    </td>                                                
                                                    <td> <br><br><br><br><br><br>
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_sale_operation->passif_account) }} 
                                                    </td>
                                                    <td>
                                                        {{ $year_sale_operation->transaction->name .' Date '. $month_sale->date_sale }} 
                                                        <hr>
                                                        {{ preg_replace('/[0-9]+/', '', $year_sale_operation->actif_account) }} 

                                                        <br><br>
                                                        {{ preg_replace('/[0-9]+/', '', $year_sale_operation->passif_account) }} 

                                                    </td>
                                                    @empty
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    @endforelse
                                                    <td>
                                                        <br><br>
                                                        {{ number_format($month_sale->quantity * $month_sale->price, 02) .'$' }} 
                                                    </td>
                                                    <td>
                                                        <br><br><br><br><br>
                                                        {{ number_format($month_sale->quantity * $month_sale->price, 02) .'$' }} 
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>   
                                            {{-- achat --}}
                                            {{-- matiere --}}
                                            <thead>
                                                <tr>
                                                    <td colspan="6" style="center">Achat matières premières</td>
                                                </tr>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Débit</th>
                                                    <th>Crédit</th>
                                                    <th>Intitulé de Comptes & Date & Libellé</th>
                                                    <th>Actif</th>
                                                    <th>Passif</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($month_matieres as $month_matiere)
                                                <tr>
                                                    @forelse($year_matiere_operations as $year_matiere_operation)
                                                    <td> {{ $month_matiere->matiere_number }}</td>
                                                    <td><br><br> 
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_matiere_operation->actif_account) }} 
                                                    </td>                                                
                                                    <td> <br><br><br><br><br><br>
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_matiere_operation->passif_account) }} 
                                                    </td>
                                                    <td>
                                                        {{ $year_matiere_operation->transaction->name .' Date '. $month_matiere->date_matiere }} 
                                                        <hr>
                                                        {{ preg_replace('/[0-9]+/', '', $year_matiere_operation->actif_account) }} 

                                                        <br><br>
                                                        {{ preg_replace('/[0-9]+/', '', $year_matiere_operation->passif_account) }} 

                                                    </td>
                                                    @empty
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    @endforelse
                                                    <td>
                                                        <br><br>
                                                        {{ number_format($month_matiere->quantity * $month_matiere->purchase_price, 02) .'$' }} 
                                                    </td>
                                                    <td>
                                                        <br><br><br><br><br>
                                                        {{ number_format($month_matiere->quantity * $month_matiere->purchase_price, 02) .'$' }} 
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>
                                            
                                            {{-- achat --}}
                                            {{-- emballage --}}
                                            <thead>
                                                <tr>
                                                    <td colspan="6" style="center">Achat d'emballages</td>
                                                </tr>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Débit</th>
                                                    <th>Crédit</th>
                                                    <th>Intitulé de Comptes & Date & Libellé</th>
                                                    <th>Actif</th>
                                                    <th>Passif</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($month_emballages as $month_emballage)
                                                <tr>
                                                    @forelse($year_emballage_operations as $year_emballage_operation)
                                                    <td> {{ $month_emballage->emballage_number }}</td>
                                                    <td><br><br> 
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_emballage_operation->actif_account) }} 
                                                    </td>                                                
                                                    <td> <br><br><br><br><br><br>
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_emballage_operation->passif_account) }} 
                                                    </td>
                                                    <td>
                                                        {{ $year_emballage_operation->transaction->name .' Date '. $month_emballage->date_emballage }} 
                                                        <hr>
                                                        {{ preg_replace('/[0-9]+/', '', $year_emballage_operation->actif_account) }} 

                                                        <br><br>
                                                        {{ preg_replace('/[0-9]+/', '', $year_emballage_operation->passif_account) }} 

                                                    </td>
                                                    @empty
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    @endforelse
                                                    <td>
                                                        <br><br>
                                                        {{ number_format($month_emballage->quantity * $month_emballage->purchase_price, 02) .'$' }} 
                                                    </td>
                                                    <td>
                                                        <br><br><br><br><br>
                                                        {{ number_format($month_emballage->quantity * $month_emballage->purchase_price, 02) .'$' }} 
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>


                                            {{-- CHARGES CAS GENERAL --}}
                                            <thead>
                                                <tr>
                                                    <td colspan="6" style="center">Autres Charges </td>
                                                </tr>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Débit</th>
                                                    <th>Crédit</th>
                                                    <th>Intitulé de Comptes & Date & Libellé</th>
                                                    <th>Actif</th>
                                                    <th>Passif</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($month_charges as $month_charge)
                                                <tr>
                                                    @forelse($year_charge_operations as $year_charge_operation)
                                                    <td> {{ $month_charge->sortie_number }}</td>
                                                    <td><br><br> 
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_charge_operation->actif_account) }} 
                                                    </td>                                                
                                                    <td> <br><br><br><br><br><br>
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_charge_operation->passif_account) }} 
                                                    </td>
                                                    <td>
                                                        {{ $year_charge_operation->transaction->name .' Date '. $month_charge->date_sortie }} 
                                                        <hr>
                                                        {{ preg_replace('/[0-9]+/', '', $year_charge_operation->actif_account) }} 

                                                        <br><br>
                                                        {{ preg_replace('/[0-9]+/', '', $year_charge_operation->passif_account) }} 

                                                    </td>
                                                    @empty
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    @endforelse
                                                    <td>
                                                        <br><br>
                                                        {{ number_format($month_charge->montant, 02) .'$' }} 
                                                    </td>
                                                    <td>
                                                        <br><br><br><br><br>
                                                        {{ number_format($month_charge->montant, 02) .'$' }} 
                                                    </td>

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
                                            <h4 class="card-title">Opérations Comptables annuelles [{{ $year }}]</h4>
                                        </div>
                                        <div id="performance-line-legend"></div>
                                    </div>
                                    <div>
                                        <div>
                                            @include('../partials/message')
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <br>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <td colspan="6" style="center">Vente</td>
                                                </tr>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Débit</th>
                                                    <th>Crédit</th>
                                                    <th>Intitulé de Comptes & Date & Libellé</th>
                                                    <th>Actif</th>
                                                    <th>Passif</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- sales --}}
                                                @foreach($year_sales as $year_sale)
                                                <tr>
                                                    @forelse($year_sale_operations as $year_sale_operation)
                                                    <td> {{ $year_sale->sale_number }}</td>
                                                    <td><br><br> 
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_sale_operation->actif_account) }} 
                                                    </td>                                                
                                                    <td> <br><br><br><br><br><br>
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_sale_operation->passif_account) }} 
                                                    </td>
                                                    <td>
                                                        {{ $year_sale_operation->transaction->name .' Date '. $year_sale->date_sale }} 
                                                        <hr>
                                                        {{ preg_replace('/[0-9]+/', '', $year_sale_operation->actif_account) }} 

                                                        <br><br>
                                                        {{ preg_replace('/[0-9]+/', '', $year_sale_operation->passif_account) }} 

                                                    </td>
                                                    @empty
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    @endforelse
                                                    <td>
                                                        <br><br>
                                                        {{ number_format($year_sale->quantity * $year_sale->price, 02) .'$' }} 
                                                    </td>
                                                    <td>
                                                        <br><br><br><br><br>
                                                        {{ number_format($year_sale->quantity * $year_sale->price, 02) .'$' }} 
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>   
                                            {{-- achat --}}
                                            {{-- matiere --}}
                                            <thead>
                                                <tr>
                                                    <td colspan="6" style="center">Achat matières premières</td>
                                                </tr>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Débit</th>
                                                    <th>Crédit</th>
                                                    <th>Intitulé de Comptes & Date & Libellé</th>
                                                    <th>Actif</th>
                                                    <th>Passif</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($year_matieres as $year_matiere)
                                                <tr>
                                                    @forelse($year_matiere_operations as $year_matiere_operation)
                                                    <td> {{ $year_matiere->matiere_number }}</td>
                                                    <td><br><br> 
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_matiere_operation->actif_account) }} 
                                                    </td>                                                
                                                    <td> <br><br><br><br><br><br>
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_matiere_operation->passif_account) }} 
                                                    </td>
                                                    <td>
                                                        {{ $year_matiere_operation->transaction->name .' Date '. $year_matiere->date_matiere }} 
                                                        <hr>
                                                        {{ preg_replace('/[0-9]+/', '', $year_matiere_operation->actif_account) }} 

                                                        <br><br>
                                                        {{ preg_replace('/[0-9]+/', '', $year_matiere_operation->passif_account) }} 

                                                    </td>
                                                    @empty
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    @endforelse
                                                    <td>
                                                        <br><br>
                                                        {{ number_format($year_matiere->quantity * $year_matiere->purchase_price, 02) .'$' }} 
                                                    </td>
                                                    <td>
                                                        <br><br><br><br><br>
                                                        {{ number_format($year_matiere->quantity * $year_matiere->purchase_price, 02) .'$' }} 
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>
                                            
                                            {{-- achat --}}
                                            {{-- emballage --}}
                                            <thead>
                                                <tr>
                                                    <td colspan="6" style="center">Achat d'emballages</td>
                                                </tr>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Débit</th>
                                                    <th>Crédit</th>
                                                    <th>Intitulé de Comptes & Date & Libellé</th>
                                                    <th>Actif</th>
                                                    <th>Passif</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($year_emballages as $year_emballage)
                                                <tr>
                                                    @forelse($year_emballage_operations as $year_emballage_operation)
                                                    <td> {{ $year_emballage->emballage_number }}</td>
                                                    <td><br><br> 
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_emballage_operation->actif_account) }} 
                                                    </td>                                                
                                                    <td> <br><br><br><br><br><br>
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_emballage_operation->passif_account) }} 
                                                    </td>
                                                    <td>
                                                        {{ $year_emballage_operation->transaction->name .' Date '. $year_emballage->date_emballage }} 
                                                        <hr>
                                                        {{ preg_replace('/[0-9]+/', '', $year_emballage_operation->actif_account) }} 

                                                        <br><br>
                                                        {{ preg_replace('/[0-9]+/', '', $year_emballage_operation->passif_account) }} 

                                                    </td>
                                                    @empty
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    @endforelse
                                                    <td>
                                                        <br><br>
                                                        {{ number_format($year_emballage->quantity * $year_emballage->purchase_price, 02) .'$' }} 
                                                    </td>
                                                    <td>
                                                        <br><br><br><br><br>
                                                        {{ number_format($year_emballage->quantity * $year_emballage->purchase_price, 02) .'$' }} 
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>


                                            {{-- CHARGES CAS GENERAL --}}
                                            <thead>
                                                <tr>
                                                    <td colspan="6" style="center">Autres Charges </td>
                                                </tr>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Débit</th>
                                                    <th>Crédit</th>
                                                    <th>Intitulé de Comptes & Date & Libellé</th>
                                                    <th>Actif</th>
                                                    <th>Passif</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($year_charges as $year_charge)
                                                <tr>
                                                    @forelse($year_charge_operations as $year_charge_operation)
                                                    <td> {{ $year_charge->sortie_number }}</td>
                                                    <td><br><br> 
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_charge_operation->actif_account) }} 
                                                    </td>                                                
                                                    <td> <br><br><br><br><br><br>
                                                        {{ preg_replace('/[a-zA-Zéè\'ç]+/', '', $year_charge_operation->passif_account) }} 
                                                    </td>
                                                    <td>
                                                        {{ $year_charge->libelle .' Date '. $year_charge->date_sortie }} 
                                                        <hr>
                                                        {{ preg_replace('/[0-9]+/', '', $year_charge_operation->actif_account) }} 

                                                        <br><br>
                                                        {{ preg_replace('/[0-9]+/', '', $year_charge_operation->passif_account) }} 

                                                    </td>
                                                    @empty
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    @endforelse
                                                    <td>
                                                        <br><br>
                                                        {{ number_format($year_charge->montant, 02) .'$' }} 
                                                    </td>
                                                    <td>
                                                        <br><br><br><br><br>
                                                        {{ number_format($year_charge->montant, 02) .'$' }} 
                                                    </td>

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

