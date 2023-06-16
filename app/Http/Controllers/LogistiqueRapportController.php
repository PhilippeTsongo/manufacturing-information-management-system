<?php

namespace App\Http\Controllers;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Http\Controllers\Controller;
use App\Models\logistique;
use Illuminate\Http\Request;

class LogistiqueRapportController extends Controller
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

    public function logistique_rapport(Request $request)
    {
        
            $today = date('d-m-Y');

            if(auth()->user()){
                $auth = auth()->user()->name;
            }

            $logistiques = logistique::all();

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
                $this->address->cell('50', '5', "ADRESSE: 01 Av Accasias, Q. Les Volcans, Goma", '0', '1');

                $this->address->cell('50', '9', "DATE: " . date('d-m-Y'), '0', '1');
                $this->address->cell('50', '3', "", '0', '1');
                

                $this->address->cell('50', '5', "LISTE DE LOGISTIQUES", '0', '1');
            
                //devider
                $this->address->cell('50', '5', "", '0', '1');

                //TITLE
                $this->title->Cell('80', '7', utf8_decode('Nom'), '1', '0', '', TRUE);
                $this->title->Cell('20', '7', utf8_decode('Quantité'), '1', '0', '', TRUE);
                $this->title->Cell('30', '7', utf8_decode('Unité'), '1', '0', '', TRUE);
                $this->title->Cell('59', '7', utf8_decode('Bureau'), '1', '1', '', TRUE);

                //CONTENT
                foreach($logistiques as $logistique){
                    $this->content->Cell('80', '7', $logistique->name, '1', '0', '',);
                    $this->content->Cell('20', '7', $logistique->quantity, '1', '0', '');
                    if($logistique->unit){
                        $this->content->Cell('30', '7', $logistique->unit->name, '1', '0', '');
                    }else{
                        $this->content->Cell('30', '7', '', '1', '0', '');
                    }

                    if($logistique->office){
                        $this->content->Cell('59', '7', utf8_decode($logistique->office->name), '1', '1', '');
                    }else{
                        $this->content->Cell('59', '7', '', '1', '1', '');
                    }
                }

                //OUTPUT 
                $this->fpdf->Output();

                exit;

    }

}
