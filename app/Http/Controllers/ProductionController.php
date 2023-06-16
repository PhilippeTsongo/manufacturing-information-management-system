<?php

namespace App\Http\Controllers;

use App\Models\Mois;
use App\Models\Unit;
use App\Models\Matiere;
use App\Models\Category;
use App\Models\Emballage;
use App\Models\Production;
use Illuminate\Http\Request;
use App\Models\CoutProduction;
use App\Models\MatiereProduction;
use Illuminate\Support\Facades\DB;
use App\Models\ProductionComptable;
use App\Models\ProductionProvisoire;
use App\Models\ProductionMatiereQuantity;
use App\Models\ProductionEmballageQuantity;

class ProductionController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isProducer');
    }
    
    public function index()
    {
        $today = date('d-m-Y');
        $dailys = Production::where('date_production', $today )
                        ->orderBy('id', 'DESC') 
                        ->get(); 
 
        $monthly = date('M');
        $yearly = date('Y');
        $months = Production::where('mois', $monthly )
                        ->orderBy('id', 'DESC') 
                        ->where('annee', $yearly)
                        ->get(); 
    
        $years = Production::where('annee', $yearly )
                        ->orderBy('id', 'DESC') 
                        ->paginate(10); 

        $productions = Production::orderBy('date_production', 'DESC')->get();

        $mois = Mois::all();

        return view('production.index', compact('productions', 'today', 'dailys', 'months', 'monthly', 'years', 'yearly', 'mois'));
    }

    public function create()
    {
        $productions = Production::OrderBy('updated_at', 'DESC')->get();

        $emballages = Emballage::where('quantity', '>', 0)->get();
        $matieres = Matiere::where('quantity', '>', 0)->get();
        $unities = Unit::all();
        $categories = Category::all();

        return view('production.create', compact('productions', 'emballages', 'matieres', 'unities', 'categories'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => ['integer'],
            // 'sale_price' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'unit' => ['integer'],
            //'matiere' => ['integer'],
            //'matiere_quantity' => ['required', 'integer'],
            'emballage' => ['integer'],
            'emballage_quantity' => ['required', 'integer'],
        ]);

        //not a negative number should be taken
        
            if($request->quantity > 0)
            {
                
                if($request->emballage_quantity > 0)
                {
                    //production saving
                    $today = date('d-m-Y');
                    $number = date('d') . '-' . date('m'). '-' .date('Y') .'-'. rand(100, 999) .'-' .rand(0, 9);
                    $month = date('M');
                    $year = date('Y');

                    //the quantity entered must be less or equal than the quantity in stock
                    
                    //quantity emballage in stock
                    $emballages = DB::table('emballages')->where('id', $request->emballage)->get();
                    
                    foreach($emballages as $emballage){
                            
                        $emballage_quantity = $emballage->{'quantity'};
                        $emballage_price = $emballage->{'purchase_price'};
                        $emballage_name = $emballage->{'name'};
                                            
                        if($request->emballage_quantity <= $emballage_quantity)
                        {                        
                            //reste d'emballages en stock
                            $reste_emballage = $emballage_quantity - $request->emballage_quantity;

                            $stock_emballage = Emballage::where('id', $request->emballage)
                                                        ->update(['quantity' => $reste_emballage]);
                            
                            //save real production in the db
                            $create_production = Production::create([
                                'number' => $number,
                                'category_id' => $request->category,
                                'quantity' => $request->quantity,
                                // 'sale_price' => $request->sale_price,
                                'mois' => $month,
                                'annee' => $year,
                                'date_production' => $today,
                                'emballage_id' => $request->emballage,
                                'emballage_quantity' => $request->emballage_quantity,
                                'unit_id' => $request->unit
                            ]);

                            //Production Comptable
                            if($create_production){

                                $create_production_provisoire = ProductionProvisoire::create([
                                    'number' => $number,
                                    'category_id' => $request->category,
                                    'quantity' => $request->quantity,
                                    // 'sale_price' => $request->sale_price,
                                    'mois' => $month,
                                    'annee' => $year,
                                    'date_production' => date('Y-m-d'),
                                    'emballage_id' => $request->emballage,
                                    'emballage_quantity' => $request->emballage_quantity,
                                    'unit_id' => $request->unit
                                ]);

                                if($create_production_provisoire){
                                    
                                    //calcul du prix d'emballage consommés
                                    $amount_sortie_emballage = $request->emballage_quantity * $emballage_price; 
                                    
                                    $cout_production = CoutProduction::create([
                                        'production_number' => $number,
                                        'libelle' => 'Cout De Production Numéro '. $number,
                                        'montant' => $amount_sortie_emballage,
                                        'description' => 'Cout de Production de la quantité de '. $request->emballage_quantity . ' ' . $emballage_name  .' D\'emballages',
                                        'date_production' => $today,
                                        'mois' => $month,
                                        'annee' => $year
                                    ]);    

                                    session()->flash('message', 'Production créée avec succès');
                                    return redirect()->route('production.index');

                                }else{
                                    session()->flash('message_err', 'Erreur: La production n\'a pas été créée');
                                    return redirect()->route('production.create'); 
                                }
                            }else{
                                session()->flash('message_err', 'Erreur: La production n\'a pas été créée');
                                return redirect()->route('production.create'); 
                            }

                        }else{
                            $update_production = ProductionProvisoire::where('emballage_quantity', '>', $emballage_quantity)->delete();
                            //$update_production->delete();   

                            session()->flash('message_err', 'Erreur: La quantité d\'emballages est indisponible');
                            return redirect()->route('production.create');   
                        }
                    }
                }else{
                    session()->flash('message_err', 'La quantité de la matière doit être supérieur à 0');
                    return redirect()->route('production.create');
                }

            }else{
                session()->flash('message_err', 'La quantité doit être supérieur à 0');
                return redirect()->route('production.create');
            }
       

    }


    public function show(Production $production)
    {
        $production_comptables = ProductionProvisoire::where('number', $production->number)->get();
        //dd($production_comptables);
        
        $production_ = Production::where('number', $production->number)->get();

        return view('production.show', compact('production_comptables', 'production_'));
    }


    public function edit(Production $production)
    {
        $productions = Production::OrderBy('created_at', 'DESC')->get();

        $emballages = Emballage::where('quantity', '>', 0)->get();
        $matieres = Matiere::all();
        $unities = Unit::all();
        $categories = Category::all();

        return view('production.edit', compact('production', 'productions', 'emballages', 'matieres', 'unities', 'categories'));

    }

    public function destroy(Production $production)
    {
        //matiere recover
        if($production->production_matiere_quantities){

            foreach($production->matieres as $production_matiere)
            {
                foreach($production->production_matiere_quantities as $recovered_production)
                {
                    foreach($production->matieres as $production_matiere_id)
                    {
                        if($production->matieres)
                        {
                            //update the in stock matiere quantity + the matiere quantity to be deleted
                            $update_recover_matiere = Matiere::where('id', $production_matiere_id->id)
                                                            ->update([
                                                                'quantity' => $production_matiere->quantity + $recovered_production->matiere_quantity,
                                                            ]);

                            //delete the production matiere quantity                                
                            if( $update_recover_matiere)
                            {                   
                                $delete_production_quantity = DB::table('production_matiere_quantities')->where('production_id', $production->id)
                                                                                                        ->delete();
                                
                                //delete the many to many relationship matiere_production                            
                                $delete_production_many = DB::table('matiere_production')//->where('matiere_id', $production_matiere_id->id)
                                                            ->where('production_id', $production->id )
                                                            ->delete();
                            }                 
                        }
                    }
                }
            }
        }

        //embalage recover
        // if($production->production_emballage_quantities){
        //     foreach($production->emballages as $production_emballage)
        //     {
        //         foreach($production->production_emballage_quantities as $recovered_emballage)
        //         {
        //             foreach($production->emballages as $production_emballage_id)
        //             {
        //                 if($production->emballages)
        //                 {
        //                     //update the in stock emballage quantity + the emballage quantity to be deleted
        //                     $update_recover_emballage = Emballage::where('id', $production_emballage_id->id)
        //                                                     ->update([
        //                                                         'quantity' => $production_emballage->quantity + $recovered_emballage->emballage_quantity,
        //                                                     ]);

        //                     //delete the production emballage quantity                                
        //                     if( $update_recover_emballage)
        //                     {                   
        //                         $delete_production_emballages_quantity = DB::table('production_emballages_quantities')->where('production_id', $production->id)
        //                                                                                                 ->delete();
                                
        //                         //delete the many to many relationship matiere_production                            
        //                         $delete_production_many = DB::table('emballage_production')//->where('matiere_id', $production_matiere_id->id)
        //                                                     ->where('production_id', $production->id )
        //                                                     ->delete();
        //                     }                 
        //                 }
        //             }
        //         }
        //     }
        // }


        //matiere emballage
        if($production->emballage){
            $production->emballage->update([
                'quantity' => $production->emballage_quantity + $production->emballage->quantity,
            ]);
        }

        //delete cout de production
        $cout_production = CoutProduction::where('production_number', $production->number);
        $cout_production->delete();

        //delete production comptable
        $production_comptable = ProductionProvisoire::where('number', $production->number);
        if($production_comptable){
            $production_comptable->delete();
        }

        //delete prodction lastly
        $production->delete();

        session()->flash('message', 'Production supprimiée avec succès');
        return redirect()->route('production.index');
    }

    //REQUISITION
    public function requisition()
    {
        $rec_basics = Production::where('quantity', '<', '10')->get();

        $rec_businesses = Production::where('quantity', '<', '30')->get();

        $rec_pros = Production::where('quantity', '<', '50')->paginate(10);

        $mois = Mois::all();

        return view('production.requisition', compact('rec_basics', 'rec_businesses', 'rec_pros', 'mois'));
    }


    public function allocate_matiere(ProductionProvisoire $production)
    {
        $matieres = Matiere::where('quantity', '>', 0)->get();
        $production_ = Production::where('number', $production->number)->get();

        //dd($production_);
        return view('production.allocate_matiere_create', compact('matieres', 'production_'));
    }

    public function allocate_matiere_save(Request $request)
    {
        
        $request->validate([
            'matiere_quantity' => ['integer'],
            'matiere' => ['integer'],
        ]);

        $production_id = $request->production;
        $production_number = $request->number;

        $matieres = Matiere::where('id', $request->matiere)->get();
        
        foreach($matieres as $matiere){
            if($request->matiere_quantity <= $matiere->quantity){

                $save_matiere = $matiere->productions()->attach($production_id);

                //Update quantity
                $update_matieres = Matiere::where('id', $request->matiere)
                ->update(['quantity' => $matiere->quantity - $request->matiere_quantity ]);

                //save matiere quantity
                $matiere_quantity = ProductionMatiereQuantity::create([
                    'production_id' => $production_id,
                    'matiere_quantity' => $request->matiere_quantity,
                    'number' => $production_number,
                    'unit' => $request->unit
                ]);

                //Cout de production update
                $cout_productions = CoutProduction::where('production_number', $production_number)
                                                ->get('montant');
                if(count($cout_productions) >= 1)
                {
                    //dd($cout_productions);
                    $cout_emballage = $cout_productions['0']->montant;
                    $cout_matiere = $request->matiere_quantity * $matiere->purchase_price;
                    $cout_production = $cout_emballage + $cout_matiere;

                    $cout_productions = CoutProduction::where('production_number', $production_number)
                                                        ->update(['montant' => $cout_production]);
                    
                    session()->flash('message', 'Matière première attribuée avec succès');
                    return redirect()->back(); 
                }else{
                    session()->flash('message_err', 'Erreur: Matière première n\'a pas été attribuée');
                    return redirect()->back(); 
                }

            }else{
                session()->flash('message_err', 'Quantité de matière première indisponible');
                return redirect()->back(); 
            }

        }
                            
                                
            
    }

    // public function allocate_emballage(ProductionProvisoire $production)
    // {
    //     $emballages = Emballage::where('quantity', '>', 0)->get();
    //     $production_ = Production::where('number', $production->number)->get();

    //     //dd($production_);
    //     return view('production.allocate_emballage_create', compact('emballages', 'production_'));
    // }

    // public function allocate_emballage_save(Request $request)
    // {
        
    //     $request->validate([
    //         'emballage_quantity' => ['integer'],
    //         'emballage' => ['integer'],
    //     ]);

    //     $production_id = $request->production;
    //     $production_number = $request->number;

    //     $emballages = Emballage::where('id', $request->emballage)->get();
        
    //     //dd($emballages);
    //     foreach($emballages as $emballage){
    //         if($request->emballage_quantity <= $emballage->quantity)
    //         {
    //             $save_emballage = $emballage->productions()->attach($production_id);

    //             //Update quantity
    //             $update_emballages = Emballage::where('id', $request->emballage)
    //             ->update(['quantity' => $emballage->quantity - $request->emballage_quantity ]);

    //             //save matiere quantity
    //             $emballage_quantity = ProductionEmballageQuantity::create([
    //                 'production_id' => $production_id,
    //                 'emballage_quantity' => $request->emballage_quantity,
    //                 'number' => $production_number,
    //                 'unit' => $request->unit
    //             ]);

    //             //Cout de production update
    //             $cout_productions = CoutProduction::where('production_number', $production_number)
    //                                             ->get('montant');
    //             if(count($cout_productions) >= 1)
    //             {
    //                 //dd($cout_productions);
    //                 $cout_matiere = $cout_productions['0']->montant;
    //                 $cout_emballage = $request->emballage_quantity * $emballage->purchase_price;
    //                 $cout_production = $cout_matiere + $cout_emballage;

    //                 $cout_productions = CoutProduction::where('production_number', $production_number)
    //                                                     ->update(['montant' => $cout_production]);
                    
    //                 session()->flash('message', 'Emballage attribué avec succès');
    //                 return redirect()->back(); 
    //             }else{
                    
    //                 session()->flash('message_err', 'Erreur: L\'Emballage n\'a pas été attribué');
    //                 return redirect()->back(); 
    //             }

    //         }else{
    //             session()->flash('message_err', 'Erreur: Quantité d\'emballage indisponible');
    //             return redirect()->back(); 
    //         }
    //     }
    // }
}

