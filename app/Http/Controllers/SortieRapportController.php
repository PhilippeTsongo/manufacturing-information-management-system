<?php

namespace App\Http\Controllers;

use App\Models\Sortie;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SortieRapportController extends Controller
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

    public function sortie_rapport(Request $request, $month)
    {
        //dd($month);
        
        //GETTING INVOICES CONTENT FROM THE ARRAY OF THE SELECTED VALUES
        if(isset($month))
        {
            $today = date('d-m-Y');

            if(auth()->user()){
                $auth = auth()->user()->name;
            }

            $sorties = Sortie::where('mois', $month)
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
                

                $this->address->cell('50', '5', "LIST OF EXPENSES OF THE MONTH " . strtoupper($month), '0', '1');
            
                //devider
                $this->address->cell('50', '5', "", '0', '1');

                //TITLE
                $this->title->Cell('22', '7', utf8_decode('Date'), '1', '0', '', TRUE);
                $this->title->Cell('65', '7', utf8_decode('Libellé'), '1', '0', '', TRUE);
                $this->title->Cell('82', '7', utf8_decode('Déscription'), '1', '0', '', TRUE);
                $this->title->Cell('20', '7', utf8_decode('Montant'), '1', '1', '', TRUE);

                //CONTENT
                $this->total = 0;
                foreach($sorties as $sortie){
                    $this->content->Cell('22', '7', $sortie->date_sortie, '1', '0', '');
                    $this->content->Cell('65', '7', $sortie->libelle, '1', '0', '');
                    $this->content->Cell('82', '7', $sortie->description, '1', '0', '');
                    $this->content->Cell('20', '7', number_format($sortie->montant, 02 ). '$', '1', '1', '');

                    //Computation of the invoice's total 
                    $this->total = $this->total + ($sortie->montant); 
                }

                //DISPLAY THE TOTAL OF THE INVOICE
                $this->title->Cell('20', '3', '', '0', '1', '');
                $this->title->Cell('169', '7', 'Total', '0', '0', '');
                $this->content->Cell('20', '7', number_format($this->total, 02) . '$', '0', '1', '', TRUE);

                //OUTPUT 
                $this->fpdf->Output();

                exit;

        

        }else{
            session()->flash('message_err', 'You must select a month');
            return redirect()->back();   
        }


    }

}
