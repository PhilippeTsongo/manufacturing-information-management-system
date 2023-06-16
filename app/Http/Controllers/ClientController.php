<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isSeller');
    }
    
    public function index()
    {
        $clients = Client::orderBy('client_number', 'DESC')->get();

        return view('client.index', compact('clients'));
    }

    public function create()
    {
        $clients = Client::orderBy('client_number', 'DESC')->get();
        return view('client.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:20', 'min:3'],
            'email' => ['email'],
            'address' => ['required', 'max:50', 'min:3'],
            'tel' => ['required', 'max:13', 'min:10', 'unique:clients']
        ]);

        if(is_numeric($request->tel))
        { 
            $client_number = date('m') .'-'. rand(100, 999). rand(0, 9);
                        
            $client = Client::firstOrCreate([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'tel' => $request->tel,
                'client_number' => $client_number
            ]);
                    
            session()->flash('message', 'Client crée avec succès');
            return redirect()->route('client.index');
        }else{
            session()->flash('message_err', 'Le numéro de télephone ne doit pas avoir des lettres ou des signes');
            return redirect()->route('client.create');
        }

    }    

    public function show($id)
    {
        //
    }

   
  
    public function edit(Client $client)
    {
        $clients = Client::orderBy('client_number', 'DESC')->get();

        return view('client.edit', compact('client', 'clients'));
    }

    
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => ['string', 'min:3', 'max:50'],
            'email' => ['email'],
            'address' => ['string', 'max:50', 'min:3'],
            'tel' => ['required', 'max:15', 'min:10']
        ]);

        if(is_numeric($request->tel))
        {
            $client_number = date('m') .'-'. rand(100, 999). rand(0, 9);

            $client->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'tel' => $request->tel,
                'client_number' => $client_number
            ]);

            session()->flash('message', 'Client Modifié avec succès');
            return redirect()->route('client.index');  
        }else{
            session()->flash('message_err', 'Le numéro de télephone ne doit pas avoir des lettres ou des signes');
            return redirect()->route('client.create');
        }       
    }
   
    public function destroy(Client $client)
    {
        if($client->dette)
        {
            $client->dette->delete();
        }

        $client->delete();   
        session()->flash('message', 'Client supprimmé avec succès');
        return redirect()->route('client.index');
    }
}
