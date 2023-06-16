<?php

namespace App\Http\Controllers;

use App\Models\AutreRecette;
use App\Models\Emballage;
use App\Models\Sale;
use App\Models\Sortie;
use App\Models\Matiere;
use Illuminate\Http\Request;

class BalanceController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isFinancier');
    }

    public function index()
    {
        $today = date('d-m-Y');
        $month = date('M');
        $year = date('Y');

        //RECETTES
        $daily_recettes = Sale::where('date_sale', $today )->get(); 
        $month_recettes = Sale::where('mois', $month )
                                ->where('annee', $year)    
                                ->get(); 
        $year_recettes = Sale::where('annee', $year )->get(); 
 

         //AUTRES RECETTES
         $daily_autre_recettes = AutreRecette::where('date_creation', $today )->get(); 
         $month_autre_recettes = AutreRecette::where('mois', $month )
                                                ->where('annee', $year)    
                                                ->get(); 
         $year_autre_recettes = AutreRecette::where('annee', $year )->get(); 
  
        //CHARGES
        //Sorties
        $daily_charges = Sortie::where('date_sortie', $today )->get(); 
        $month_charges = Sortie::where('mois', $month )
                        ->where('annee', $year)    
                        ->get(); 
        $year_charges = Sortie::where('annee', $year )->get(); 
        
        //matiere
        // $daily_matieres = Matiere::where('date_matiere', $today )->get(); 
       
        // $month_matieres = Matiere::where('mois', $month )
        //                 ->where('annee', $year)    
        //                 ->get(); 
        
        // $year_matieres = Matiere::where('annee', $year )->get(); 


        //matiere
        // $daily_emballages = Emballage::where('date_emballage', $today )->get(); 
       
        // $month_emballages = Emballage::where('mois', $month )
        //                 ->where('annee', $year)    
        //                 ->get(); 
        
        $year_emballages = Emballage::where('annee', $year )->get();

        return view('balance.index', compact('today', 'month', 'year', 'daily_recettes', 'month_recettes', 
        'year_recettes', 'daily_charges', 'month_charges', 'year_charges', 'daily_autre_recettes', 'month_autre_recettes', 'year_autre_recettes'));
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
