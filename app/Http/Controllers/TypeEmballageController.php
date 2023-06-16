<?php

namespace App\Http\Controllers;

use App\Models\TypeEmballage;
use Illuminate\Http\Request;

class TypeEmballageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isProducer');
    }
    
    public function index()
    {
        $type_emballages = TypeEmballage::all();
        return view('type_emballage.index', compact('type_emballages'));
    }


    public function create()
    {
        $type_emballages = TypeEmballage::all();
        return view('type_emballage.create', compact('type_emballages'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:type_emballages'],
            'description' => ['string', 'max:255'],
        ]);

        $validated = htmlspecialchars($request);
        if($validated)
        {
            $type_emballage = TypeEmballage::firstOrCreate([
                'name' => $request->name,      
                'description' => $request->description,            

            ]);

            if($type_emballage){
                session()->flash('message', 'Successful operation');
                return redirect(route('type_emballage.index'));
            }
        }else{
            session()->flash('message_err', 'Operation failed');
            return redirect(route('type_emballage.create'));   
        }     
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit(TypeEmballage $type_emballage)
    {
        $type_emballages = TypeEmballage::all();
        return view('type_emballage.edit', compact('type_emballage', 'type_emballages'));
    }

    
    public function update(Request $request, TypeEmballage $type_emballage)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:255'],
        ]);

        $validated = htmlspecialchars($request);
        if($validated)
        {
            $type_emballage->update([
                'name' => $request->name,      
                'description' => $request->description,            
            ]);

            if($type_emballage){
                session()->flash('message', 'Successful operation');
                return redirect(route('type_emballage.index'));
            }
        }else{
            session()->flash('message_err', 'Operation failed');
            return redirect(route('type_emballage.create'));   
        }
    }

    //EDIT FUNCCTION
    public function destroy(TypeEmballage $type_emballage)
    {
        $type_emballage->delete();
        session()->flash('message', "Successful operation");
        return redirect()->route('type_emballage.index');
    }
}
