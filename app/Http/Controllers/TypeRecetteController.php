<?php

namespace App\Http\Controllers;

use App\Models\TypeRecette;
use Illuminate\Http\Request;

class TypeRecetteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isFinancier');
    }

    public function index()
    {
        $type_recettes = TypeRecette::all();
        //dd($type_recettes);
        return view('type_recette.index', compact('type_recettes'));
    }


    public function create()
    {
        $type_recettes = TypeRecette::all();
        return view('type_recette.create', compact('type_recettes'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:150', 'unique:type_recettes'],
        ]);

        //dd($request->name_recette);

        $type_recette = TypeRecette::firstOrCreate([
            'name' => $request->name,            
        ]);

        if($type_recette){
            session()->flash('message', 'Successful operation');
            return redirect()->route('type_recette.index');
        }
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit(TypeRecette $type_recette)
    {
        $type_recettes = TypeRecette::all();
        return view('type_recette.edit', compact('type_recette', 'type_recettes'));
    }

    
    public function update(Request $request, TypeRecette $type_recette)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
        ]);

        $type_recette->update([
            'name' => $request->name,
        ]);

        if($type_recette){
            session()->flash('message', 'Successful operation');
            return redirect()->route('type_recette.index');
        }    
    }

    //EDIT FUNCCTION
    public function destroy(TypeRecette $type_recette)
    {
        $type_recette->delete();
        session()->flash('message', "Successful operation");
        return redirect()->route('type_recette.index');
    }

}
