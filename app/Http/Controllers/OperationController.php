<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use App\Models\PlanComptable;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OperationController extends Controller
{
     
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isComptable');
    }
    
    public function index()
    {
        $operations = Operation::orderBy('operation_number', 'ASC')->get();
 
        return view('operation.index', compact('operations'));
    }
 
    public function create()
    {
        $operations = Operation::all();
        $transactions = Transaction::all();
        $comptes = PlanComptable::orderBy('account_number', 'ASC')->get();

        return view('operation.create', compact('operations', 'transactions', 'comptes'));
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => ['unique:operations'],
            'account_actif' => ['required', 'string'],
            'account_passif' => ['required', 'string'],

        ]);
 
        $number = date('Y-d') . '-' . rand(1000, 5000);
        
        $operation = Operation::create([
            'operation_number' => $number,
            'transaction_id' => $request->transaction_id,
            'actif_account' => $request->account_actif,
            'passif_account' => $request->account_passif,
        ]);

        if($operation){
            session()->flash('message', 'Operation créée avec succès');
            return redirect()->route('operation.index');
        }
        
    }    
 
    public function show($id)
    {
        //
    }
 
    
    public function edit(Operation $operation)
    {
        $operations = Operation::all();
        $transactions = Transaction::all();
        $comptes = PlanComptable::orderBy('account_number', 'ASC')->get();

        return view('operation.edit', compact('operation', 'operations', 'transactions', 'comptes'));
    }
 
     
    public function update(Request $request, Operation $operation)
    {
        $request->validate([
            'account_actif' => ['required', 'string'],
            'account_passif' => ['required', 'string'],
            
        ]);
 
        $operation->update([
            'transaction_id' => $request->transaction_id,
            'actif_account' => $request->account_actif,
            'passif_account' => $request->account_passif,
        ]);

        if($operation){
            session()->flash('message', 'Operation créée avec succès');
            return redirect()->route('operation.index');
        }
    }
    
    public function destroy(Operation $operation)
    {
        $operation->delete();   
        session()->flash('message', 'Operation supprimmée avec succès');
        return redirect()->route('operation.index');
    }
}
