<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
     
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isComptable');
    }
    
    public function index()
    {
        $transactions = Transaction::orderBy('id', 'ASC')->get();
 
        return view('transaction.index', compact('transactions'));
    }
 
    public function create()
    {
        $transactions = Transaction::all();
        return view('transaction.create', compact('transactions'));
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:250', 'unique:transactions'],
        ]);
 
        $number = date('d-Y'). '-'.rand(20, 50).'-'.rand(60, 90);
        $transaction = Transaction::firstOrCreate([
            'transaction_number' => $number,
            'name' => $request->name,
        ]);

        if($transaction){
            session()->flash('message', 'Successful operation');
            return redirect()->route('transaction.index');
        }
        
    }    
 
    public function show($id)
    {
        //
    }
 
    
    public function edit(Transaction $transaction)
    {
        $transactions = Transaction::all();

        return view('transaction.edit', compact('transaction', 'transactions'));
    }
 
     
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:250'],

        ]);
 
        $transaction->update([
            'name' => $request->name,
        ]);

        if($transaction){
            session()->flash('message', 'Successful operation');
            return redirect()->route('transaction.index');
        }
    }
    
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();   
        session()->flash('message', 'Successful operation');
        return redirect()->route('transaction.index');
    }
}
