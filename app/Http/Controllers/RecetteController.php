<?php

namespace App\Http\Controllers;

use App\Models\Mois;
use App\Models\Sale;
use App\Models\AutreRecette;
use Illuminate\Http\Request;

class RecetteController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isFinancier');
    }
    
    public function index()
    {

        $today = date('d-m-Y');
        $dailys = Sale::where('date_sale', $today )
                        ->orderBy('id', 'DESC') 
                        ->get(); 
 
        $month = date('M');
        $year = date('Y');
        $months = Sale::where('mois', $month )
                        ->where('annee', $year)
                        ->orderBy('id', 'DESC')     
                        ->get(); 
    
        $years = Sale::where('annee', $year )
                        ->orderBy('id', 'DESC') 
                        ->paginate(10); 
 
        $sales = Sale::orderBy('id', 'DESC')->get();

        $recettes = AutreRecette::orderBy('id', 'DESC')
                                ->paginate(10);
        $mois = Mois::all();

        return view('recette.index', compact('sales', 'dailys', 'months', 'years', 'today', 'month', 'year', 'recettes', 'mois'));
        
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
