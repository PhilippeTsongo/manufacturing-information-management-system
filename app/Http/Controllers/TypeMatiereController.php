<?php

namespace App\Http\Controllers;

use App\Models\TypeMatiere;
use Illuminate\Http\Request;

class TypeMatiereController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isProducer');
    }
    
    public function index()
    {
        $type_matieres = TypeMatiere::all();
        return view('type_matiere.index', compact('type_matieres'));
    }


    public function create()
    {
        $type_matieres = TypeMatiere::all();
        return view('type_matiere.create', compact('type_matieres'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:matieres'],
            
        ]);

        $type_matiere = TypeMatiere::firstOrCreate([
            'name' => $request->name,            
        ]);

        if($type_matiere){
            session()->flash('message', 'Type de Matières premières crée avec succès');
            return redirect(route('type_matiere.index'));
        }
        
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit(TypeMatiere $type_matiere)
    {
        $type_matieres = TypeMatiere::all();
        return view('type_matiere.edit', compact('type_matiere', 'type_matieres'));
    }

    
    public function update(Request $request, TypeMatiere $type_matiere)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
        ]);

        $type_matiere->update([
            'name' => $request->name,
        ]);

        if($type_matiere){
            session()->flash('message', 'Type de la Matière modifié avec succès');
            return redirect()->route('type_matiere.index');
        }    
    }

    //EDIT FUNCCTION
    public function destroy(TypeMatiere $type_matiere)
    {
        $type_matiere->delete();
        session()->flash('message', "Type de la Matière supprimé avec succès");
        return redirect()->route('type_matiere.index');
    }

}
