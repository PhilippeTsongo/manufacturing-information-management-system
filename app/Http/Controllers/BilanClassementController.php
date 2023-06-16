<?php

namespace App\Http\Controllers;

use App\Models\BilanClassement;
use Illuminate\Http\Request;

class BilanClassementController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isComptable');
    }
    
    public function index()
    {
        $bilan_classements = BilanClassement::orderBy('id', 'DESC')->get();

        return view('bilan_classement.index', compact('bilan_classements'));
    }

    
    public function create()
    {
        $bilan_classements = BilanClassement::orderBy('id', 'DESC')->get();

        return view('bilan_classement.create', compact('bilan_classements'));
    }

  
    public function store(Request $request)
    {

        $request->validate([
            'classement' => ['string', 'unique:bilan_classements'],
        ]);

        $number = date('d').'-'. rand(100, 900);

        $bilan_classement = BilanClassement::firstOrCreate([
            'classement' => $request->classement,
            'classement_number' => $number
        ]);

        if($bilan_classement){
            session()->flash('message', 'Successful operation');
            return redirect()->route('bilan_classement.index');
        }
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit(BilanClassement $bilan_classement)
    {
        $bilan_classements = BilanClassement::orderBy('id', 'DESC')->get();

        return view('bilan_classement.edit', compact('bilan_classement', 'bilan_classements'));
    }

   
    public function update(Request $request, BilanClassement $bilan_classement)
    {
        
        $request->validate([
            'classement' => ['string', 'unique:classement_bilans'],
        ]);

        $bilan_classement->update([
            'classement' => $request->classement,
        ]);

        if($bilan_classement){
            session()->flash('message', 'Successul operation');
            return redirect()->route('bilan_classement.index');
        }
    }

    
    public function destroy(BilanClassement $bilan_classement)
    {
        $bilan_classement->delete();
        
        if($bilan_classement){
            session()->flash('message', 'Deleted successfully');
            return redirect()->route('bilan_classement.index');
        }
    }
}
