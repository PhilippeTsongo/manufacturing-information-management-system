<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Office;
use App\Models\Logistique;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;

class LogistiqueController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isEntrepreneur');
    }

    public function index()
    {
        $logistiques = Logistique::orderBy('logistique_number', 'DESC')->get();

        return view('logistique.index', compact('logistiques'));
    }
 
    public function create(){

        $logistiques = Logistique::orderBy('logistique_number', 'DESC')->get();
        $unities = Unit::all();
        $offices = Office::all();
        
        return view('logistique.create', compact('logistiques', 'unities', 'offices'));
    }
 

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['string', 'max:20', 'min:3',],
            'purchase_price' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],

        ]);

        if($request->purchase_price > 0){

            if($request->quantity > 0){        

                $logistique_number = rand(100, 900) . '-'.date('Y') ;
                                
                $logistique = logistique::create([
                    'name' => $request->name,
                    'purchase_price' => $request->purchase_price,
                    'logistique_number' => $logistique_number,
                    'quantity' => $request->quantity,
                    'office_id' => $request->office,
                    'unit_id' => $request->unit
                ]);

                if($logistique){
                    session()->flash('message', 'Successfulu operation');
                    return redirect()->route('logistique.index');
                }else{
                    session()->flash('message_err', 'Operation failed');
                    return redirect()->route('logistique.index');
                }
            }else{
                session()->flash('message_err', 'The quantity must be greater than 0');
                return redirect()->route('logistique.index');
            }
        }else{
            session()->flash('message_err', 'The purchase price should be greater than 0');
            return redirect()->route('logistique.index');
        }
    }     
 
    public function show(logistique $logistique)
    {
        //return view('logistique.show', compact('logistiques') );
    }
 
    
    public function edit(logistique $logistique)
    {
        $logistiques = logistique::orderBy('logistique_number', 'DESC')->get();
        $unities = Unit::all();
        $offices = Office::all();

        return view('logistique.edit', compact('logistique', 'logistiques', 'unities', 'offices'));
     }
 
     
    public function update(Request $request, logistique $logistique)
    {
        $request->validate([
            'name' => ['string', 'max:20', 'min:3',],
            'purchase_price' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],

        ]);

        if($request->purchase_price > 0){

            if($request->quantity > 0){        

                $logistique_number = rand(100, 900) . '-'.date('Y') ;
                                
                $logistique->update([
                    'name' => $request->name,
                    'purchase_price' => $request->purchase_price,
                    'logistique_number' => $logistique_number,
                    'quantity' => $request->quantity,
                    'office_id' => $request->office,
                    'unit_id' => $request->unit
                ]);

                if($logistique){
                    session()->flash('message', 'Successful operation');
                    return redirect()->route('logistique.index');
                }else{
                    session()->flash('message_err', 'Operation failed');
                    return redirect()->route('logistique.index');
                }
            }else{
                session()->flash('message_err', 'The quantity must be greater than 0');
                return redirect()->route('logistique.index');
            }
        }else{
            session()->flash('message_err', 'The purchase price must be greater than 0');
            return redirect()->route('logistique.index');
        }
              
    }
    
    public function destroy(logistique $logistique)
    {
        $logistique->delete();   
        session()->flash('message', 'Successfully Deleted');
        return redirect()->route('logistique.index');
    }


}
