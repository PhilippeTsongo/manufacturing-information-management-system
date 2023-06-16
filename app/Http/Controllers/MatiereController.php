<?php

namespace App\Http\Controllers;

use App\Models\Mois;
use App\Models\Unit;
use App\Models\Matiere;
use App\Models\TypeMatiere;
use Illuminate\Http\Request;
use App\Models\MatiereComptable;

class MatiereController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        //$this->middleware('isProducer');
    }

    public function index()
    {
        $matieres = Matiere::orderBy('id', 'DESC')
                            ->where('quantity', '>', 0)
                            ->paginate(10);
        $mois = Mois::all();
        return view('matiere.index', compact('matieres', 'mois'));
    }


    public function create()
    {
        $matieres = Matiere::where('quantity', '>', 0)->get();
        $type_matieres = TypeMatiere::all();
        $unities = Unit::all();
        return view('matiere.create', compact('matieres', 'type_matieres', 'unities'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer'],
            'purchase_price' => ['required']

        ]);

        if($request->quantity >= 0)
        {
        
                $today = date('d-m-Y');
                $month = date('M');
                $year = date('Y');

                $number = date('m') .'-'. rand(150, 350). rand(10, 39);

                $matiere = Matiere::create([
                    'matiere_number' => $number,
                    'name' => $request->name,
                    'type' => $request->type,
                    'quantity' => $request->quantity,
                    'purchase_price' => $request->purchase_price,
                    'mois' => $month,
                    'annee' => $year,
                    'unit_id' => $request->unit,
                    'date_matiere' => $today,
                ]);

                $matiere_comptable = MatiereComptable::create([
                    'matiere_number' => $number,
                    'name' => $request->name,
                    'type' => $request->type,
                    'quantity' => $request->quantity,
                    'purchase_price' => $request->purchase_price,
                    'mois' => $month,
                    'annee' => $year,
                    'unit_id' => $request->unit,
                    'date_matiere' => $today,
                ]);

                if($matiere && $matiere_comptable ){
                    session()->flash('message', 'Successful operation');
                    return redirect(route('matiere.index'));
                }
            
        }else{
            session()->flash('message', 'The quantity must be greater than 0');
            return redirect()->route('matiere.create');
        }
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit(Matiere $matiere)
    {
        $type_matieres = TypeMatiere::all();
        $matieres = Matiere::where('quantity', '>', 0)->get();
        $unities = Unit::all();
        
        return view('matiere.edit', compact('matiere', 'matieres', 'type_matieres', 'unities'));
    }

    
    //UPDATE FUNCTION
    public function update(Request $request, Matiere $matiere)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'quantity' => ['required', 'integer'],
            'purchase_price' => ['required']
        ]);

        if($request->quantity >= 0)
        {
            
                $month = date('M');
                $year = date('Y');

                $matiere->update([
                    'name' => $request->name,
                    'type' => $request->type,
                    'quantity' => $request->quantity,
                    'purchase_price' => $request->purchase_price,
                    'mois' => $month,
                    'annee' => $year,
                    'unit_id' => $request->unit,
                ]);

                $matiere_comptable = MatiereComptable::where('matiere_number', $matiere->matiere_number)
                                                    ->update([
                                                        'name' => $request->name,
                                                        'type' => $request->type,
                                                        'quantity' => $request->quantity,
                                                        'purchase_price' => $request->purchase_price,
                                                        'mois' => $month,
                                                        'annee' => $year,
                                                        'unit_id' => $request->unit,
                                                    ]);

                if($matiere && $matiere_comptable){
                    session()->flash('message', 'Edited successful');
                    return redirect()->route('matiere.index');
                }

                           
        }else{
            session()->flash('message_err', 'The quantity must be greater than 0');
            return redirect()->route('matiere.index');
        }
    }

    //EDIT FUNCCTION
    public function destroy(Matiere $matiere)
    {
        $matiere_comptable = MatiereComptable::where('matiere_number', $matiere->matiere_number)
                                            ->delete();

        $matiere->delete();
        session()->flash('message', "Matière supprimée avec succès");
        return redirect()->route('matiere.index');
    }

}
