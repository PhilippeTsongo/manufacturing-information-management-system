<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Unit;
use App\Models\User;
use App\Models\Bonus;
use App\Models\Category;
use App\Models\Dette;
use App\Models\Client;
use App\Models\Office;
use App\Models\Sortie;
use App\Models\Matiere;
use App\Models\Emballage;
use App\Models\UserToken;
use App\Models\Logistique;
use App\Models\Production;
use Illuminate\Http\Request;
use App\Models\CoutProduction;
use App\Models\TypeMatiere;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth'])->only('index');
        $this->middleware('IsAdmin');
        //$this->middleware('isEntrepreneur');

    }

    public function index()
    {
        $today = date('d-m-Y');
        $year = date('Y');

        $matieres = Matiere::where('date_matiere', $today)->get();

        $emballages = Emballage::where('date_emballage', $today)->get();

        $productions = Production::where('date_production', $today)->get();

        $cout_productions = CoutProduction::where('date_production', $today)->get();

        $sales = Sale::where('date_sale', $today)->get();

        $sorties = Sortie::where('date_sortie', $today)->get();

        $dettes = Dette::where('date_dette', $today)->get();

        //connected users
        $user_tokens = UserToken::all();
        foreach($user_tokens as $user_token){
           $user_con = $user_token->{'user_id'};
        }
        
        $online_users = User::where('id', $user_con)->get();

        $users = User::all();
        
        $clients = Client::all();
        
        $offices = Office::all();

        $logistiques = Logistique::all();

        $bonus = Bonus::where('date_bonus', $today)->get();

        $unites = Unit::all();
        $type_matieres = TypeMatiere::all();

        $requisitions = Production::where('quantity', '<', '50');

        $categories = Category::all();

        return view('dashboard.dashboard', compact('matieres', 'emballages', 'productions', 'cout_productions',
            'sales', 'sorties', 'dettes', 'users', 'online_users', 'clients', 'bonus', 'offices', 'logistiques', 
            'categories', 'unites', 'type_matieres', 'requisitions' 
        
        ));
    }

   
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
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

    
    public function destroy($id)
    {
        //
    }
}
