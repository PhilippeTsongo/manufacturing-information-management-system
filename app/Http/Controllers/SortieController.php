<?php

namespace App\Http\Controllers;

use App\Models\Mois;
use App\Models\Sortie;
use Illuminate\Http\Request;

class SortieController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isFinancier');
    }
    
    public function index()
    {
        $today = date('d-m-Y');
        $dailys = Sortie::where('date_sortie', $today )
                        ->orderBy('id', 'DESC')     
                        ->get(); 

        $month = date('M');
        $year = date('Y');

        $months = Sortie::where('mois', $month )
                        ->where('annee', $year)
                        ->orderBy('id', 'DESC')    
                        ->get();

        $years = Sortie::where('annee', $year )
                        ->orderBy('id', 'DESC')    
                        ->paginate(10); 

        $sorties = Sortie::all();

        $mois = Mois::all();
        return view('sortie.index', compact('sorties', 'dailys', 'months', 'years', 'today', 'month', 'year', 'mois'));
    }

   
    public function create()
    {
        $sorties = Sortie::all();

        return view('sortie.create', compact('sorties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'libelle' => ['required', 'max:100', 'min:3'],
            'montant' => ['required'],
        ]);

        $today = date('d-m-Y');
        $month = date('M');
        $year = date('Y');

        $sortie_number = date('Y') .'-'. rand(100, 999) . '-'. date('m');

      
        $sortie = Sortie::create([
            'sortie_number' => $sortie_number,
            'libelle' => $request->libelle,
            'montant' => $request->montant,
            'description' => $request->description,
            'date_sortie' => $today,
            'mois' => $month,
            'annee' => $year
        ]);
                
        session()->flash('message', 'Successful operation');
        return redirect()->route('sortie.index');

            
    }

    
    public function show($id)
    {
        //
    }

    public function edit(Sortie $sortie)
    {
        $sorties = Sortie::all();

        return view('sortie.edit', compact('sortie', 'sorties'));
    }

    
    public function update(Request $request, Sortie $sortie)
    {
        $request->validate([
            'libelle' => ['required', 'min:3', 'max:100'],
            'montant' => ['required']       
        ]);

        $today = date('d-m-Y');
        $month = date('M');
        $year = date('Y');

        $sortie_number = date('Y') .'-'. rand(100, 999) . '-'. date('m');

       	$sortie->update([
                'sortie_number' => $sortie_number,
                'libelle' => $request->libelle,
                'montant' => $request->montant,
                'description' => $request->description,
                'sortie_date' => $request->sortie_date,
                'date_sortie' => $today,
                'mois' => $month,
                'annee' => $year

            ]);

            session()->flash('message', 'Successful Operation');
            return redirect()->route('sortie.index'); 
                   
    }

    
    public function destroy(Sortie $sortie)
    {
        $sortie->delete();
        session()->flash('message', 'Successful operation');
        return redirect()->route('sortie.index');
    }
}
