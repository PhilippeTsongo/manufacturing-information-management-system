<?php

namespace App\Http\Controllers;

use App\Models\Mois;
use App\Models\Sale;
use App\Models\Dette;
use App\Models\Client;
use App\Models\Production;
use App\Models\AutreRecette;
use Illuminate\Http\Request;

class DetteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isFinancier');
    }
    
    public function index()
    {
        $today = date('d-m-Y');
        $dailys = Dette::where('date_dette', $today )
                        ->orderBy('id', 'DESC') 
                        ->get(); 

        $month = date('M');
        $year = date('Y');

        $months = Dette::where('mois', $month)
                        ->where('annee', $year)
                        ->orderBy('id', 'DESC')     
                        ->get();

        $years = Dette::where('annee', $year)
                        ->orderBy('id', 'DESC') 
                        ->paginate(10); 

        $dettes = Dette::all(); 
        $mois = Mois::all();

        return view('dette.index', compact('dettes', 'dailys', 'months', 'years', 'today', 'month', 'year', 'mois'));
    }

    
    public function create()
    {
        $clients = Client::all();

        $dettes = Dette::all();
        
        $productions = Production::where('quantity', '>', 0)->orderBy('id', 'DESC')->get();
        return view('dette.create', compact('clients', 'dettes', 'productions'));
    }
    
    public function store(Request $request)
    {
     
        $request->validate([
            'quantity' => ['integer'],
            'description' => ['string']
        ]);

        $month = date('M');
        $year = date('Y');
        $today = date('d-m-Y');

        $dette_number = rand(1000, 5000) .'-'. date('m') . '-'. rand(10, 90);

        $production_quantity = Production::where('id', $request->production)->get('quantity');

        if($request->quantity <= $production_quantity['0']->{'quantity'}) 
        {

            $rest_quantity = $production_quantity['0']->{'quantity'} - $request->quantity;
            if($request->montant > 0)
            { 
                $dette = Dette::create([
                    'dette_number' => $dette_number,
                    'quantity' => $request->quantity,
                    'montant' => $request->montant,
                    'description' => $request->description,
                    'montant_paye' => $request->montant_paye,
                    'date_dette' => $today,
                    'production_id' => $request->production,
                    'client_id' => $request->client,
                    'mois' => $month,
                    'annee' => $year
                ]);
                
                if($dette){

                    $production = Production::where('id', $request->production)
                                            ->update([
                                                'quantity' => $rest_quantity
                                            ]);

                    session()->flash('message', 'Dette enregistrée avec succès');
                    return redirect()->route('dette.index');
                }
            }else{
                session()->flash('message_err', 'Le montant doit être superieur à 0');
                return redirect()->route('dette.create');
            }
        }else{
            session()->flash('message_err', 'Quantité indisponible');
            return redirect()->route('dette.create');
        }
        
    }

    
    public function show($id)
    {
        //
    }

   
    public function edit(Dette $dette)
    {
        $clients = Client::all();

        $dettes = Dette::all();

        $productions = Production::orderBy('id', 'DESC')->get();

        return view('dette.edit', compact('dette', 'clients', 'dettes', 'productions'));
    }

   
    // public function update(Request $request, Dette $dette)
    // {
    //     $request->validate([
    //         'quantity' => ['integer'],
    //         'description' => ['string']
    //     ]);

    //     $month = date('M');
    //     $year = date('Y');
    //     $today = date('d-m-Y');

    //     $dette_number = rand(1000, 5000) .'-'. date('m') . '-'. rand(10, 90);

    //     $production_quantity = Production::where('id', $request->production)->get('quantity');

    //     if($request->quantity <= $production_quantity['0']->{'quantity'}) 
    //     {
    //         $rest_quantity = $production_quantity['0']->{'quantity'} - $request->quantity;
    //         if($request->montant > 0)
    //         { 
    //             $dette->update([
    //                 'dette_number' => $dette_number,
    //                 'quantity' => $request->quantity,
    //                 'montant' => $request->montant,
    //                 'description' => $request->description,
    //                 'montant_paye' => $request->montant_paye,
    //                 'date_dette' => $today,
    //                 'production_id' => $request->production,
    //                 'client_id' => $request->client,
    //                 'mois' => $month,
    //                 'annee' => $year
    //             ]);
                
    //             if($dette){

    //                 $production = Production::where('id', $request->production)
    //                                         ->update([
    //                                             'quantity' => $rest_quantity
    //                                         ]);

    //                 session()->flash('message', 'Dette enregistrée avec succès');
    //                 return redirect()->route('dette.index');
    //             }
    //         }else{
    //             session()->flash('message_err', 'Le montant doit être superieur à 0');
    //             return redirect()->route('dette.create');
    //         }
    //     }else{
    //         session()->flash('message_err', 'Quantité indisponible');
    //         return redirect()->route('dette.create');
    //     }
        
    // }

    
    public function destroy(Dette $dette)
    {
        $production_quantity = $dette->production->quantity;
        $dette_quantity = $dette->quantity;
        $recover = $production_quantity + $dette_quantity;
        
        if($dette->production)
        {
            $dette->production->update([
                'quantity' => $recover
            ]);
        }

        $dette_recette_recover = AutreRecette::where('recette_number', $dette->dette_number)->delete();
        //if($dette_recette_recover){ $dette_recette_recover->delete(); }

        $dette->delete();
        session()->flash('message', 'Dette suprimée avec succès');
        return redirect()->route('dette.index');
    }

    public function dette_payement_create (Dette $dette)
    {
        $clients = Client::all();

        $dettes = Dette::all();

        $productions = Production::orderBy('id', 'DESC')->get();
        return view ('dette.pay', compact('dette', 'clients', 'dettes', 'productions'));
    }

    public function dette_payement (Request $request)
    {
        if($request->montant >= $request->montant_paye)  
        {           
                $dette_du = Dette::where('id', $request->id)->get();

                $paid = $dette_du['0']->montant_paye + $request->montant_paye;

                $dette_pay = Dette::where('id', $request->id)->update([
                    'description' => $request->description,
                    'montant_paye' => $paid,
                ]);

                //dd($dette_pay);
                
                if($dette_pay){

                    $today = date('d-m-Y');
                    $month = date('M');
                    $year = date('Y');
                    
                    $recettes = AutreRecette::where('recette_number', $dette_du['0']->dette_number)->get();

                    if(count($recettes) >= 1){
                        $recettes['0']->update([
                            'montant' => $paid,
                        ]);

                        //dd($recettes['0']);

                        session()->flash('message', 'Dette payée avec succès');
                        return redirect()->route('dette.index');
                    }else{
                        $autre_recette = AutreRecette::create([
                            'recette_number' => $dette_du['0']->dette_number,
                            //'type_recette_id' => '',
                            'montant' => $paid,
                            'date_creation' => $today,
                            'mois' => $month,
                            'annee' => $year,
                            'description' => $request->description,
                        ]);
                        session()->flash('message', 'Dette payée avec succès');
                        return redirect()->route('dette.index');
                    }
                }
        }else{
            session()->flash('message_err', 'le montant à payer doit être inferieur ou égal au montant dû');
            return redirect()->route('dette_pay_create', $request->id);
        }
        return view ('dette.pay');
    }
}
