<?php

namespace App\Http\Controllers;

use App\Models\Mois;
use App\Models\Sale;
use App\Models\Sortie;
use App\Models\Operation;
use Illuminate\Http\Request;
use App\Models\MatiereComptable;
use App\Models\EmballageComptable;

class GrandLivreController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isComptable');
    }
    
    public function index()
    {

        $today = date('d-m-Y');
        $month = date('M');
        $year = date('Y');

        //++++++++++++++++++++++++++++ACHATS+++++++++++++++++++++++++++++++

        //=====================MATIERE=====================================

        $daily_matieres = MatiereComptable::where('date_matiere', $today )
                            ->orderBy('id', 'DESC') 
                            ->get(); 

        $month_matieres = MatiereComptable::where('mois', $month )
                            ->where('annee', $year)
                            ->orderBy('id', 'DESC')     
                            ->get(); 

        $year_matieres = MatiereComptable::where('annee', $year )
                            ->orderBy('id', 'DESC') 
                            ->get();

                            //operation comptable achat matieres = 1
        $year_matiere_operations = Operation::where('transaction_id', '1')
                            ->orderBy('created_at', 'DESC') 
                            ->get(); 

        //=====================EMBALLAGE=====================================

        $daily_emballages = EmballageComptable::where('date_emballage', $today )
                            ->orderBy('id', 'DESC') 
                            ->get(); 

        $month_emballages = EmballageComptable::where('mois', $month )
                            ->where('annee', $year)
                            ->orderBy('id', 'DESC')     
                            ->get(); 

        $year_emballages = EmballageComptable::where('annee', $year )
                            ->orderBy('id', 'DESC') 
                            ->get();

                            //operation comptable achat emballages = 2
        $year_emballage_operations = Operation::where('transaction_id', '2')
                        ->orderBy('created_at', 'DESC') 
                        ->get();       


        //+++++++++++++++++++++++++++++VENTES+++++++++++++++++++++++++++
        $daily_sales = Sale::where('date_sale', $today )
                        ->orderBy('id', 'DESC') 
                        ->get(); 

        $month_sales = Sale::where('mois', $month )
                        ->where('annee', $year)
                        ->orderBy('id', 'DESC')     
                        ->get(); 
    
        $year_sales = Sale::where('annee', $year )
                        ->orderBy('id', 'DESC') 
                        ->paginate(10);
        
                        //operation comptable ventes = 3              
        $year_sale_operations = Operation::where('transaction_id', '3')
                        ->orderBy('created_at', 'DESC') 
                        ->get();       
                        

        //++++++++++++++++++++++++++++CHARGES+++++++++++++++++++++++++++++++
        
        $daily_charges = Sortie::where('date_sortie', $today )
                            ->orderBy('id', 'DESC') 
                            ->get(); 

        $month_charges = Sortie::where('mois', $month )
                            ->where('annee', $year)
                            ->orderBy('id', 'DESC')     
                            ->get(); 

        $year_charges = Sortie::where('annee', $year )
                            ->orderBy('id', 'DESC') 
                            ->get();

                            //operation coptable charges = 4
        $year_charge_operations = Operation::where('transaction_id', '4')
                        ->orderBy('created_at', 'DESC') 
                        ->get();       

        $mois = Mois::all();

        return view('grand_livre.index', compact('today', 'month', 'year', 
        'daily_sales', 'daily_matieres', 'daily_emballages', 'daily_charges', 
        'month_sales', 'month_matieres', 'month_emballages', 'month_charges',
        'year_sales', 'year_matieres', 'year_emballages', 'year_charges',
        'year_sale_operations', 'year_matiere_operations', 'year_emballage_operations', 'year_charge_operations', 'mois' ));

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
