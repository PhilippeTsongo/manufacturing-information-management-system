<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use App\Models\PlanComptable;
use Illuminate\Http\Request;

class AccountTypeController extends Controller
{
     
    public function index()
    {
        $account_types = AccountType::orderBy('range', 'ASC')->get();
 
        return view('account_type.index', compact('account_types'));
    }
 
    public function create()
    {
        $account_types = AccountType::all();
        return view('account_type.create', compact('account_types'));
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:250', 'min:3', 'unique:account_types'],
            'range' => ['required', 'string', 'max:250', 'min:3'],
        ]);

        $number = date('d-Y') .'-'. rand(10, 99);

        $account_type = AccountType::firstOrCreate([
            'classification_number' => $number,
            'name' => $request->name,
            'range' => $request->range,
        ]);

        if($account_type){
            session()->flash('message', 'Account type created successfully');
            return redirect()->route('account_type.index');
        }
       
    }    
 
    public function show($id)
    {
         //
    }
    
   
    public function edit(AccountType $account_type)
    {
        $account_types = AccountType::all();

        $comptes = PlanComptable::all();

        return view('account_type.edit', compact('account_types', 'account_type', 'comptes'));
    }
 
     
    public function update(Request $request, AccountType $account_type)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:250', 'min:3'],
            'range' => ['required', 'string', 'max:250', 'min:3'],
            
        ]);
        
        $account_type->update([
            'name' => $request->name,
            'range' => $request->range,

        ]);

        if($account_type){
            session()->flash('message', 'Account Type edited successfully');
            return redirect()->route('account_type.index');
        }
        
    }
    
    public function destroy(AccountType $account_type)
    {
        $account_type->delete();   
        session()->flash('message', 'Account type deleted successfully');
        return redirect()->route('account_type.index');
    }
}
