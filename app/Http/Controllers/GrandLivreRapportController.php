<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\matieres;
use App\Models\Sortie;
use App\Models\Operation;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use App\Models\MatiereComptable;
use App\Models\EmballageComptable;
use App\Http\Controllers\Controller;


class GrandLivreRapportController extends Controller
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

    public function grand_livre_rapport(Request $request, $month)
    {
        //dd($month);
        
        //GETTING INVOICES CONTENT FROM THE ARRAY OF THE SELECTED VALUES
        if(isset($month))
        {
            $today = date('d-m-Y');

            if(auth()->user()){
                $auth = auth()->user()->name;
            }
            
            $matieres = MatiereComptable::where('mois', $month )
                                            ->where('annee', date('Y'))
                                            ->orderBy('id', 'DESC')     
                                            ->get(); 

            $matiere_operations = Operation::where('transaction_id', '1')
                                            ->orderBy('created_at', 'DESC') 
                                            ->get(); 

            $emballages = EmballageComptable::where('mois', $month )
                                                    ->where('annee', date('Y'))
                                                    ->orderBy('id', 'DESC')     
                                                    ->get(); 

            $emballage_operations = Operation::where('transaction_id', '2')
                                                    ->orderBy('created_at', 'DESC') 
                                                    ->get(); 

            $sales = Sale::where('mois', $month )
                                ->where('annee', date('Y'))
                                ->orderBy('id', 'DESC')     
                                ->get(); 

            $sale_operations = Operation::where('transaction_id', '3')
                                                ->orderBy('created_at', 'DESC') 
                                                ->get();   

            $charges = Sortie::where('mois', $month )
                                    ->where('annee', date('Y'))
                                    ->orderBy('id', 'DESC')     
                                    ->get(); 
                            
            $charge_operations = Operation::where('transaction_id', '4')
                                                ->orderBy('created_at', 'DESC') 
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
                

                $this->address->cell('50', '5', "GRAND LIVRE COMPTABLE DU MOIS DE " . strtoupper($month), '0', '1');
            
                //devider
                $this->address->cell('50', '5', "", '0', '1');

               

                //ACHAT MATIERES

                $this->address->cell('50', '3', "", '0', '1');
                $this->address->cell('50', '9', utf8_decode("Achat Matières"), '0', '1');
                $this->address->cell('50', '3', "", '0', '1');

                 //TITLE
                 $this->title->Cell('20', '7', utf8_decode('Compte'), '1', '0', '', TRUE);
                 $this->title->Cell('92', '7', utf8_decode('Débit'), '1', '0', '', TRUE);
                 $this->title->Cell('25', '7', utf8_decode('Crédit'), '1', '0', '', TRUE);
                 $this->title->Cell('20', '7', utf8_decode('Compte'), '1', '0', '', TRUE);
                 $this->title->Cell('25', '7', utf8_decode('Débit'), '1', '0', '', TRUE);
                 $this->title->Cell('92', '7', utf8_decode('Crédit'), '1', '1', '', TRUE);

                foreach($matiere_operations as $matiere_operation){
                    $this->content->Cell('20', '7',  preg_replace('/[a-zA-Zéè\'ç]+/', '', $matiere_operation->actif_account), '1', '0', '');

                    $total_array = [];
                    $total_matiere = 0;                    
                    foreach($matieres as $key => $matiere){
                        $total_array [] = $matiere->quantity * $matiere->purchase_price;
                        $total_matiere = $total_matiere +  ($matiere->quantity * $matiere->purchase_price);
                    }

                    if($total_array)
                    {
                        $this->content->Cell('92', '7', implode("\n", $total_array), '1', '0', '');
                    }else{
                        $this->content->Cell('92', '7', '0', '1', '0', '');
                    }
                    $this->content->Cell('25', '7', 'SD '. number_format($total_matiere, 02) .'$', '1', '0', '');
                    
                    $this->content->Cell('20', '7',  preg_replace('/[a-zA-Zéè\'ç]+/', '', $matiere_operation->passif_account), '1', '0', '');
                 
                    $this->content->Cell('25', '7', 'SC '. number_format($total_matiere, 02) .'$', '1', '0', '');

                    if($total_array)
                    {
                        $this->content->Cell('92', '7', implode("\n", $total_array), '1', '0');
                    }else{
                        $this->content->Cell('92', '7', "0", '1', '0');
                    }
                    $this->content->Cell('35', '7', '', '0', '1');
                    
                }

                $this->address->cell('50', '3', "", '0', '1');
                $this->address->cell('50', '9', utf8_decode("Achat Emballages"), '0', '1');
                $this->address->cell('50', '3', "", '0', '1');

                //ACHAT EMBALLAGES
                 //TITLE
                 $this->title->Cell('20', '7', utf8_decode('Compte'), '1', '0', '', TRUE);
                 $this->title->Cell('92', '7', utf8_decode('Débit'), '1', '0', '', TRUE);
                 $this->title->Cell('25', '7', utf8_decode('Crédit'), '1', '0', '', TRUE);
                 $this->title->Cell('20', '7', utf8_decode('Compte'), '1', '0', '', TRUE);
                 $this->title->Cell('25', '7', utf8_decode('Débit'), '1', '0', '', TRUE);
                 $this->title->Cell('92', '7', utf8_decode('Crédit'), '1', '1', '', TRUE);
                foreach($emballage_operations as $emballage_operation){
                    $this->content->Cell('20', '7',  preg_replace('/[a-zA-Zéè\'ç]+/', '',$emballage_operation->actif_account), '1', '0', '');

                    $total_array_emballage = [];
                    $total_emballage = 0;                    
                    foreach($emballages as $key => $emballage){
                        $total_array_emballage [] = $emballage->quantity * $emballage->purchase_price;
                        $total_emballage = $total_emballage +  ($emballage->quantity * $emballage->purchase_price);
                    }

                    if($total_array_emballage)
                    {
                        $this->content->Cell('92', '7', implode("\n", $total_array_emballage), '1', '0', '');
                    }else{
                        $this->content->Cell('92', '7', "0", '1', '0', '');
                    }
                    $this->content->Cell('25', '7', 'SD '. number_format($total_emballage, 02) .'$', '1', '0', '');
                    
                    $this->content->Cell('20', '7',  preg_replace('/[a-zA-Zéè\'ç]+/', '',$emballage_operation->passif_account), '1', '0', '');
                 
                    $this->content->Cell('25', '7', 'SC '. number_format($total_emballage, 02) .'$', '1', '0', '');

                    if($total_array_emballage)
                    {
                        $this->content->Cell('92', '7', implode("\n", $total_array_emballage), '1', '0');
                    }else{
                        $this->content->Cell('92', '7', "0", '1', '0');
                    }

                    $this->content->Cell('35', '7', '', '0', '1');
                    
                }

                //VENTES 

                $this->address->cell('50', '3', "", '0', '1');
                $this->address->cell('50', '9', "Ventes", '0', '1');
                $this->address->cell('50', '3', "", '0', '1');

                 //TITLE
                 $this->title->Cell('20', '7', utf8_decode('Compte'), '1', '0', '', TRUE);
                 $this->title->Cell('92', '7', utf8_decode('Débit'), '1', '0', '', TRUE);
                 $this->title->Cell('25', '7', utf8_decode('Crédit'), '1', '0', '', TRUE);
                 $this->title->Cell('20', '7', utf8_decode('Compte'), '1', '0', '', TRUE);
                 $this->title->Cell('25', '7', utf8_decode('Débit'), '1', '0', '', TRUE);
                 $this->title->Cell('92', '7', utf8_decode('Crédit'), '1', '1', '', TRUE);
                foreach($sale_operations as $sale_operation){
                    $this->content->Cell('20', '7',  preg_replace('/[a-zA-Zéè\'ç]+/', '', $sale_operation->actif_account), '1', '0', '');

                    $total_array_sale = [];
                    $total_sale = 0;                    
                    foreach($sales as $key => $sale){
                        $total_array_sale [] = $sale->quantity * $sale->price;
                        $total_sale = $total_sale +  ($sale->quantity * $sale->price);
                    }

                    if($total_array_sale)
                    {
                        $this->content->Cell('92', '7', implode("\n", $total_array_sale), '1', '0', '');
                    }else{
                        $this->content->Cell('92', '7', "0", '1', '0', '');
                    }
                    $this->content->Cell('25', '7', 'SD '. number_format($total_sale, 02) .'$', '1', '0', '');
                    
                    $this->content->Cell('20', '7',  preg_replace('/[a-zA-Zéè\'ç]+/', '', $sale_operation->passif_account), '1', '0', '');
                 
                    $this->content->Cell('25', '7', 'SC '. number_format($total_sale, 02) .'$', '1', '0', '');
                    
                    if($total_array_sale)
                    {
                        $this->content->Cell('92', '7', implode("\n", $total_array_sale), '1', '0');
                    }else{
                        $this->content->Cell('92', '7', "0", '1', '0');
                    }
                    $this->content->Cell('35', '7', '', '0', '1');

                }

                //CHARGES
                $this->address->cell('50', '3', "", '0', '1');
                $this->address->cell('50', '9', "Charges", '0', '1');
                $this->address->cell('50', '3', "", '0', '1');

                 //TITLE
                 $this->title->Cell('20', '7', utf8_decode('Compte'), '1', '0', '', TRUE);
                 $this->title->Cell('92', '7', utf8_decode('Débit'), '1', '0', '', TRUE);
                 $this->title->Cell('25', '7', utf8_decode('Crédit'), '1', '0', '', TRUE);
                 $this->title->Cell('20', '7', utf8_decode('Compte'), '1', '0', '', TRUE);
                 $this->title->Cell('25', '7', utf8_decode('Débit'), '1', '0', '', TRUE);
                 $this->title->Cell('92', '7', utf8_decode('Crédit'), '1', '1', '', TRUE);
                foreach($charge_operations as $charge_operation){
                    $this->content->Cell('20', '7',  preg_replace('/[a-zA-Zéè\'ç]+/', '', $charge_operation->actif_account), '1', '0', '');

                    $total_array_charge = [];
                    $total_charge = 0;                    
                    foreach($charges as $key => $charge){
                        $total_array_charge [] = $charge->montant;
                        $total_charge = $total_charge +  ($charge->montant);
                    }

                    if($total_array_charge)
                    {
                        $this->content->Cell('92', '7', implode("\n", $total_array_charge), '1', '0', '');
                    }else{
                        $this->content->Cell('92', '7', "0", '1', '0', '');
                    }
                    $this->content->Cell('25', '7', 'SD '. number_format($total_charge, 02) .'$', '1', '0', '');
                    
                    $this->content->Cell('20', '7',  preg_replace('/[a-zA-Zéè\'ç]+/', '', $charge_operation->passif_account), '1', '0', '');
                 
                    $this->content->Cell('25', '7', 'SC '. number_format($total_charge, 02) .'$', '1', '0', '');
                    
                    if($total_array_charge)
                    {
                        $this->content->Cell('92', '7', implode("\n", $total_array_charge), '1', 'C');
                    }else{
                        $this->content->Cell('92', '7', "0", '1', 'C');
                    }
                    $this->content->Cell('35', '7', '', '0', '1');

                }
                //OUTPUT 
                
                $this->fpdf->Output();

                exit;

        

        }else{
            session()->flash('message_err', 'Vous devez choisir le mois');
            return redirect()->back();   
        }


    }

}
