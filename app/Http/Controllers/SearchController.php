<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Client;
use App\Models\Matiere;
use App\Models\Category;
use App\Models\Emballage;
use App\Models\Production;
use App\Models\Sortie;
use Illuminate\Http\Request;
use App\Models\TypeEmballage;

class SearchController extends Controller
{
    
    public function index()
    {
        //
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

    public function general_search()
    {
        if(isset($_GET['query'])){
            $search = $_GET['query'];
            $productions = Production::where('date_production', 'LIKE', '%' . $search . '%')
                                    ->where('quantity', '>', '0')
                                    ->paginate(10); 
                                    
            $sales = Sale::where('date_sale', 'LIKE', '%' . $search . '%')
            ->where('quantity', '>', '0')
            ->orderBy('id', 'DESC')
            ->paginate(10);
            
            $emballages = Emballage::where('name', 'LIKE', '%' . $search . '%')
            ->where('quantity', '>', '0')
            ->orderBy('id', 'DESC')
            ->paginate(10); 

            $matieres = Matiere::where('name', 'LIKE', '%' . $search . '%')
            ->where('quantity', '>', '0')
            ->orderBy('id', 'DESC')
            ->paginate(10); 

            $type_emaballages = TypeEmballage::where('name', 'LIKE', '%' . $search . '%')
            ->orderBy('id', 'DESC')
            ->paginate(10);

            $clients = Client::where('name', 'LIKE', '%' . $search . '%')
            ->orderBy('id', 'DESC')
            ->paginate(10);

            $categories = Category::where('name', 'LIKE', '%' . $search . '%')
            ->orderBy('id', 'DESC')
            ->paginate(10);

            $charges = Sortie::where('libelle', 'LIKE', '%' . $search . '%')
            ->orderBy('id', 'DESC')
            ->paginate(10);

            if(count($productions) > 0 )
            {
                $data = array(
                    'search' => $search,
                    'message' => 'Production',
                    'items' => $productions, 
                );

                return view('search.search', compact('data'));
            }

            if(count($sales) > 0 )
            {
                $data = array(
                    'search' => $search,
                    'message' => 'Vente',
                    'items' => $sales, 
                );

                return view('search.search', compact('data'));
            }

            if(count($emballages) > 0 )
            {
                $data = array(
                    'search' => $search,
                    'message' => 'emballages',
                    'items' => $emballages, 
                );

                return view('search.search', compact('data'));
            }

            if(count($matieres) > 0 )
            {
                $data = array(
                    'search' => $search,
                    'message' => 'Matieres',
                    'items' => $matieres, 
                );

                return view('search.search', compact('data'));
            }

            if(count($type_emaballages) > 0 )
            {
                $data = array(
                    'search' => $search,
                    'message' => 'type d\'emballage',
                    'items' => $type_emaballages, 
                );

                return view('search.search', compact('data'));
            }

            if(count($clients) > 0 )
            {
                $data = array(
                    'search' => $search,
                    'message' => 'Client',
                    'items' => $clients, 
                );

                return view('search.search', compact('data'));
            }
            
            if(count($categories) > 0 )
            {
                $data = array(
                    'search' => $search,
                    'message' => 'Catégorie',
                    'items' => $categories, 
                );

                return view('search.search', compact('data'));
            }
            
            if(count($charges) > 0 )
            {
                $data = array(
                    'search' => $search,
                    'message' => 'Charges',
                    'items' => $charges, 
                );

                return view('search.search', compact('data'));
            }else{
                session()->flash('message_err', 'Error: no data');
                return redirect()->back();
            }
         
        }    
    }    

}
