<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Emballage;
use Illuminate\Http\Request;
use App\Models\TypeEmballage;
use App\Models\EmballageCasse;
use App\Models\EmballageComptable;
use App\Models\Mois;

class EmballageController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isProducer');
    }
    
    public function index()
    {
        $emballages = Emballage::orderBy('id', 'DESC')
                                ->where('quantity', '>', 0)
                                ->paginate(10);
        $mois = Mois::all();
        return view('emballage.index', compact('emballages', 'mois'));
    }


    public function create()
    {
        $emballages = Emballage::where('quantity', '>', 0)->get();
        $type_emballages = TypeEmballage::all();
        $unities = Unit::all();

        return view('emballage.create', compact('emballages',  'unities', 'type_emballages'));
    }
    
    public function store(Request $request)
    {
       

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer'],
            'purchase_price' => ['required'],

        ]);

        if($request->quantity > 0)
        {   
            

                $today = date('d-m-Y');
                $month = date('M');
                $year = date('Y');

                $number = date('Y') .'-'. rand(360, 700). rand(30, 9);

                $emballage = Emballage::create([
                    'emballage_number' => $number,
                'type_emballage_id' => $request->emballage_id,
                    'name' => $request->name,
                    'quantity' => $request->quantity,
                    'purchase_price' => $request->purchase_price,
                    'mois' => $month,
                    'annee' => $year,
                    'unit_id' => $request->unit,
                    'date_emballage' => $today,
                ]);

                $emballage_comptable = EmballageComptable::create([
                    'emballage_number' => $number,
                    'type_emballage_id' => $request->emballage_id,
                    'name' => $request->name,
                    'quantity' => $request->quantity,
                    'purchase_price' => $request->purchase_price,
                    'mois' => $month,
                    'annee' => $year,
                    'unit_id' => $request->unit,
                    'date_emballage' => $today,
                ]);

                if($emballage && $emballage_comptable){
                    session()->flash('message', 'Emballage crée avec succès');
                    return redirect(route('emballage.index'));
                }
            
           
        }else{
            session()->flash('message', 'La quantité doit être supérieur à 0');
            return redirect()->route('emballage.create');
        }
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit(Emballage $emballage)
    {
        $emballages = Emballage::where('quantity', '>', 0)->get();
        $unities = Unit::all();
        $type_emballages = TypeEmballage::all();

        return view('emballage.edit', compact('emballage', 'emballages', 'unities', 'type_emballages'));
    }

    
    //UPDATE FUNCTION
    public function update(Request $request, Emballage $emballage)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'quantity' => ['required', 'integer'],
            'purchase_price' => ['required'],

        ]);

        if($request->quantity > 0)
        {
            
                $month = date('M');
                $year = date('Y');

                $emballage->update([
                    'name' => $request->name,
                    'type_emballage_id' => $request->emballage_id,
                    'quantity' => $request->quantity,
                    'purchase_price' => $request->purchase_price,
                    'mois' => $month,
                    'annee' => $year,
                    'unit_id' => $request->unit,
                ]);

                $emballage_comptable = EmballageComptable::where('emballage_number', $emballage->emballage_number)
                                                        ->update([
                                                            'name' => $request->name,
                                                            'type_emballage_id' => $request->emballage_id,
                                                            'quantity' => $request->quantity,
                                                            'purchase_price' => $request->purchase_price,
                                                            'mois' => $month,
                                                            'annee' => $year,
                                                            'unit_id' => $request->unit,
                                                        ]);

                if($emballage && $emballage_comptable){
                    session()->flash('message', 'Emballage modifié avec succès');
                    return redirect()->route('emballage.index');
                }
            
           
        }else{
            session()->flash('message_err', 'La quantité doit être supérieur à 0');
            return redirect()->route('emballage.index');
        }
    }

    //EDIT FUNCCTION
    public function destroy(Emballage $emballage)
    {

        $emballage_comptable = EmballageComptable::where('emballage_number', $emballage->emballage_number)
                                                ->delete();
          
        $emballage_casse = EmballageCasse::where('emballage_id', $emballage->id)->delete();    
        
            // session()->flash('message', "Les emballage cassés de cet emballage n'ont pas été supprimés avec succès");
            // return redirect()->route('emballage.index');    
        
        $emballage->delete();
        session()->flash('message', "Emballage supprimé avec succès");
        return redirect()->route('emballage.index');
    }
}
