<?php

namespace App\Http\Controllers;

use App\Models\PriceConfig;
use App\Models\TypeEmballage;
use Illuminate\Http\Request;

class PriceConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isSeller');
    }
    
    public function index()
    {
        $price_reductions = PriceConfig::orderBy('id', 'DESC')
                                ->paginate(10);
        
        return view('price_config.index', compact('price_reductions'));
    }


    public function create()
    {
        $type_emballages = TypeEmballage::all();
        $price_reductions =PriceConfig::all();
        return view('price_config.create', compact('type_emballages', 'price_reductions'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'quantity_min' => ['required', 'integer'],
            'quantity_max' => ['required', 'integer'],
            'price' => ['required'],
        ]);

        if($request->quantity_min >= 0 AND $request->quantity_max)
        {   
            $PriceConfig = PriceConfig::create([
                'type_emballage_id' => $request->emballage_id,
                'quantity_min' => $request->quantity_min,
                'quantity_max' => $request->quantity_max,
                'price' => $request->price,
            ]);

            if($PriceConfig){
                session()->flash('message', 'Successful operation');
                return redirect(route('price_config.index'));
            }
            
        }else{
            session()->flash('message_err', 'The quantity must be greater than 0');
            return redirect()->route('price_config.create');
        }
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit(PriceConfig $price_config)
    {
        $type_emballages = TypeEmballage::all();
        $price_reductions =PriceConfig::all();

        return view('price_config.edit', compact('type_emballages', 'price_reductions', 'price_config'));
    }

    
    //UPDATE FUNCTION
    public function update(Request $request, PriceConfig $price_config)
    {
        $request->validate([
            'quantity_min' => ['required', 'integer'],
            'quantity_max' => ['required', 'integer'],
            'price' => ['required'],
        ]);

        if($request->quantity_min >= 0 AND $request->quantity_max)
        {   
            $price_config->update([
                'type_emballage_id' => $request->emballage_id,
                'quantity_min' => $request->quantity_min,
                'quantity_max' => $request->quantity_max,
                'price' => $request->price,
            ]);

            if($price_config){
                session()->flash('message', 'Successful operation');
                return redirect(route('price_config.index'));
            }
            
        }else{
            session()->flash('message_err', 'The quantity must be greater than 0');
            return redirect()->back();
        }
    }

    //EDIT FUNCCTION
    public function destroy(PriceConfig $price_config)
    {

        $price_config->delete();

        if($price_config)
        {
            session()->flash('message', "Successful operation");
            return redirect()->route('price_config.index');
        }else{
            session()->flash('message_err', "Operationa Failed");
            return redirect()->route('price_config.index');
        }
    }
}
