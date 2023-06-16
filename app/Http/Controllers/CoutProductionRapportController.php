<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoutProduction;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Http\Controllers\Controller;
  

class CoutProductionRapportController extends Controller
{
    //
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

    public function cout_production_rapport(Request $request, $month)
    {
        //dd($month);
        
        //GETTING INVOICES CONTENT FROM THE ARRAY OF THE SELECTED VALUES
        if(isset($month))
        {
            $today = date('d-m-Y');

            if(auth()->user()){
                $auth = auth()->user()->name;
            }

            $cout_productions = CoutProduction::where('mois', $month)
                                ->where('annee', date('Y'))
                                ->get();

            
                //Create a page
                $this->fpdf->AddPage("P", 'a4' );
                $this->content->setFillColor(220, 220, 250);

                // $title = new FPDF('p','mm','a5');

                //content font
                $this->fpdf->SetFont('times', '', 16);
                $this->address->SetFont('Arial', 'B' ,10);
                $this->title->SetFont('Arial', '' ,10);
                $this->content->SetFont('Arial', '' ,10);
                $this->total->SetFont('Arial', '' ,10);

                //VIEW
                $this->address->cell('75', '10', " ", '0', '0', '', true);
                $this->address->cell('115', '10', "KANABE BUSINESS", '0', '1', '', true);
                $this->address->cell('45', '5', " ", '0', '1', '');
                //COMPANY INFO

                $this->address->cell('50', '5', "RCCM: CD/GOM/RCCM/22-B-01838 ", '0', '1');
                $this->address->cell('50', '5', "NUMERO IMPOT: A2219998 ", '0', '1');
                $this->address->cell('50', '5', "EMAIL: businessskanabe@gmail.com", '0', '1');
                $this->address->cell('50', '5', "TELEPHONE: (+243) 991 614 358 /(+243) 828 660 055", '0', '1');
                $this->address->cell('50', '5', "ADRESS: 01 Av Accasias, Q. Les Volcans, Goma", '0', '1');

                $this->address->cell('50', '9', "DATE: " . date('d-m-Y'), '0', '1');
                $this->address->cell('50', '3', "", '0', '1');
                

                $this->address->cell('50', '5', "LIST OF PRODUCTION COST " . strtoupper($month), '0', '1');
            
                //devider
                $this->address->cell('50', '5', "", '0', '1');

                //TITLE
                $this->title->Cell('22', '7', utf8_decode('Date'), '1', '0', '', TRUE);
                $this->title->Cell('141', '7', utf8_decode('Libellé'), '1', '0', '', TRUE);
                $this->title->Cell('25', '7', utf8_decode('Montant'), '1', '1', '', TRUE);

                //CONTENT
                $this->total = 0;
                foreach($cout_productions as $cout_production){
                    $this->content->Cell('22', '7', $cout_production->date_production, '1', '0', '');
                    $this->content->Cell('141', '7', utf8_decode($cout_production->libelle), '1', '0', '');
                    $this->content->Cell('25', '7', number_format($cout_production->montant, 02 ). '$', '1', '1', '');

                    //Computation of the invoice's total 
                    $this->total = $this->total + ($cout_production->montant); 
                }

                //DISPLAY THE TOTAL OF THE INVOICE
                $this->title->Cell('20', '3', '', '0', '1', '');
                $this->title->Cell('163', '7', 'Total', '0', '0', '');
                $this->content->Cell('25', '7', number_format($this->total, 02) . '$', '0', '1', '', TRUE);

                //OUTPUT 
                $this->fpdf->Output();

                exit;

        

        }else{
            session()->flash('message_err', 'You must select the month');
            return redirect()->back();   
        }


    }

}
