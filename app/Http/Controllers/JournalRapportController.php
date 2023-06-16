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

class JournalRapportController extends Controller
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

    public function journal_rapport(Request $request, $month)
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
                

                $this->address->cell('50', '5', "ECRITURES COMPTABLE DU MOIS DE " . strtoupper($month), '0', '1');
            
                //devider
                $this->address->cell('50', '5', "", '0', '1');

                $this->address->cell('50', '3', "", '0', '1');
                $this->address->cell('50', '9', utf8_decode("Achat"), '0', '1');
                $this->address->cell('50', '3', "", '0', '1');

                //TITLE
                $this->title->Cell('22', '7', utf8_decode('Date'), '1', '0', '', TRUE);
                $this->title->Cell('12', '7', utf8_decode('Débit'), '1', '0', '', TRUE);
                $this->title->Cell('12', '7', utf8_decode('Crédit'), '1', '0', '', TRUE);
                $this->title->Cell('190', '7', utf8_decode('Libellé'), '1', '0', '', TRUE);
                $this->title->Cell('20', '7', utf8_decode('Débit'), '1', '0', '', TRUE);
                $this->title->Cell('20', '7', utf8_decode('Crédit'), '1', '1', '', TRUE);


                //ACHAT MATIERES
                foreach($matieres as $matiere){
                    foreach($matiere_operations as $matiere_operation){
                        $this->content->Cell('22', '7', $matiere->date_matiere, '1', '0', '');
                       
                        $this->content->Cell('12', '7', preg_replace('/[a-zA-Zéè\'ç]+/', '', $matiere_operation->actif_account), '1', '0', '');
                        $this->content->Cell('12', '7', preg_replace('/[a-zA-Zéè\'ç]+/', '', $matiere_operation->passif_account), '1', '0', '');
                        
                        if($matiere_operation->transaction){
                            $this->content->Cell('190', '7', utf8_decode($matiere_operation->transaction->name .' Date '. $matiere->date_matiere . '  (D) ' . preg_replace('/.[0-9]+/', '',$matiere_operation->actif_account) . '  (C) ' . preg_replace('/.[0-9]+/', '',$matiere_operation->passif_account)), '1', '0', '');
                        }else{
                            $this->content->Cell('190', '7', '' , '1', '0', '');
                        }

                        $this->content->Cell('20', '7', number_format($matiere->quantity * $matiere->purchase_price, 02) .'$' , '1', '0', '');

                        $this->content->Cell('20', '7', number_format($matiere->quantity * $matiere->purchase_price, 02) .'$' , '1', '1', '');
                    }
                }

                //ACHAT EMBALLAGES
                foreach($emballages as $emballage){
                    foreach($emballage_operations as $emballage_operation){
                        $this->content->Cell('22', '7', $emballage->date_emballage, '1', '0', '');
                       
                        $this->content->Cell('12', '7', preg_replace('/[a-zA-Zéè\'ç]+/', '', $emballage_operation->actif_account), '1', '0', '');
                        $this->content->Cell('12', '7', preg_replace('/[a-zA-Zéè\'ç]+/', '', $emballage_operation->passif_account), '1', '0', '');
                        
                        if($emballage_operation->transaction){
                            $this->content->Cell('190', '7', utf8_decode($emballage_operation->transaction->name .' Date '. $emballage->date_emballage . '  (D) ' . preg_replace('/.[0-9]+/', '',$emballage_operation->actif_account) . '  (C) ' . preg_replace('/.[0-9]+/', '',$emballage_operation->passif_account)), '1', '0', '');
                        }else{
                            $this->content->Cell('190', '7', '' , '1', '0', '');
                        }

                        $this->content->Cell('20', '7', number_format($emballage->quantity * $emballage->purchase_price, 02) .'$' , '1', '0', '');

                        $this->content->Cell('20', '7', number_format($emballage->quantity * $emballage->purchase_price, 02) .'$' , '1', '1', '');
                    }
                }

                //VENTE

                
                $this->address->cell('50', '3', "", '0', '1');
                $this->address->cell('50', '9', utf8_decode("Ventes"), '0', '1');
                $this->address->cell('50', '3', "", '0', '1');

                //TITLE
                $this->title->Cell('22', '7', utf8_decode('Date'), '1', '0', '', TRUE);
                $this->title->Cell('12', '7', utf8_decode('Débit'), '1', '0', '', TRUE);
                $this->title->Cell('12', '7', utf8_decode('Crédit'), '1', '0', '', TRUE);
                $this->title->Cell('190', '7', utf8_decode('Libellé'), '1', '0', '', TRUE);
                $this->title->Cell('20', '7', utf8_decode('Débit'), '1', '0', '', TRUE);
                $this->title->Cell('20', '7', utf8_decode('Crédit'), '1', '1', '', TRUE);

                foreach($sales as $sale){
                    foreach($sale_operations as $sale_operation){
                        $this->content->Cell('22', '7', $sale->date_sale, '1', '0', '');
                       
                        $this->content->Cell('12', '7', preg_replace('/[a-zA-Zéè\'ç]+/', '', $sale_operation->actif_account), '1', '0', '');
                        $this->content->Cell('12', '7', preg_replace('/[a-zA-Zéè\'ç]+/', '', $sale_operation->passif_account), '1', '0', '');
                        
                        if($sale_operation->transaction){
                            $this->content->Cell('190', '7', utf8_decode($sale_operation->transaction->name .' Date '. $sale->date_sale . '  (D) ' . preg_replace('/.[0-9]+/', '',$sale_operation->actif_account) . '  (C) ' . preg_replace('/.[0-9]+/', '',$sale_operation->passif_account)), '1', '0', '');
                        }else{
                            $this->content->Cell('190', '7', '' , '1', '0', '');
                        }

                        $this->content->Cell('20', '7', number_format($sale->quantity * $sale->price, 02) .'$' , '1', '0', '');

                        $this->content->Cell('20', '7', number_format($sale->quantity * $sale->price, 02) .'$' , '1', '1', '');
                    }
                }


                
                $this->address->cell('50', '3', "", '0', '1');
                $this->address->cell('50', '9', utf8_decode("Charges"), '0', '1');
                $this->address->cell('50', '3', "", '0', '1');

                //TITLE
                $this->title->Cell('22', '7', utf8_decode('Date'), '1', '0', '', TRUE);
                $this->title->Cell('12', '7', utf8_decode('Débit'), '1', '0', '', TRUE);
                $this->title->Cell('12', '7', utf8_decode('Crédit'), '1', '0', '', TRUE);
                $this->title->Cell('190', '7', utf8_decode('Libellé'), '1', '0', '', TRUE);
                $this->title->Cell('20', '7', utf8_decode('Débit'), '1', '0', '', TRUE);
                $this->title->Cell('20', '7', utf8_decode('Crédit'), '1', '1', '', TRUE);
                
                foreach($charges as $charge){
                    foreach($charge_operations as $charge_operation){
                        $this->content->Cell('22', '7', $charge->date_sortie, '1', '0', '');
                       
                        $this->content->Cell('12', '7', preg_replace('/[a-zA-Zéè\'ç]+/', '', $charge_operation->actif_account), '1', '0', '');
                        $this->content->Cell('12', '7', preg_replace('/[a-zA-Zéè\'ç]+/', '', $charge_operation->passif_account), '1', '0', '');
                        
                        if($charge_operation->transaction){
                            $this->content->Cell('190', '7', utf8_decode($charge_operation->transaction->name .' Date '. $charge->date_sortie . '  (D) ' . preg_replace('/.[0-9]+/', '',$charge_operation->actif_account) . '  (C) ' . preg_replace('/.[0-9]+/', '',$charge_operation->passif_account)), '1', '0', '');
                        }else{
                            $this->content->Cell('190', '7', '' , '1', '0', '');
                        }

                        $this->content->Cell('20', '7', number_format($charge->montant, 02) .'$' , '1', '0', '');

                        $this->content->Cell('20', '7', number_format($charge->montant, 02) .'$' , '1', '1', '');
                    }
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
