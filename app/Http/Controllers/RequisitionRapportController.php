<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Codedge\Fpdf\Fpdf\Fpdf;
use App\Http\Controllers\Controller;
use App\Models\Production;

class RequisitionRapportController extends Controller
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

    public function requisition_rapport(Request $request, $month)
    {
        //dd($month);
        
        //GETTING INVOICES CONTENT FROM THE ARRAY OF THE SELECTED VALUES
        if(isset($month))
        {
            $today = date('d-m-Y');

            if(auth()->user()){
                $auth = auth()->user()->name;
            }

            $productions = Production::where('mois', $month)
                                ->where('annee', date('Y'))
                                ->where('quantity', '<', 50)
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
                

                $this->address->cell('50', '5', "LIST OF PRODUCTIONS WITH LESS THAN 50 PCS IN STOCK OF THE MONTH " . strtoupper($month), '0', '1');
            
                //devider
                $this->address->cell('50', '5', "", '0', '1');

                //TITLE
                $this->title->Cell('30', '7', utf8_decode('Numéro'), '1', '0', '', TRUE);
                $this->title->Cell('20', '7', utf8_decode('Date'), '1', '0', '', TRUE);
                $this->title->Cell('15', '7', utf8_decode('Qté'), '1', '0', '', TRUE);
                $this->title->Cell('10', '7', utf8_decode('Unite'), '1', '0', '', TRUE);
                $this->title->Cell('42', '7', utf8_decode('Catégorie'), '1', '0', '', TRUE);
                $this->title->Cell('55', '7', 'Emballage', '1', '0', '', TRUE);
                $this->title->Cell('17', '7', utf8_decode('Qté Emb'), '1', '1', '', TRUE);


                //CONTENT
                $this->total = 0;
                foreach($productions as $production){
                    $this->content->Cell('30', '7', $production->number, '1', '0', '',);
                    $this->content->Cell('20', '7', $production->date_production, '1', '0', '');
                    $this->content->Cell('15', '7', $production->quantity, '1', '0', '');
                    if($production->unit)
                    {
                        $this->content->Cell('10', '7', $production->unit->name, '1', '0', '');
                    }else{
                        $this->content->Cell('10', '7', '', '1', '0', '');
                    }
                    if($production->category)
                    {
                        $this->content->Cell('42', '7', $production->category->name, '1', '0', '');
                    }else{
                        $this->content->Cell('42', '7', '', '1', '0', '');
                    }
                    if($production->emballage){
                        if($production->emballage->type_emballage)
                        {
                            $this->content->Cell('55', '7', $production->emballage->type_emballage->name, '1', '0', '');
                        }else{
                            $this->content->Cell('55', '7', '', '1', '0', '');
                        }
                    }else{
                        $this->content->Cell('55', '7', '', '1', '0', '');
                    }
                    $this->content->Cell('17', '7', $production->emballage_quantity, '1', '1', '');

                }

                //OUTPUT 
                $this->fpdf->Output();

                exit;

        }else{
            session()->flash('message_err', 'You must select the month');
            return redirect()->back();   
        }


    }

}
