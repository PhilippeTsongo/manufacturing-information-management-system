<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;

class FactureController extends Controller
{

    //protected fpdf variable
    protected $fpdf;

    public function __construct()
    {

        //ASSIGNMENT OF ALL MY VARIABLES THE VALUE OF FPDF
        $this->fpdf = new Fpdf;

        $this->address = $this->fpdf;
        $this->title = $this->fpdf;
        $this->content = $this->fpdf;
        $this->total = $this->fpdf;
    }

    public function index(Request $request)
    {

        
        //GETTING INVOICES CONTENT FROM THE ARRAY OF THE SELECTED VALUES
        if(isset($request->select_fac))
        {
            $selects = $request->select_fac;  
            $today = date('d-m-Y');

            $auth = auth()->user()->name;

            $factures = Sale::whereIn('id', $selects)->get();

            
                //Create a page
                $this->fpdf->AddPage("P", 'a5' );
                $this->content->setFillColor(220, 220, 250);

                // $title = new FPDF('p','mm','a5');

                //content font
                $this->fpdf->SetFont('times', '', 16);
                $this->address->SetFont('Arial', 'B' ,10);
                $this->title->SetFont('Arial', '' ,10);
                $this->content->SetFont('Arial', '' ,10);
                $this->total->SetFont('Arial', '' ,10);

                //VIEW
                $this->address->cell('45', '10', " ", '0', '0', '', true);
                $this->address->cell('85', '10', "KANABE BUSINESS", '0', '1', '', true);
                $this->address->cell('45', '5', " ", '0', '1', '');
                //COMPANY INFO

                $this->address->cell('50', '5', "RCCM: CD/GOM/RCCM/22-B-01838 ", '0', '1');
                $this->address->cell('50', '5', "NIP: A2219998M", '0', '1');
                $this->address->cell('50', '5', "ID. NAT: 19-F4300-N22610P", '0', '1');
                $this->address->cell('50', '5', "COMPTE:(Equity BCDC): 000110050288200059706910", '0', '1');
                $this->address->cell('50', '5', "EMAIL: businessskanabe@gmail.com", '0', '1');
                $this->address->cell('50', '5', "TELEPHONE: (+243) 991 614 358 /(+243) 828 660 055", '0', '1');
                $this->address->cell('50', '5', "ADRESSE: 01 Av Accasias, Q. Les Volcans, Goma", '0', '1');

                $this->address->cell('50', '5', "", '0', '1');
                
                //INVOICE INFO AND CLIENT INFO

                $this->address->cell('90', '5', "FACTURE  ", '0', '0', '', TRUE);
                $this->address->cell('50', '5', "Nom: ". $factures['0']->client->name, '0', '1');
                $this->address->cell('90', '5', utf8_decode("Numéro: "). date('Y').'-'.date('m').rand(1000, 5000) , '0', '0');
                $this->address->cell('50', '5', utf8_decode("Numéro: "). $factures['0']->client->client_number, '0', '1');
                $this->address->cell('90', '5', utf8_decode("Date d'impréssion: ").$today, '0', '0');
                $this->address->cell('50', '5', utf8_decode("Tél: "). $factures['0']->client->tel , '0', '1');
                $this->address->cell('90', '5',"", '0', '0');
                $this->address->cell('50', '5', "Adresse: ".$factures['0']->client->address, '0', '1');


                //devider
                $this->address->cell('50', '10', "", '0', '1');

                //TITLE
                $this->title->Cell('60', '7', utf8_decode('Désignation(s)'), '1', '0', '', TRUE);
                $this->title->Cell('15', '7', utf8_decode('Qté'), '1', '0', '', TRUE);
                $this->title->Cell('20', '7', utf8_decode('Unité'), '1', '0', '', TRUE);
                $this->title->Cell('15', '7', 'P.U', '1', '0', '', TRUE);
                $this->title->Cell('20', '7', 'Prix Total', '1', '1', '', TRUE);


                //CONTENT
                $this->total = 0;
                foreach($factures as $facture){
                    $this->content->Cell('60', '7', $facture->production->category->name, '1', '0', '',);
                    $this->content->Cell('15', '7', $facture->quantity, '1', '0', '');
                    $this->content->Cell('20', '7', $facture->production->unit->name, '1', '0', '');
                    $this->content->Cell('15', '7', $facture->price . '$', '1', '0', '');
                    $this->content->Cell('20', '7', number_format($facture->price * $facture->quantity, 02) . '$', '1', '1', '');

                    //Computation of the invoice's total 
                    $this->total = $this->total + $facture->price * $facture->quantity; 
                }

                //DISPLAY THE TOTAL OF THE INVOICE
                $this->title->Cell('20', '3', '', '0', '1', '');
                $this->title->Cell('110', '7', 'Total', '0', '0', '');
                $this->content->Cell('20', '7', number_format($this->total, 02) . '$', '0', '1', '', TRUE);


                
                
                //OUTPUT 
                $this->fpdf->Output();

                exit;

           

        }else{
            session()->flash('message_err', 'Vous devez choisir une vente avant d\'imprimer une facture');
            return redirect()->back();   
        }

        
       
    }

  
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
     
        
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
