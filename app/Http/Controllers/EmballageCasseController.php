<?php

namespace App\Http\Controllers;

use App\Models\Mois;
use App\Models\Emballage;
use Illuminate\Http\Request;
use App\Models\TypeEmballage;
use App\Models\EmballageCasse;
use Illuminate\Support\Facades\DB;

class EmballageCasseController extends Controller
{    
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isProducer');
    }
    
    public function index()
    {
        $emballage_casses = EmballageCasse::orderBy('id', 'DESC')
                                ->paginate(10);
        $mois = Mois::all();
        return view('emballage_casse.index', compact('emballage_casses', 'mois'));
    }


    public function create()
    {
        $emballages = Emballage::all();
        $type_emballages = TypeEmballage::all();

        return view('emballage_casse.create', compact('emballages', 'type_emballages'));
    }
    
    public function store(Request $request)
    {
       
        $request->validate([
            'quantity' => ['required', 'integer'],
        ]);

        if($request->quantity > 0)
        {   
            $today = date('d-m-Y');
            $month = date('M');
            $year = date('Y');

            $number = date('m') .'-'. rand(10, 80). rand(100, 400);

            $in_stocks = DB::table('emballages')->where('id', $request->emballage)->get('quantity');
            $quantity_stock = $in_stocks['0']->{'quantity'};
            
            if($request->quantity <= $quantity_stock)
            {
                $emballage_casse = EmballageCasse::create([
                    'number' => $number,
                    'quantity' => $request->quantity,
                    'emballage_id' => $request->emballage,
                    'mois' => $month,
                    'annee' => $year,
                    'date_emballage_casse' => $today
                ]);

                //update of the related emballage 
                $emballage_update = $emballage_casse->emballage->update([
                    'quantity' => $emballage_casse->emballage->quantity - $request->quantity,
                ]);

                if($emballage_casse &&  $emballage_update){
                    session()->flash('message', 'Emballage cassé crée avec succès');
                    return redirect(route('emballage_casse.index'));
                }
            }else{
                session()->flash('message_err', 'La quantité est indisponible');
                return redirect()->route('emballage_casse.create');
            }

        }else{
            session()->flash('message', 'La quantité doit être supérieur à 0');
            return redirect()->route('emballage_casse.create');
        }
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit(EmballageCasse $emballage)
    {
        // 
    }

    
    //UPDATE FUNCTION
    public function update(Request $request, EmballageCasse $emballage)
    {
        //    
    }

    //EDIT FUNCCTION
    public function destroy(EmballageCasse $emballage_casse)
    {
        if($emballage_casse->emballage)
        {
            $emballage_casse->emballage->update([
                'quantity' => $emballage_casse->emballage->quantity + $emballage_casse->quantity,
            ]);

            $emballage_casse->delete();
            session()->flash('message', "Emballage cassé supprimé avec succès");
            return redirect()->route('emballage_casse.index');
        
        }else{
            session()->flash('message', "L'emballage cassé n'a pas été supprimé avec succès");
            return redirect()->route('emballage_casse.index');
        }
    }


}
