<?php

namespace App\Http\Controllers;

use App\Models\Bonus;
use App\Models\Client;
use App\Models\Production;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BonusController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isSeller');
    }
    
    public function index()
    {

        $today = date('d-m-Y');
        $dailys = Bonus::where('date_bonus', $today )
                        ->orderBy('id', 'DESC') 
                        ->get(); 
 
        $month = date('M');
        $year = date('Y');
        $months = Bonus::where('mois', $month )
                        ->where('annee', $year)
                        ->orderBy('id', 'DESC')     
                        ->get(); 
    
        $years = Bonus::where('annee', $year )
                        ->orderBy('id', 'DESC') 
                        ->paginate(10); 
 
        $bonus = Bonus::orderBy('id', 'DESC')->get();

        return view('bonus.index', compact('bonus', 'dailys', 'months', 'years', 'today', 'month', 'year'));
        
    }

   
    public function create()
    {
        
        if(isset($_GET['query'])){
            $search = $_GET['query'];
            $productions = Production::where('number', 'LIKE', '%' . $search . '%')
                                    ->where('quantity', '>', '0')
                                    ->paginate(5); 
            
            $clients = Client::all();                
            
            return view('bonus.search', compact('search', 'productions', 'clients'));
        }    

        $clients = Client::all();                

        $productions = Production::orderBy('created_at', 'DESC')
                                ->where('quantity', '>', '0')
                                ->paginate(5);

        return view('bonus.search', compact('productions', 'clients'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'bonus_price' => ['required'],
            'total_quantity' => ['integer'],
            'quantity' => ['integer'],
        ]);

        //SELLING A PRODUCT
        $bonus_quantity = $request->quantity;
        $product_quantity =  $request->total_quantity;   
        //REMAINING QUANTITY IN PRODUCT STOCK
        $remaining_stock = $product_quantity - $bonus_quantity;
        
        $month = date('M');
        $year = date('Y');
        $today = date('d-m-Y');
        
        $number_bonus = date('Y').'-'. date('m')  .'-'. rand(1000, 2500);

        if($bonus_quantity <= $product_quantity)
        {
            $bonus = Bonus::create([
                'quantity' => $request->quantity,
                'price' => $request->bonus_price,
                'production_id' => $request->production_id,
                'date_bonus' => $today,
                'mois' => $month,
                'annee' => $year,
                'bonus_number' => $number_bonus,
                'client_id' => $request->client
            ]);

            if($bonus){
                //update the production table quantity
                $production = DB::table('productions')
                                    ->where('id', $request->production_id)
                                    ->update(['quantity' => $remaining_stock ]);
                                    
                session()->flash('message', 'Bonus accordé au client avec succès');                                
                return redirect()->route('bonus.index');  
                
            }else{
                session()->flash('message_err', 'Erreur: Le Bonus n\'a pas été accordé');                                
                return redirect()->route('bonus.search');
            }                  

        }else{
            session()->flash('message_err', 'Erreur: Quantité indisponible');
            return redirect()->route('bonus.search');
        }
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy(Bonus $bonu)
    {
        //recover production before to delete the sale
        if($bonu->production){
            $bonu->production->update([
                'quantity' => $bonu->quantity + $bonu->production->quantity,
            ]);
        }
        
        $bonu->delete();

        session()->flash('message', 'Le Bonus a été supprimé avec succès');
        return redirect()->route('bonus.index');
    }
}
