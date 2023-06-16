<?php

namespace App\Http\Controllers;

use App\Models\Logistique;
use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
     
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isEntrepreneur');
    }
    
    public function index()
    {
        $offices = Office::orderBy('office_number', 'DESC')->get();

        return view('office.index', compact('offices',));
    }
 
    public function create(){

        $offices = Office::orderBy('office_number', 'DESC')->get();
        
        return view('office.create', compact('offices'));
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['string', 'max:20', 'min:3', 'unique:offices'],
            'chef' => ['string', 'max:20', 'min:3'],
        ]);
 
        $office_number = date('Y') .'-'. rand(100, 900);
                         
        $office = Office::firstOrCreate([
            'name' => $request->name,
            'chef' => $request->chef,
            'office_number' => $office_number
        ]);

        if($office){
            session()->flash('message', 'Bureau crée avec succès');
            return redirect()->route('office.index');
        }else{
            session()->flash('message_err', 'L\'enregistrement n\'pas été effectuée');
            return redirect()->route('office.index');
        }
    }     
 
    public function show(Office $office)
    {
        //return view('office.show', compact('offices') );
    }
 
    
    public function edit(Office $office)
    {
        $offices = Office::orderBy('office_number', 'DESC')->get();
 
        return view('office.edit', compact('office', 'offices'));
     }
 
     
    public function update(Request $request, Office $office)
    {
        $request->validate([
            'name' => ['string', 'max:20', 'min:3'],
            'chef' => ['string', 'max:20', 'min:3', 'unique:offices']
        ]);
 
        $office_number = date('Y') .'-'. rand(100, 900);
                         
         $office->update([
            'name' => $request->name,
            'chef' => $request->chef,
            'office_number' => $office_number
        ]);
        
        if($office){
            session()->flash('message', 'Bureau Modifié avec succès');
            return redirect()->route('office.index'); 
        }else{
            session()->flash('message_err', 'La modification n\'pas été effectuée');
            return redirect()->route('office.index');
        }
              
    }
    
    public function destroy(Office $office)
    {
        $office->delete();   
        session()->flash('message', 'Bureau supprimmé avec succès');
        return redirect()->route('office.index');
    }


}
