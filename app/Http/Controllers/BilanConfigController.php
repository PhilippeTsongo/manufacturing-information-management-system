<?php

namespace App\Http\Controllers;

use App\Models\BilanClassement;
use App\Models\BilanConfig;
use Illuminate\Http\Request;
use App\Models\PlanComptable;

class BilanConfigController extends Controller
{
   
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isComptable');
    }
    
    public function index()
    {
        $bilan_configs = BilanConfig::orderBy('plan_comptable_id', 'ASC')->paginate(10);

        return view('bilan_config.index', compact('bilan_configs'));
    }

    
    public function create()
    {
        $accounts = PlanComptable::all();

        $bilan_configs = BilanConfig::all();

        $bilan_classements = BilanClassement::all();

        return view('bilan_config.create', compact('accounts', 'bilan_classements', 'bilan_configs'));
    }

  
    public function store(Request $request)
    {

        $request->validate([
            'plan_comptable_id' => ['required', 'integer', 'unique:bilan_configs'],
            'amount' => ['required'],
            'bilan_classement_id' => ['integer']
        ]);

        $month = date('M');
        $year = date('Y');

        $number = date('Y').'-'. rand(10, 99)  .'-'. rand(500, 900);

        $bilan_config = BilanConfig::firstOrCreate([
            'plan_comptable_id' => $request->plan_comptable_id,
            'amount' => $request->amount,
            'bilan_classement_id' => $request->bilan_classement_id,
            'mois' => $month,
            'annee' => $year,
            'bilan_config_number' => $number
        ]);

        if($bilan_config){
            session()->flash('message', 'Element du Bilan crée avec succès');
            return redirect()->route('bilan_config.index');
        }
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit(BilanConfig $bilan_config)
    {
        $accounts = PlanComptable::all();

        $bilan_configs = BilanConfig::all();

        $bilan_classements = BilanClassement::all();

        return view('bilan_config.edit', compact('bilan_config', 'accounts', 'bilan_classements', 'bilan_configs'));
    }

   
    public function update(Request $request, BilanConfig $bilan_config)
    {
        
        $request->validate([
            'plan_comptable_id' => ['required', 'integer'],
            'amount' => ['required'],
            'bilan_classement_id' => ['integer']
        ]);

        $month = date('M');
        $year = date('Y');

        $update = $bilan_config->update([
            'plan_comptable_id' => $request->plan_comptable_id,
            'amount' => $request->amount,
            'bilan_classement_id' => $request->bilan_classement_id,
            'mois' => $month,
            'annee' => $year,
        ]);

        if($update){
            session()->flash('message', 'Element du Bilan Modifié avec succès');
            return redirect()->route('bilan_config.index');
        }
    }

    
    public function destroy($id)
    {
        //
    }
}
