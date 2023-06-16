<?php

namespace App\Http\Controllers;
use App\Models\Dette;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Http\Controllers\Controller;
use App\Models\AutreRecette;
use App\Models\Sale;
use Illuminate\Http\Request;

class RecetteRapportController extends Controller
{
    protected $fpdf;

    public function __construct()
    {

        //ASSIGNMENT OF ALL MY VARIABLES THE VALUE OF FPDF
        $this->fpdf = new Fpdf;

        $this->address = $this->fpdf;
        $this->title = $this->fpdf;
        $this->content = $this->fpdf;
        $this->total_recette = $this->fpdf;
        $this->total_autre_recette = $this->fpdf;

    }

    public function recette_rapport(Request $request, $month)
    {
        //dd($month);
        
        //GETTING INVOICES CONTENT FROM THE ARRAY OF THE SELECTED VALUES
        if(isset($month))
        {
            $today = date('d-m-Y');

            if(auth()->user()){
                $auth = auth()->user()->name;
            }

            $sales = Sale::where('mois', $month)
                                ->where('annee', date('Y'))
                                ->get();

            $autres_recettes = AutreRecette::where('mois', $month)
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
                $this->total_recette->SetFont('Arial', '' ,10);

                //VIEW
                $this->address->cell('77', '10', " ", '0', '0', '', true);
                $this->address->cell('113', '10', "KANABE BUSINESS", '0', '1', '', true);
                $this->address->cell('45', '5', " ", '0', '1', '');
                //COMPANY INFO

                $this->address->cell('50', '5', "RCCM: CD/GOM/RCCM/22-B-01838 ", '0', '1');
                $this->address->cell('50', '5', "NUMERO IMPOT: A2219998 ", '0', '1');
                $this->address->cell('50', '5', "EMAIL: businessskanabe@gmail.com", '0', '1');
                $this->address->cell('50', '5', "TELEPHONE: (+243) 991 614 358 /(+243) 828 660 055", '0', '1');
                $this->address->cell('50', '5', "ADRESSE: 01 Av Accasias, Q. Les Volcans, Goma", '0', '1');

                $this->address->cell('50', '9', "DATE: " . date('d-m-Y'), '0', '1');
                $this->address->cell('50', '3', "", '0', '1');
                

                $this->address->cell('50', '5', "LISTE DE RECETTES DU MOIS DE " . strtoupper($month), '0', '1');
            
                //devider
                $this->address->cell('50', '5', "", '0', '1');

                //TITLE
                $this->title->Cell('35', '7', utf8_decode('Date'), '1', '0', '', TRUE);
                $this->title->Cell('129', '7', utf8_decode('Libellé'), '1', '0', '', TRUE);
                $this->title->Cell('25', '7', utf8_decode('Montant'), '1', '1', '', TRUE);

                //CONTENT
                $this->total_recette = 0;
                foreach($sales as $sale){
                    $this->content->Cell('35', '7', $sale->date_sale, '1', '0', '');
                    
                    $this->content->Cell('129', '7', utf8_decode('Vente numéro: ') .$sale->sale_number, '1', '0', '');
                    $this->content->Cell('25', '7', number_format($sale->price * $sale->quantity, 02 ). '$', '1', '1', '');

                    //Computation of the invoice's total 
                    $this->total_recette = $this->total_recette + (number_format($sale->price * $sale->quantity, 02 )); 
                }
                

                //DISPLAY THE TOTAL OF THE INVOICE
                $this->title->Cell('20', '3', '', '0', '1', '');
                $this->title->Cell('164', '7', 'Total', '0', '0', '');
                $this->content->Cell('25', '7', number_format($this->total_recette, 02) . '$', '0', '1', '', TRUE);

                
                
                
                
                //================================================AUTRES RECETTES======================================



                $this->address->cell('50', '10', "", '0', '1');

                $this->address->cell('50', '5', "LISTE DES AUTRES RECETTES DU MOIS DE " . strtoupper($month), '0', '1');

                //devider
                $this->address->cell('50', '5', "", '0', '1');

                //TITLE
                $this->title->Cell('22', '7', utf8_decode('Date'), '1', '0', '', TRUE);
                $this->title->Cell('48', '7', utf8_decode('Type de recette'), '1', '0', '', TRUE);
                $this->title->Cell('94', '7', utf8_decode('Déscription'), '1', '0', '', TRUE);
                $this->title->Cell('25', '7', utf8_decode('Montant'), '1', '1', '', TRUE);

                //CONTENT
                $this->total_autre_recette = 0;
                foreach($autres_recettes as $autres_recette){
                    $this->content->Cell('22', '7', $autres_recette->date_creation, '1', '0', '');
                    if($autres_recette->type_recette)
                    {
                        $this->content->Cell('48', '7', $autres_recette->type_recette->name, '1', '0', '');
                    }else{
                        $this->content->Cell('48', '7', '', '1', '0', '');
                    }
                    $this->content->Cell('94', '7', utf8_decode($autres_recette->description), '1', '0', '');
                    $this->content->Cell('25', '7', number_format($autres_recette->montant, 02 ). '$', '1', '1', '');

                    //Computation of the invoice's total 
                    $this->total_autre_recette = $this->total_autre_recette + (number_format($autres_recette->montant, 02 )); 
                }

                 //DISPLAY THE TOTAL OF THE INVOICE
                 $this->title->Cell('20', '3', '', '0', '1', '');
                 $this->title->Cell('164', '7', 'Total', '0', '0', '');
                 $this->content->Cell('25', '7', number_format($this->total_autre_recette, 02) . '$', '0', '1', '', TRUE);



                 $this->title->Cell('20', '3', '', '0', '1', '');
                 $this->title->Cell('164', '7', utf8_decode('TOTAL GENERAL'), '0', '0', '');
                 $this->content->Cell('25', '7', number_format($this->total_recette + $this->total_autre_recette, 02) . '$', '0', '1', '', TRUE);

                //OUTPUT 
                $this->fpdf->Output();

                exit;

        

        }else{
            session()->flash('message_err', 'Vous devez choisir le mois');
            return redirect()->back();   
        }


    }

}
