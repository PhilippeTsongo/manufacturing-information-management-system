<?php

namespace App\Http\Controllers;

use App\Models\BilanConfig;
use Illuminate\Http\Request;

class BilanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isComptable');
    }
    
    public function index()
    {
        $year = date('Y');

        $immobilises = BilanConfig::where('bilan_classement_id', '1')
                                ->where('annee', $year)  
                                ->get();

        $circulants = BilanConfig::where('bilan_classement_id', '2')
                                ->where('annee', $year)  
                                ->get();

        $capitaux = BilanConfig::where('bilan_classement_id', '3')
                                ->where('annee', $year)  
                                ->get();                            

        $dettes = BilanConfig::where('bilan_classement_id', '4')
                                ->where('annee', $year)  
                                ->get();

        return view('bilan.index', compact('immobilises', 'circulants', 'capitaux', 'dettes','year'));
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
