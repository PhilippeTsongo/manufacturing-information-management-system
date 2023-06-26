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
                            {{-- <li class="nav-item">
                                <a class="nav-link" id="home-tab" data-bs-toggle="tab" href="#daily" role="tab" aria-selected="false">Aujourd'hui [{{ $today }}]</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#month" role="tab" aria-selected="false">{{ GoogleTranslate::trans('Mensuelles', $appLocale)}} [{{ $month }}]</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active ps-0" id="contact-tab" data-bs-toggle="tab" href="#year" role="tab" aria-controls="year" aria-selected="true">{{ GoogleTranslate::trans('Annuelles', $appLocale)}} [{{ $year }}]</a>
                            </li>
                        </ul>
                        <div>
                            <div class="btn-wrapper">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-otline-dark"><i class="icon-printer"></i>{{ GoogleTranslate::trans('Imprimer', $appLocale)}}</button>
                                    <button type="button" class="btn btn-otline-dark dropdown-toggle" id="dropdownMenuSplitButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuSplitButton1">
                                        @foreach($mois as $month)
                                            <a target="blank" href="{{ route('rapport.grand.livre', ['month' => $month->name ]) }}" method="GET" class="dropdown-item">{{ $month->name }}</a>
                                        @endforeach                             
                                    </div>
                                </div>
                                {{-- <a href="{{ route('operation.create')}}" class="btn btn-primary text-white me-0"><i class="mdi mdi-plus-circle-outline"></i> Nouvelle Opéraprion</a> --}}
                            </div>
                        </div>
                    </div>
                
                <div class="tab-content tab-content-basic">
                    
                    {{-- months --}}
                    <div class="tab-pane fade show" id="month" role="tabpanel" aria-labelledby="month">    
                        <div class="row">
                        
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                        <div>
                                            <h4 class="card-title">{{ GoogleTranslate::trans('Grand Livre Mensuel', $appLocale)}} [{{ date('M') }}]</h4>
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
                                                    <td colspan="6" style="center">{{ GoogleTranslate::trans('Vente', $appLocale)}}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ GoogleTranslate::trans('Compte', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Débit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Crédit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Compte', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Débit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Crédit', $appLocale)}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- sales --}}
                                                <tr>
                                                    @forelse($year_sale_operations as $year_sale_operation)
                                                        {{-- Actif --}}
                                                        <td> {{ $year_sale_operation->actif_account }}</td>
                                                        <td>
                                                            <?php $total_sales = 0; ?>
                                                            @foreach($month_sales as $month_sale)
                                                                {{ number_format($month_sale->quantity * $month_sale->price, 02) .'$'  }} 
                                                                <?php $total_sales = $total_sales +  ($month_sale->quantity * $month_sale->price) ;?>
                                                                <br><br>
                                                            @endforeach
                                                            <hr>
                                                            <b>{{ number_format($total_sales, 02) .'$'}}</b>   
                                                        </td>                                                
                                                        <td> 
                                                            <b>{{ 'SD ' . number_format($total_sales, 02) .'$'}}</b>    
                                                        </td>
                        
                                                        {{-- Passif --}}
                                                        <td>
                                                            {{ $year_sale_operation->passif_account }}
                                                        </td>
                                                        <td>
                                                            <b>{{ 'SC '. number_format($total_sales, 02) .'$'}}</b>    
                                                            
                                                        </td>
                                                        <td>
                                                            <?php $total_sales = 0; ?>
                                                            @foreach($month_sales as $month_sale)
                                                                {{ number_format($month_sale->quantity * $month_sale->price, 02) .'$'  }}
                                                                <?php $total_sales = $total_sales +  ($month_sale->quantity * $month_sale->price) ;?>
                                                                <br><br>
                                                            @endforeach
                                                            <hr>
                                                            <b>{{ number_format($total_sales, 02) .'$'}}</b> 
                                                        </td>
                        
                                                    @empty
                                                        
                                                    @endforelse
                                                </tr>
                                            </tbody>   
                                            {{-- achat --}}
                                            {{-- matiere --}}
                                            <thead>
                                                <tr>
                                                    <td colspan="6" style="center">{{ GoogleTranslate::trans('Achat matières premières', $appLocale)}}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ GoogleTranslate::trans('Compte', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Débit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Crédit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Compte', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Débit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Crédit', $appLocale)}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Achat --}}
                                                <tr>
                                                    @forelse($year_matiere_operations as $year_matiere_operation)
                                                        {{-- Actif --}}
                                                        <td> {{ $year_matiere_operation->actif_account }}</td>
                                                        <td>
                                                            <?php $total_matiere = 0; ?>
                                                            @foreach($month_matieres as $month_matiere)
                                                                {{ number_format($month_matiere->quantity * $month_matiere->purchase_price, 02) .'$'  }} 
                                                                <?php $total_matiere = $total_matiere +  ($month_matiere->quantity * $month_matiere->purchase_price) ;?>
                                                                <br><br>
                                                            @endforeach
                                                            <hr>
                                                            <b>{{ number_format($total_matiere, 02) .'$'}}</b>    
                                                        </td>                                                
                                                        <td> 
                                                            <b>{{ 'SD ' . number_format($total_matiere, 02) .'$'}}</b>    
                                                        </td>
                        
                                                        {{-- Passif --}}
                                                        <td>
                                                            {{ $year_matiere_operation->passif_account }}
                                                        </td>
                                                        <td>
                                                            <b>{{ 'SC '. number_format($total_matiere, 02) .'$'}}</b>    
                                                            
                                                        </td>
                                                        <td>
                                                            <?php $total_matiere = 0; ?>
                                                            @foreach($month_matieres as $month_matiere)
                                                                {{ number_format($month_matiere->quantity * $month_matiere->purchase_price, 02) .'$'  }}
                                                                <?php $total_matiere = $total_matiere +  ($month_matiere->quantity * $month_matiere->purchase_price) ;?>
                                                                <br><br>
                                                            @endforeach
                                                            <hr>
                                                            <b>{{ number_format($total_matiere, 02) .'$'}}</b> 
                                                        </td>
                        
                                                    @empty
                                                        
                                                    @endforelse
                                                </tr>
                                            </tbody>
                                            
                                            {{-- achat --}}
                                            {{-- emballage --}}
                                            <thead>
                                                <tr>
                                                    <td colspan="6" style="center">{{ GoogleTranslate::trans('Achat d\'emballages', $appLocale)}}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ GoogleTranslate::trans('Compte', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Débit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Crédit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Compte', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Débit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Crédit', $appLocale)}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Achat --}}
                                                <tr>
                                                    @forelse($year_emballage_operations as $year_emballage_operation)
                                                        {{-- Actif --}}
                                                        <td> {{ $year_emballage_operation->actif_account }}</td>
                                                        <td>
                                                            <?php $total_emballage = 0; ?>
                                                            @foreach($month_emballages as $month_emballage)
                                                                {{ number_format($month_emballage->quantity * $month_emballage->purchase_price, 02) .'$'  }} 
                                                                <?php $total_emballage = $total_emballage +  ($month_emballage->quantity * $month_emballage->purchase_price) ;?>
                                                                <br><br>
                                                            @endforeach
                                                            <hr>
                                                            <b>{{ number_format($total_emballage, 02) .'$'}}</b>    
                                                        </td>                                                
                                                        <td> 
                                                            <b>{{ 'SD ' . number_format($total_emballage, 02) .'$'}}</b>    
                                                        </td>
                        
                                                        {{-- Passif --}}
                                                        <td>
                                                            {{ $year_emballage_operation->passif_account }}
                                                        </td>
                                                        <td>
                                                            <b>{{ 'SC '. number_format($total_emballage, 02) .'$'}}</b>    
                                                            
                                                        </td>
                                                        <td>
                                                            <?php $total_emballage = 0; ?>
                                                            @foreach($month_emballages as $month_emballage)
                                                                {{ number_format($month_emballage->quantity * $month_emballage->purchase_price, 02) .'$'  }}
                                                                <?php $total_emballage = $total_emballage +  ($month_emballage->quantity * $month_emballage->purchase_price) ;?>
                                                                <br><br>
                                                            @endforeach
                                                            <hr>
                                                            <b>{{ number_format($total_emballage, 02) .'$'}}</b> 
                                                        </td>
                        
                                                    @empty
                                                        
                                                    @endforelse
                                                </tr>
                                            </tbody>
                        
                        
                                            {{-- CHARGES CAS GENERAL --}}
                                            <thead>
                                                <tr>
                                                    <td colspan="6" style="center">{{ GoogleTranslate::trans('Autres Charges', $appLocale)}} </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ GoogleTranslate::trans('Compte', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Débit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Crédit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Compte', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Débit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Crédit', $appLocale)}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Charge --}}
                                                <tr>
                                                    @forelse($year_charge_operations as $year_charge_operation)
                                                        {{-- Actif --}}
                                                        <td> {{ $year_charge_operation->actif_account }}</td>
                                                        <td>
                                                            <?php $total_charge = 0; ?>
                                                            @foreach($month_charges as $month_charge)
                                                                {{ number_format($month_charge->montant, 02) .'$'  }} 
                                                                <?php $total_charge = $total_charge +  $month_charge->montant ;?>
                                                                <br><br>
                                                            @endforeach
                                                            <hr>
                                                            <b>{{ number_format($total_charge, 02) .'$'}}</b>    
                                                        </td>                                                
                                                        <td> 
                                                            <b>{{ 'SD ' . number_format($total_charge, 02) .'$'}}</b>    
                                                        </td>
                        
                                                        {{-- Passif --}}
                                                        <td>
                                                            {{ $year_charge_operation->passif_account }}
                                                        </td>
                                                        <td>
                                                            <b>{{ 'SC '. number_format($total_charge, 02) .'$'}}</b>    
                                                            
                                                        </td>
                                                        <td>
                                                            <?php $total_charge = 0; ?>
                                                            @foreach($month_charges as $month_charge)
                                                                {{ number_format($month_charge->montant, 02) .'$'  }}
                                                                <?php $total_charge = $total_charge +  $month_charge->montant ;?>
                                                                <br><br>
                                                            @endforeach
                                                            <hr>
                                                            <b>{{ number_format($total_charge, 02) .'$'}}</b> 
                                                        </td>
                        
                                                    @empty
                                                        
                                                    @endforelse
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
                    <div class="tab-pane fade show active" id="daily" role="tabpanel" aria-labelledby="daily"> 
                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                        <div>
                                            <h4 class="card-title">{{ GoogleTranslate::trans('Grand Livre annuel', $appLocale)}} [{{ $year }}]</h4>
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
                                                    <td colspan="6" style="center">{{ GoogleTranslate::trans('Vente', $appLocale)}}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ GoogleTranslate::trans('Compte', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Débit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Crédit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Compte', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Débit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Crédit', $appLocale)}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- sales --}}
                                                <tr>
                                                    @forelse($year_sale_operations as $year_sale_operation)
                                                        {{-- Actif --}}
                                                        <td> {{ $year_sale_operation->actif_account }}</td>
                                                        <td>
                                                            <?php $total_sales = 0; ?>
                                                            @foreach($year_sales as $year_sale)
                                                                {{ number_format($year_sale->quantity * $year_sale->price, 02) .'$'  }} 
                                                                <?php $total_sales = $total_sales +  ($year_sale->quantity * $year_sale->price) ;?>
                                                                <br><br>
                                                            @endforeach
                                                            <hr>
                                                            <b>{{ number_format($total_sales, 02) .'$'}}</b>   
                                                        </td>                                                
                                                        <td> 
                                                            <b>{{ 'SD ' . number_format($total_sales, 02) .'$'}}</b>    
                                                        </td>
                        
                                                        {{-- Passif --}}
                                                        <td>
                                                            {{ $year_sale_operation->passif_account }}
                                                        </td>
                                                        <td>
                                                            <b>{{ 'SC '. number_format($total_sales, 02) .'$'}}</b>    
                                                            
                                                        </td>
                                                        <td>
                                                            <?php $total_sales = 0; ?>
                                                            @foreach($year_sales as $year_sale)
                                                                {{ number_format($year_sale->quantity * $year_sale->price, 02) .'$'  }}
                                                                <?php $total_sales = $total_sales +  ($year_sale->quantity * $year_sale->price) ;?>
                                                                <br><br>
                                                            @endforeach
                                                            <hr>
                                                            <b>{{ number_format($total_sales, 02) .'$'}}</b> 
                                                        </td>
                        
                                                    @empty
                                                        
                                                    @endforelse
                                                </tr>
                                            </tbody>   
                                            {{-- achat --}}
                                            {{-- matiere --}}
                                            <thead>
                                                <tr>
                                                    <td colspan="6" style="center">{{ GoogleTranslate::trans('Achat matières premières', $appLocale)}}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ GoogleTranslate::trans('Compte', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Débit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Crédit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Compte', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Débit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Crédit', $appLocale)}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Achat --}}
                                                <tr>
                                                    @forelse($year_matiere_operations as $year_matiere_operation)
                                                        {{-- Actif --}}
                                                        <td> {{ $year_matiere_operation->actif_account }}</td>
                                                        <td>
                                                            <?php $total_matiere = 0; ?>
                                                            @foreach($year_matieres as $year_matiere)
                                                                {{ number_format($year_matiere->quantity * $year_matiere->purchase_price, 02) .'$'  }} 
                                                                <?php $total_matiere = $total_matiere +  ($year_matiere->quantity * $year_matiere->purchase_price) ;?>
                                                                <br><br>
                                                            @endforeach
                                                            <hr>
                                                            <b>{{ number_format($total_matiere, 02) .'$'}}</b>    
                                                        </td>                                                
                                                        <td> 
                                                            <b>{{ 'SD ' . number_format($total_matiere, 02) .'$'}}</b>    
                                                        </td>
                        
                                                        {{-- Passif --}}
                                                        <td>
                                                            {{ $year_matiere_operation->passif_account }}
                                                        </td>
                                                        <td>
                                                            <b>{{ 'SC '. number_format($total_matiere, 02) .'$'}}</b>    
                                                            
                                                        </td>
                                                        <td>
                                                            <?php $total_matiere = 0; ?>
                                                            @foreach($year_matieres as $year_matiere)
                                                                {{ number_format($year_matiere->quantity * $year_matiere->purchase_price, 02) .'$'  }}
                                                                <?php $total_matiere = $total_matiere +  ($year_matiere->quantity * $year_matiere->purchase_price) ;?>
                                                                <br><br>
                                                            @endforeach
                                                            <hr>
                                                            <b>{{ number_format($total_matiere, 02) .'$'}}</b> 
                                                        </td>
                        
                                                    @empty
                                                        
                                                    @endforelse
                                                </tr>
                                            </tbody>
                                            
                                            {{-- achat --}}
                                            {{-- emballage --}}
                                            <thead>
                                                <tr>
                                                    <td colspan="6" style="center">{{ GoogleTranslate::trans('Achat d\'emballages', $appLocale)}}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ GoogleTranslate::trans('Compte', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Débit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Crédit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Compte', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Débit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Crédit', $appLocale)}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Achat --}}
                                                <tr>
                                                    @forelse($year_emballage_operations as $year_emballage_operation)
                                                        {{-- Actif --}}
                                                        <td> {{ $year_emballage_operation->actif_account }}</td>
                                                        <td>
                                                            <?php $total_emballage = 0; ?>
                                                            @foreach($year_emballages as $year_emballage)
                                                                {{ number_format($year_emballage->quantity * $year_emballage->purchase_price, 02) .'$'  }} 
                                                                <?php $total_emballage = $total_emballage +  ($year_emballage->quantity * $year_emballage->purchase_price) ;?>
                                                                <br><br>
                                                            @endforeach
                                                            <hr>
                                                            <b>{{ number_format($total_emballage, 02) .'$'}}</b>    
                                                        </td>                                                
                                                        <td> 
                                                            <b>{{ 'SD ' . number_format($total_emballage, 02) .'$'}}</b>    
                                                        </td>
                        
                                                        {{-- Passif --}}
                                                        <td>
                                                            {{ $year_emballage_operation->passif_account }}
                                                        </td>
                                                        <td>
                                                            <b>{{ 'SC '. number_format($total_emballage, 02) .'$'}}</b>    
                                                            
                                                        </td>
                                                        <td>
                                                            <?php $total_emballage = 0; ?>
                                                            @foreach($year_emballages as $year_emballage)
                                                                {{ number_format($year_emballage->quantity * $year_emballage->purchase_price, 02) .'$'  }}
                                                                <?php $total_emballage = $total_emballage +  ($year_emballage->quantity * $year_emballage->purchase_price) ;?>
                                                                <br><br>
                                                            @endforeach
                                                            <hr>
                                                            <b>{{ number_format($total_emballage, 02) .'$'}}</b> 
                                                        </td>
                        
                                                    @empty
                                                        
                                                    @endforelse
                                                </tr>
                                            </tbody>
                        
                        
                                            {{-- CHARGES CAS GENERAL --}}
                                            <thead>
                                                <tr>
                                                    <td colspan="6" style="center">{{ GoogleTranslate::trans('Autres Charges', $appLocale)}} </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ GoogleTranslate::trans('Compte', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Débit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Crédit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Compte', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Débit', $appLocale)}}</th>
                                                    <th>{{ GoogleTranslate::trans('Crédit', $appLocale)}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Charge --}}
                                                <tr>
                                                    @forelse($year_charge_operations as $year_charge_operation)
                                                        {{-- Actif --}}
                                                        <td> {{ $year_charge_operation->actif_account }}</td>
                                                        <td>
                                                            <?php $total_charge = 0; ?>
                                                            @foreach($year_charges as $year_charge)
                                                                {{ number_format($year_charge->montant, 02) .'$'  }} 
                                                                <?php $total_charge = $total_charge +  $year_charge->montant ;?>
                                                                <br><br>
                                                            @endforeach
                                                            <hr>
                                                            <b>{{ number_format($total_charge, 02) .'$'}}</b>    
                                                        </td>                                                
                                                        <td> 
                                                            <b>{{ 'SD ' . number_format($total_charge, 02) .'$'}}</b>    
                                                        </td>
                        
                                                        {{-- Passif --}}
                                                        <td>
                                                            {{ $year_charge_operation->passif_account }}
                                                        </td>
                                                        <td>
                                                            <b>{{ 'SC '. number_format($total_charge, 02) .'$'}}</b>    
                                                            
                                                        </td>
                                                        <td>
                                                            <?php $total_charge = 0; ?>
                                                            @foreach($year_charges as $year_charge)
                                                                {{ number_format($year_charge->montant, 02) .'$'  }}
                                                                <?php $total_charge = $total_charge +  $year_charge->montant ;?>
                                                                <br><br>
                                                            @endforeach
                                                            <hr>
                                                            <b>{{ number_format($total_charge, 02) .'$'}}</b> 
                                                        </td>
                        
                                                    @empty
                                                        
                                                    @endforelse
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

