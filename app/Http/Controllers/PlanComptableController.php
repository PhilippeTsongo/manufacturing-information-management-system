<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use App\Models\PlanComptable;
use Illuminate\Http\Request;

class PlanComptableController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isComptable');
    }
    
    public function index()
    {
        $comptes = PlanComptable::orderBy('account_number', 'ASC')->paginate(10);
 
        return view('plan_comptable.index', compact('comptes'));
    }
 
    public function create()
    {
        $comptes = PlanComptable::all();
        $account_types = AccountType::all();
        return view('plan_comptable.create', compact('comptes', 'account_types'));
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'account_number' => [ 'required', 'unique:plan_comptables'],
            'account_name' => ['required', 'string', 'max:150', 'min:3'],
        ]);
         
        $plan_comptable = PlanComptable::firstOrCreate([
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'account_type_id' => $request->account_type,
        ]);

        if($plan_comptable){
            session()->flash('message', 'Compte crée avec succès');
            return redirect()->route('plan_comptable.index');
        }
 
     }    
 
     public function show($id)
     {
         //
     }
 
    
   
    public function edit(PlanComptable $plan_comptable)
    {
        $comptes = PlanComptable::all();
 
        $account_types = AccountType::all();

        return view('plan_comptable.edit', compact('comptes', 'plan_comptable', 'account_types'));
    }
 
     
    public function update(Request $request, PlanComptable $plan_comptable)
    {
        $request->validate([
            'account_number' => [ 'required'],
            'account_name' => ['required', 'string', 'max:150', 'min:3'],
        ]);
 
        if(is_numeric($request->account_number))
        { 
            $plan_comptable->update([
                'account_number' => $request->account_number,
                'account_name' => $request->account_name,
                'account_type_id' => $request->account_type,
            ]);

            if($plan_comptable){
                session()->flash('message', 'Compte crée avec succès');
                return redirect()->route('plan_comptable.index');
            }
        }else{
            session()->flash('message_err', 'Le numéro de compte ne doit pas avoir des lettres ou des signes');
            return redirect()->route('plan_comptable.create');
        }
        
    }
    
    public function destroy(PlanComptable $plan_comptable)
    {
        $plan_comptable->delete();   
        session()->flash('message', 'Compte supprimmé avec succès');
        return redirect()->route('plan_comptable.index');
    }
}
