<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dette;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Http\Controllers\Controller;


class DetteRapportController extends Controller
{

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

    public function dette_rapport(Request $request, $month)
    {
        //dd($month);
        
        //GETTING INVOICES CONTENT FROM THE ARRAY OF THE SELECTED VALUES
        if(isset($month))
        {
            $today = date('d-m-Y');

            if(auth()->user()){
                $auth = auth()->user()->name;
            }

            $dettes = Dette::where('mois', $month)
                                ->where('annee', date('Y'))
                                ->get();

            
                //Create a page
                $this->fpdf->AddPage("L", 'a4' );
                $this->content->setFillColor(220, 220, 250);

                // $title = new FPDF('p','mm','a5');

                //content font
                $this->fpdf->SetFont('times', '', 16);
                $this->address->SetFont('Arial', 'B' ,10);
                $this->title->SetFont('Arial', '' ,10);
                $this->content->SetFont('Arial', '' ,10);
                $this->total->SetFont('Arial', '' ,10);

                //VIEW
                $this->address->cell('120', '10', " ", '0', '0', '', true);
                $this->address->cell('157', '10', "KANABE BUSINESS", '0', '1', '', true);
                $this->address->cell('45', '5', " ", '0', '1', '');
                //COMPANY INFO

                $this->address->cell('50', '5', "RCCM: CD/GOM/RCCM/22-B-01838 ", '0', '1');
                $this->address->cell('50', '5', "NUMERO IMPOT: A2219998 ", '0', '1');
                $this->address->cell('50', '5', "EMAIL: businessskanabe@gmail.com", '0', '1');
                $this->address->cell('50', '5', "TELEPHONE: (+243) 991 614 358 /(+243) 828 660 055", '0', '1');
                $this->address->cell('50', '5', "ADRESSE: 01 Av Accasias, Q. Les Volcans, Goma", '0', '1');

                $this->address->cell('50', '9', "DATE: " . date('d-m-Y'), '0', '1');
                $this->address->cell('50', '3', "", '0', '1');
                

                $this->address->cell('50', '5', "DEBTS LIST OF " . strtoupper($month), '0', '1');
            
                //devider
                $this->address->cell('50', '5', "", '0', '1');

                //TITLE
                $this->title->Cell('22', '7', utf8_decode('Date'), '1', '0', '', TRUE);
                $this->title->Cell('35', '7', utf8_decode('Client'), '1', '0', '', TRUE);
                $this->title->Cell('22', '7', utf8_decode('Montant'), '1', '0', '', TRUE);
                $this->title->Cell('22', '7', utf8_decode('Payed'), '1', '0', '', TRUE);
                $this->title->Cell('22', '7', utf8_decode('Due'), '1', '0', '', TRUE);
                $this->title->Cell('55', '7', utf8_decode('Produit'), '1', '0', '', TRUE);

                $this->title->Cell('98', '7', utf8_decode('Description'), '1', '1', '', TRUE);

                //CONTENT
                $this->total = 0;
                foreach($dettes as $dette){
                    $this->content->Cell('22', '7', $dette->date_dette, '1', '0', '');
                    if($dette->client)
                    {
                        $this->content->Cell('35', '7', $dette->client->name, '1', '0', '');
                    }else{
                        $this->content->Cell('35', '7', '', '1', '0', '');
                    }

                    $this->content->Cell('22', '7', number_format($dette->montant, 02 ). '$', '1', '0', '');
                    $this->content->Cell('22', '7', number_format($dette->montant_paye, 02 ). '$', '1', '0', '');
                    $this->content->Cell('22', '7', number_format($dette->montant - $dette->montant_paye, 02 ). '$', '1', '0', '');

                    if($dette->production)
                    {
                        if($dette->production->emballage)
                        {
                            if($dette->production->emballage->type_emballage)
                            {
                                $this->content->Cell('55', '7', $dette->production->emballage->type_emballage->name, '1', '0', '');
                            }else{
                                $this->content->Cell('55', '7', '', '1', '0', '');
                            }
                        }else{
                            $this->content->Cell('55', '7', '', '1', '0', '');
                        }
                    }else{
                        $this->content->Cell('55', '7', '', '1', '0', '');
                    }

                    $this->content->Cell('98', '7', $dette->description, '1', '1', '');

                    //Computation of the invoice's total 
                    $this->total = $this->total + (number_format($dette->montant - $dette->montant_paye, 02 )); 
                }

                //DISPLAY THE TOTAL OF THE INVOICE
                $this->title->Cell('20', '3', '', '0', '1', '');
                $this->title->Cell('102', '7', 'Total', '0', '0', '');
                $this->content->Cell('20', '7', number_format($this->total, 02) . '$', '0', '1', '', TRUE);

                //OUTPUT 
                $this->fpdf->Output();

                exit;

        

        }else{
            session()->flash('message_err', 'You must select the month');
            return redirect()->back();   
        }


    }

}
