<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Justification;

class JustificationController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isFinancier');
    }
   
    public function index()
    {
        $justifications = Justification::orderBy('created_at', 'DESC')->paginate(10);
                            
        return view('justification.index', compact('justifications'));
    }

    public function create()
    {
        $justifications = Justification::OrderBy('created_at', 'DESC')
                            ->get();                   

        return view('justification.create', compact('justifications'));

    }
    
    public function store(Request $request)
    {
        $request->validate([
            'justification' => ['required', 'min:3', 'max:50'],
            'image' => ['required']
        ]);

        if ($request->hasFile('image')) 
        {
            $month = date('M');
            $year = date('Y');
            $today = date('d-m-Y');
            $number = rand(200, 600) .'-'. date('m') . '-'. rand(10, 90);
    
            //image 
            $file = $request->file('image');
            $file_name = $file->getClientOriginalName();
            $destination = public_path().'/piece_justification';
            $file->move($destination, $file_name);
            
            //save
            $justification = Justification::create([
                'justification' => $request->justification,
                'justification_date' => $today,
                'image' => '/piece_justification/'.$file_name,
                'mois' => $month,
                'annee' => $year,
                'justification_number' => $number
            ]);
    
            if($justification){
                session()->flash('message', 'Successful operation');
                return redirect()->route('justification.index');
            }
        }else{
            session()->flash('message_err', 'You must select a file(jpg, png, pdf)');
            return redirect()->route('justification.create');
        }
    }
    
    public function show($id)
    {
        //
    }

    
    public function edit(Justification $justification)
    {
        // $justifications = Justification::orderBy('created_at', 'DESC')->get();

        // return view('justification.edit', compact('justification', 'justifications'));
    }

    
    public function update(Request $request, Justification $justification)
    {
        
    }

    public function destroy(Justification $justification)
    {
        $justification->delete();
        session()->flash('message', 'file delepted successfully');
        return redirect()->route('justification.index');
    }

    
}
