<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
   
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isProducer');
    }
    
    public function index()
    {
        $unities = Unit::all();
        return view('unit.index', compact('unities'));
    }


    public function create()
    {
        $unities = Unit::all();
        return view('unit.create', compact('unities'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:units'],
            
        ]);

        $unit = Unit::create([
            'name' => $request->name,            
        ]);

        if($unit){
            session()->flash('message', 'Successful operation');
            return redirect(route('unit.index'));
        }
        
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit(Unit $unit)
    {
        $unities = Unit::all();
        return view('unit.edit', compact('unit', 'unities'));
    }

    
    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
        ]);

        $unit->update([
            'name' => $request->name,
        ]);

        if($unit){
            session()->flash('message', 'Successful operation');
            return redirect()->route('unit.index');
        }    
    }

    //EDIT FUNCCTION
    public function destroy(Unit $unit)
    {
        $unit->delete();
        session()->flash('message', "Successful operation");
        return redirect()->route('unit.index');
    }

}
