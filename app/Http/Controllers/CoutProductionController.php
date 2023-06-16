<?php

namespace App\Http\Controllers;

use App\Models\Mois;
use Illuminate\Http\Request;
use App\Models\CoutProduction;

class CoutProductionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isFinancier');
    }

    public function index()
    {
        $today = date('d-m-Y');
        $dailys = CoutProduction::where('date_production', $today )
                        ->orderBy('id', 'DESC')     
                        ->get(); 

        $month = date('M');
        $year = date('Y');

        $months = CoutProduction::where('mois', $month )
                        ->where('annee', $year)
                        ->orderBy('id', 'DESC')    
                        ->get();

        $years = CoutProduction::where('annee', $year )
                        ->orderBy('id', 'DESC')    
                        ->paginate(10); 

        $cout_production = CoutProduction::all();
        $mois = Mois::all();

        return view('cout_production.index', compact('cout_production', 'dailys', 'months', 'years', 'today', 'month', 'year', 'mois'));
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
