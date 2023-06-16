<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Client;
use App\Models\PriceConfig;
use App\Models\Recette;
use App\Models\Production;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mois;

class SaleController extends Controller
{
   
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isSeller');
    }
    
    public function index()
    {

        $today = date('d-m-Y');
        $dailys_sales = Sale::where('date_sale', $today )
                        ->orderBy('id', 'DESC') 
                        ->get(); 
 
        $month = date('M');
        $year = date('Y');
        $months = Sale::where('mois', $month )
                        ->where('annee', $year)
                        ->orderBy('id', 'DESC')     
                        ->get(); 
    
        $years = Sale::where('annee', $year )
                        ->orderBy('id', 'DESC') 
                        ->paginate(10); 
 
        $sales = Sale::orderBy('id', 'DESC')->get();

        $mois = Mois::all();

        return view('sales.index', compact('sales', 'dailys_sales', 'months', 'years', 'today', 'month', 'year', 'mois'));
    }


    public function create()
    {
       
    }

   
    //STORE FUNCTION
    public function store(Request $request)
    {
        $request->validate([
            //'sale_price' => ['required'],
            'total_quantity' => ['integer'],
            'quantity' => ['integer'],
        ]);

        //SELLING A PRODUCT
        $sale_quantity = $request->quantity;
        $product_quantity =  $request->total_quantity;   
        
        //REMAINING QUANTITY IN PRODUCT STOCK
        $remaining_stock = $product_quantity - $sale_quantity;
        
        $month = date('M');
        $year = date('Y');
        $today = date('d-m-Y');
        
        $number_sale = date('m') .'-'. date('Y') .'-'. rand(100, 999). rand(0, 9);

        $productions = Production::where('id', $request->production_id)->get();
        foreach($productions as $production)
        { 
            $production->emballage->type_emballage->price_config;
            
            //dd($)

            if($production->emballage AND $production->emballage->type_emballage AND $production->emballage->type_emballage->price_config)
            {
                $production_prices = $production->emballage->type_emballage->price_config;

                //dd($production_prices);
                foreach($production_prices as $production_price)
                {
                    //dd($production_price);
                    $sale_price = PriceConfig::where('type_emballage_id', $production->emballage->type_emballage->id )
                                                ->where([
                                                        ['quantity_min', '<=', $sale_quantity],
                                                        ['quantity_max', '>=', $sale_quantity]
                                                    ])
                                                ->get('price');
                    if(count($sale_price) >=1 )
                    {
                        //dd($sale_price);
                        
                        if($sale_quantity <= $product_quantity)
                        {
                            //dd($request->id);
                            $sale = Sale::create([
                                'quantity' => $request->quantity,
                                'price' => $sale_price['0']->{'price'},
                                'production_id' => $request->production_id,
                                'date_sale' => $today,
                                'mois' => $month,
                                'annee' => $year,
                                'sale_number' => $number_sale,
                                'client_id' => $request->client
                            ]);

                            if($sale){
                                //update the production table quantity
                                $production = DB::table('productions')
                                                    ->where('id', $request->production_id)
                                                    ->update(['quantity' => $remaining_stock ]);
                                
                                         
                                    session()->flash('message', 'Production ' .$request->number . ' sans réduction vendue avec succès');                                
                                    return redirect()->route('sale.index'); 
                                }                    
                        }else{
                            session()->flash('message_err', 'Erreur: Quantité indisponible');
                            return redirect()->route('production.search');
                        }
                    }else{
                        session()->flash('message_err', 'Erreur: Le prix de vente n\'a pas encore été enregistré');
                        return redirect()->route('production.search');
                    }
                }
            }else{
                session()->flash('message_err', 'Erreur: Le prix de vente n\'a pas encore été enregistré');
                return redirect()->route('production.search');
            }
        }
            
    }

    public function show($id)
    {
        
    }

   
    public function edit(Sale $sale)
    {  
        return view('sales.edit', compact('sale'));
    }

    public function destroy(Sale $sale)
    {
        //recover production before to delete the sale
        if($sale->production){
            $sale->production->update([
                'quantity' => $sale->quantity + $sale->production->quantity,
            ]);
        }
        
        $sale->delete();

        session()->flash('message', 'La vente a été supprimée avec succès');
        return redirect()->route('sale.index');
    }

    public function search()
    {
        if(isset($_GET['query'])){
            $search = $_GET['query'];
            $productions = Production::where('number', 'LIKE', '%' . $search . '%')
                                    ->where('quantity', '>', '0')
                                    ->paginate(5); 
            
            //$productions = Production::orderBy('created_at', 'DESC')->get();

            $today = date('Y-m-d');
            $dailys = Sale::where('date_sale', $today )
                            ->orderBy('id', 'DESC') 
                            ->get(); 
     
            $month = date('m');
            $year = date('Y');
            $months = Sale::where('mois', $month )
                            ->where('annee', $year)
                            ->orderBy('id', 'DESC')     
                            ->get(); 
        
            $years = Sale::where('annee', $year )
                            ->orderBy('id', 'DESC') 
                            ->get();
            
            $clients = Client::all();                
            
            return view('production.search', compact('search', 'productions', 'dailys', 'months', 'years', 'today', 'month', 'year', 'clients'));
        }    

        $today = date('Y-m-d');
        $dailys = Sale::where('date_sale', $today )
                        ->orderBy('id', 'DESC') 
                        ->get(); 
 
        $month = date('m');
        $year = date('Y');
        $months = Sale::where('mois', $month )
                        ->where('annee', $year)
                        ->orderBy('id', 'DESC')     
                        ->get(); 
    
        $years = Sale::where('annee', $year )
                        ->orderBy('id', 'DESC') 
                        ->get(); 

        $clients = Client::all();                
 
        $sales = Sale::orderBy('id', 'DESC')->get();

        $productions = Production::orderBy('created_at', 'DESC')
                                ->where('quantity', '>', '0')
                                ->paginate(5);

        return view('production.search', compact('sales', 'dailys', 'months', 'years', 'today', 'month', 'year', 'productions', 'clients'));

       
    }    

    public function facture(Request $request)
    {
        $facture_id = $request->facture;

        //dump($request->price);
            //dd(count($facture_id));
       
    }

}
