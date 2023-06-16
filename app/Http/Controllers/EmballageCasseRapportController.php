<?php

namespace App\Http\Controllers;

use App\Models\Emballage;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use App\Models\EmballageCasse;
use App\Http\Controllers\Controller;

class EmballageCasseRapportController extends Controller
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

    public function emballage_casse_rapport(Request $request, $month)
    {
        //dd($month);
        
        //GETTING INVOICES CONTENT FROM THE ARRAY OF THE SELECTED VALUES
        if(isset($month))
        {
            $selects = $request->select_fac;  
            $today = date('d-m-Y');

            if(auth()->user()){
                $auth = auth()->user()->name;
            }

            $emballage_casses = EmballageCasse::where('mois', $month)
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
                
                $this->address->cell('50', '5', "LIST OF BROKEN PACKAGING OF " . strtoupper($month), '0', '1');
            
                //devider
                $this->address->cell('50', '5', "", '0', '1');

                //TITLE
                $this->title->Cell('30', '7', utf8_decode('Numéro'), '1', '0', '', TRUE);
                $this->title->Cell('30', '7', utf8_decode('Qté'), '1', '0', '', TRUE);
                $this->title->Cell('30', '7', utf8_decode('Unité'), '1', '0', '', TRUE);
                $this->title->Cell('100', '7', utf8_decode('Emballage'), '1', '1', '', TRUE);

                //CONTENT
                $this->total = 0;
                foreach($emballage_casses as $emballage){
                    $this->content->Cell('30', '7', $emballage->number, '1', '0', '');
                    $this->content->Cell('30', '7', $emballage->quantity, '1', '0', '');
                    
                    if($emballage->emballage){
                        if($emballage->emballage->unit){
                            $this->content->Cell('30', '7', $emballage->emballage->unit->name, '1', '0', '');
                        }else{
                            $this->content->Cell('30', '7', '', '1', '0', '');
                        }
                    }else{
                        $this->content->Cell('30', '7', '', '1', '0', '');
                    }

                    if($emballage->emballage){
                        if($emballage->emballage){
                            $this->content->Cell('100', '7', $emballage->emballage->type_emballage->name, '1', '0', '');
                        }else{
                            $this->content->Cell('100', '7', '', '1', '0', '');
                        }
                    }else{
                        $this->content->Cell('100', '7', '', '1', '0', '');
                    }
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
