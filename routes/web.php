<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BilanController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\DetteController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SortieController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmballageController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\GrandLivreController;
use App\Http\Controllers\LogistiqueController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\AccountTypeController;
use App\Http\Controllers\BilanConfigController;
use App\Http\Controllers\PriceConfigController;
use App\Http\Controllers\SaleRapportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TypeMatiereController;
use App\Http\Controllers\TypeRecetteController;
use App\Http\Controllers\AutreRecetteController;
use App\Http\Controllers\DetteRapportController;
use App\Http\Controllers\ClientRapportController;
use App\Http\Controllers\JustificationController;
use App\Http\Controllers\PlanComptableController;
use App\Http\Controllers\SortieRapportController;
use App\Http\Controllers\TypeEmballageController;
use App\Http\Controllers\CoutProductionController;
use App\Http\Controllers\EmballageCasseController;
use App\Http\Controllers\JournalRapportController;
use App\Http\Controllers\MatiereRapportController;
use App\Http\Controllers\RecetteRapportController;
use App\Http\Controllers\BilanClassementController;
use App\Http\Controllers\EmballageRapportController;
use App\Http\Controllers\GrandLivreRapportController;
use App\Http\Controllers\LogistiqueRapportController;
use App\Http\Controllers\ProductionRapportController;
use App\Http\Controllers\RequisitionRapportController;
use App\Http\Controllers\CoutProductionRapportController;
use App\Http\Controllers\EmballageCasseRapportController;
// use App;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

    Route::get('/', function () { 

        // dd($welcomeMessage);
        return view('index');
    })->name('index')->middleware(['auth']);


    //optimization and cache clearing
    Route::get('/optimize', function(){
        $exitCode = Artisan::call('optimize');
        return 'DONE';
    });

    Route::get('/cache', function(){
        $exitCode = Artisan::call('cache:clear');
        $exitCode = Artisan::call('config:cache');
        return 'DONE';
    });

    //change language
    Route::get('/change/language', [LangController::class, 'changeLanguage'])->name('changeLang');

    //dashboard
    //Route::group(['middleware' => ['auth', 'IsAdmin']], function(){
        
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['IsAdmin']);
            Route::resource('/users', UserController::class);
    //});

    //FInancier
    //Route::group(['middleware' => ['auth', 'isFinancier']], function(){

        Route::resource('/balance', BalanceController::class);
        Route::resource('/cout_production', CoutProductionController::class);
        Route::resource('/dette', DetteController::class);
        Route::get('/dette/{dette}', [DetteController::class, 'dette_payement_create'])->name('dette_pay_create');
        Route::post('/dette_pay', [DetteController::class, 'dette_payement'])->name('dette_pay');
        Route::resource('/justification', JustificationController::class);
        Route::resource('/recette', RecetteController::class);
        Route::resource('/sortie', SortieController::class);
        Route::resource('/type_recette', TypeRecetteController::class);
        Route::resource('/autre_recette', AutreRecetteController::class);

    //});

    //Route::group(['middleware' => ['auth', 'isComptable']], function(){
    //accounting
        Route::resource('/account_type', AccountTypeController::class);
        Route::resource('/bilan_config', BilanConfigController::class);
        Route::resource('/bilan', BilanController::class);
        Route::resource('/bilan_classement', BilanClassementController::class);
        Route::resource('/grand_livre', GrandLivreController::class);
        Route::resource('/journal', JournalController::class);
        Route::resource('/operation', OperationController::class);
        Route::resource('/plan_comptable', PlanComptableController::class);
        Route::resource('/transaction', TransactionController::class);
    //});

    //Stock
    //Route::group(['middleware' => ['auth', 'isProducer']], function(){

    //production
        Route::resource('/category', CategoryController::class);
        Route::resource('/type_emballage', TypeEmballageController::class);
        Route::resource('/emballage', EmballageController::class);
        Route::resource('/emballage_casse', EmballageCasseController::class);
        Route::resource('/matiere', MatiereController::class);
        Route::resource('/production', ProductionController::class);
        Route::resource('/qrcode', CodeController::class);
        Route::resource('/type_matiere', TypeMatiereController::class);
        Route::resource('/unit', UnitController::class);
        Route::get('/allocate_matiere/{production}', [ProductionController::class, 'allocate_matiere'])->name('allocate_matiere');
        Route::post('/allocate_matiere', [ProductionController::class, 'allocate_matiere_save'])->name('allocate_matiere.store');

        // Route::get('/allocate_emballage/{production}', [ProductionController::class, 'allocate_emballage'])->name('allocate_emballage');
        // Route::post('/allocate_emballage', [ProductionController::class, 'allocate_emballage_save'])->name('allocate_emballage.store');

    //});

    //Route::group(['middleware' => ['auth', 'isSeller']], function(){
        //sales
        Route::resource('/bonus', BonusController::class);
        Route::resource('/client', ClientController::class);
        Route::resource('/facture', FactureController::class);
        Route::resource('/logistique', LogistiqueController::class);
        Route::resource('/office', OfficeController::class);
        Route::resource('/sale', SaleController::class);
        Route::resource('/price_config', PriceConfigController::class);

        Route::get('/requisition', [ProductionController::class, 'requisition'])->name('product.requisition');
        Route::get('/search', [SaleController::class, 'search'])->name('production.search');
    //});
    
        Route::get('/general_search', [SearchController::class, 'general_search'])->name('search.search');

        //rapport
        Route::get('/rapport_martiere/{month}', [MatiereRapportController::class, 'matiere_rapport'])->name('rapport.martiere');
        Route::get('/rapport_emballage/{month}', [EmballageRapportController::class, 'emballage_rapport'])->name('rapport.emballage');
        Route::get('/rapport_emballage_casse/{month}', [EmballageCasseRapportController::class, 'emballage_casse_rapport'])->name('rapport.casse.emballage');
        Route::get('/rapport_production/{month}', [ProductionRapportController::class, 'production_rapport'])->name('rapport.production');
        Route::get('/rapport_requisition/{month}', [RequisitionRapportController::class, 'requisition_rapport'])->name('rapport.requisition');
        Route::get('/rapport_sale/{month}', [SaleRapportController::class, 'sale_rapport'])->name('rapport.sale');
        Route::get('/rapport_client', [ClientRapportController::class, 'client_rapport'])->name('rapport.client');
        Route::get('/rapport_sortie/{month}', [SortieRapportController::class, 'sortie_rapport'])->name('rapport.sortie');
        Route::get('/rapport_cout_production/{month}', [CoutProductionRapportController::class, 'cout_production_rapport'])->name('rapport.cout.production');
        Route::get('/rapport_dette/{month}', [DetteRapportController::class, 'dette_rapport'])->name('rapport.dette');
        Route::get('/rapport_recette/{month}', [RecetteRapportController::class, 'recette_rapport'])->name('rapport.recette');
        Route::get('/rapport_logistique', [LogistiqueRapportController::class, 'logistique_rapport'])->name('rapport.logistique');
        Route::get('/rapport_journal/{month}', [JournalRapportController::class, 'journal_rapport'])->name('rapport.journal');
        Route::get('/rapport_grand_livre/{month}', [GrandLivreRapportController::class, 'grand_livre_rapport'])->name('rapport.grand.livre');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
