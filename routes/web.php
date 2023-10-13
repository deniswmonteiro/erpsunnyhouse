<?php

use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Route;
use \App\Http\Middleware\EnsureStatusUser;
use App\Http\Controllers\ClientController;
use \App\Http\Controllers\BankController;
use \App\Http\Controllers\ContractController;
use App\Http\Controllers\ContasContratosController;
use App\Http\Controllers\ContratosController;
use \App\Http\Controllers\DashboardController;
use App\Http\Controllers\EngineeringController;
use \App\Http\Controllers\EquipmentController;
use \App\Http\Controllers\LogController;
use App\Http\Controllers\ProjectCostsController;
use \App\Http\Controllers\SellerController;
use \App\Http\Controllers\SellerTeamController;
use App\Http\Controllers\SunnyDashController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsinasController;
use App\Http\Controllers\usinasApuracaoController;
use App\Http\Controllers\usinasRateioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware([EnsureStatusUser::class])->group(function () {
    // User Profile
    Route::get('/user/profile', function () {
        return redirect('dashboard');
    })->name('profile');

    // Clients
    Route::post('/clients/accounts/files/{id}', [ClientController::class, 'get_contract_bill'])
        ->name('clients_contract_bill');
    Route::post('/clients/file/{type}/{id}', [ClientController::class, 'fileView'])
        ->name('clients_file_view');

    // Equipments
    Route::get('/equipments/datasheet/{type}/{id}', [EquipmentController::class, 'datasheetView'])
        ->name('datasheet_view');

    // Engineering
    Route::get('/engineering', [EngineeringController::class, 'index'])->name('engineering_project_index');
    Route::post('engineering', [EngineeringController::class, 'search'])->name('engineering_project_search');
    Route::get('/engineering/show/{id}', [EngineeringController::class, 'show'])->name('engineering_project_show');
    Route::post('/engineering/show/file/{type}/{id}', [EngineeringController::class, 'fileView'])
        ->name('engineering_project_file_view');
    Route::post('/engineering/show/store-documents/{id}', [EngineeringController::class, 'storeGeneratorDocuments'])
        ->name('engineering_generator_documents_store');
    Route::post('/engineering/show/update-documents/{type}/{id}', [EngineeringController::class, 'updateGeneratorDocuments'])->name('engineering_generator_documents_update');
    Route::post('/engineering/show/destroy-document/{type}/{id}', [EngineeringController::class, 'destroyGeneratorDocument'])->name('engineering_generator_destroy_document');
    Route::post('/engineering/show/store-image/', [EngineeringController::class, 'handleStoreGeneratorImages'])
        ->name('engineering_generator_images_store_fetch');
    Route::post('/engineering/show/show-images/', [EngineeringController::class, 'handleShowGeneratorImages'])
        ->name('engineering_generator_images_show_fetch');
    Route::post('/engineering/show/destroy-image/', [EngineeringController::class, 'handleDestroyGeneratorImage'])
        ->name('engineering_generator_destroy_image_fetch');
    Route::post('/engineering/show/new-apportionment-list/{id}', [EngineeringController::class, 'createNewApportionmentList'])->name('engineering_generator_new_apportionment_list');
    Route::post('/engineering/protocol/{type}/{id}', [EngineeringController::class, 'protocol'])
        ->name('engineering_protocol');
    Route::post('/engineering/protocol/', [EngineeringController::class, 'handleProtocol'])
        ->name('engineering_protocol_fetch');
    Route::get('/engineering/edit/{id}', [EngineeringController::class, 'edit'])->name('engineering_project_edit');
    Route::post('/engineering/update/{id}', [EngineeringController::class, 'update'])
        ->name('engineering_project_update');
    Route::post('/engineering/destroy/{id}', [EngineeringController::class, 'destroy'])
        ->name('engineering_project_destroy');
    Route::get('/engineering/destroy/generator', [EngineeringController::class, 'destroyGeneratorAddress'])
        ->name('engineering_project_destroy_generator');
    Route::get('/engineering/destroy/beneficiary', [EngineeringController::class, 'destroyBeneficiaryAddress'])
        ->name('engineering_project_destroy_beneficiary');
    Route::get('/engineering/destroy/protocol', [EngineeringController::class, 'destroyProtocol'])
        ->name('engineering_project_destroy_protocol');
    Route::get('/engineering/send-mail', [EngineeringController::class, 'sendEngineeringProjectMail'])
        ->name('engineering_project_mail');
    Route::get('/engineering/get-client-address', [EngineeringController::class, 'get_client_address_ajax'])
        ->name('engineering_get_client_address_ajax');
    Route::post('/engineering/get-client-credentials', [EngineeringController::class, 'get_client_credentials_ajax'])
        ->name('engineering_get_client_credentials_ajax');
    Route::get('/engineering/get-default-address', [EngineeringController::class, 'get_default_address'])
        ->name('engineering_get_default_address_fetch');
    Route::get('/engineering/print/apportionment-list/{id}', [EngineeringController::class, 'printApportionmentList'])
        ->name('engineering_print_apportionment_list');
    Route::get('/engineering/destroy/apportionment-list/{id}', [EngineeringController::class, 'destroyApportionmentList'])->name('engineering_project_destroy_apportionment_list');
    Route::post('/engineering/show/get-active-apportionment-list', [EngineeringController::class, 'get_active_apportionment_list_fetch'])->name('engineering_project_get_active_apportionment_list_fetch');
    Route::get('/engineering/show/document/create-generate-request/{type}/{id}', [EngineeringController::class, 'createGeneratorDocumentRequest'])->name('engineering_document_create_request');
    Route::post('/engineering/show/document/store-generate-request/{type}/{id}', [EngineeringController::class, 'storeGeneratorDocumentRequest'])->name('engineering_document_store_request');
    Route::get('/engineering/show/document/edit-generate-request/{type}/{id}', [EngineeringController::class, 'editGeneratorDocumentRequest'])->name('engineering_document_edit_request');
    Route::post('/engineering/show/document/update-generate-request/{type}/{id}', [EngineeringController::class, 'updateGeneratorDocumentRequest'])->name('engineering_document_update_request');
    Route::post('/engineering/show/document/print/generate-request/{type}/{id}', [EngineeringController::class, 'printGeneratorDocumentRequest'])->name('engineering_print_document_request');
    Route::post('/engineering/get-engineer-data', [EngineeringController::class, 'get_engineer_data_fetch'])
        ->name('engineering_get_engineer_data_fetch');
    Route::post('/engineering/edit/get-generator-data', [EngineeringController::class, 'get_generator_data_fetch'])
        ->name('engineering_get_generator_data_fetch');
    Route::post('/engineering/edit/get-beneficiary-data', [EngineeringController::class, 'get_beneficiary_data_fetch'])
        ->name('engineering_get_beneficiary_data_fetch');

    // Tickets
    Route::get('/tickets/', [TicketsController::class, 'index'])->name('tickets_index');
    Route::get('/tickets/edit/{id}', [TicketsController::class, 'edit'])->name('tickets_edit');
    Route::post('/tickets/post-ticket-comment', [TicketsController::class, 'storeTicketCommentFetch'])
        ->name('ticket_comment_store_fetch');
    Route::post('/tickets/post-ticket-attachment', [TicketsController::class, 'storeTicketAttachmentFetch'])
        ->name('ticket_attachment_store_fetch');
    Route::get('/ticket/attachment/{id}', [TicketsController::class, 'showTicketFile'])
        ->name('ticket_file_view');

    ///* REMOVER
    Route::post('/engineering/migrate-generator-document', [EngineeringController::class, 'migrate_generator_document_fetch'])->name('engineering_migrate_generator_document_fetch');
    // REMOVER */
    
    Route::group(['middleware' => ['auth.not_engineering']], function () {
        // Dashboard
        Route::get('/dashboard/', [DashboardController::class, 'index'])->name('dashboard');

        // Users
        Route::get('/users', [UserController::class, 'index'])->name('users_index');
        Route::get('/users/create', [UserController::class, 'create'])->name('create_user');
        Route::post('/users/store', [UserController::class, 'store'])->name('store_user');
        Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('edit_user');
        Route::post('/users/update/{id}', [UserController::class, 'update'])->name('update_user');
        Route::post('/users/destroy/{id}', [UserController::class, 'destroy'])->name('destroy_user');
        Route::post('/users/ajax/email', [UserController::class, 'validate_email'])->name('users_validate_email');
        Route::post('/users/ajax/email_user', [UserController::class, 'validate_email_user'])
            ->name('users_validate_email_user');

        // Clients
        Route::get('/clients/', [ClientController::class, 'index'])->name('clients_index');
        Route::get('/clients/create', [ClientController::class, 'create'])->name('clients_create');
        Route::post('/clients/store', [ClientController::class, 'store'])->name('clients_store');
        Route::get('/clients/edit/{id}', [ClientController::class, 'edit'])->name('clients_edit');
        Route::post('/clients/update/{id}', [ClientController::class, 'update'])->name('clients_update');
        Route::post('/clients/update_documents/{type}/{id}', [ClientController::class, 'updateclientDocuments'])
            ->name('clients_documents_update');
        Route::post('/clients/destroy/{id}', [ClientController::class, 'destroy'])->name('clients_destroy');
        Route::post('/clients/destroy/client_bill/{id}', [ClientController::class, 'destroyClientBill'])
            ->name('clients_destroy_bill');
        Route::get('/clients/ajax/email', [ClientController::class, 'validate_email'])->name('clients_validate_email');
        Route::get('/clients/ajax/name_client', [ClientController::class, 'exist_name_client'])
            ->name('clients_validate_name');
        Route::get('/clients/ajax/email_client', [ClientController::class, 'validate_email_client'])
            ->name('clients_validate_email_client');
        Route::post('/clients/ajax/ajax_client', [ClientController::class, 'store_client_ajax'])
            ->name('clients_store_ajax');
        Route::post('/clients/accounts/', [ClientController::class, 'get_contract_accounts'])
            ->name('clients_contract_accounts');
        Route::post('/clients/print/power_of_attorney/{id}', [ClientController::class, 'printPowerOfAttorney']) 
            ->name('clients_print_power_of_attorney');

        // Sellers
        Route::get('/sellers/', [SellerController::class, 'index'])->name('sellers_index');
        Route::get('/sellers/create', [SellerController::class, 'create'])->name('sellers_create');
        Route::post('/sellers/store', [SellerController::class, 'store'])->name('sellers_store');
        Route::get('/sellers/edit/{id}', [SellerController::class, 'edit'])->name('sellers_edit');
        Route::post('/sellers/update/{id}', [SellerController::class, 'update'])->name('sellers_update');
        Route::post('/sellers/destroy/{id}', [SellerController::class, 'destroy'])->name('sellers_destroy');
        Route::get('/sellers/ajax/email', [SellerController::class, 'validate_email'])->name('sellers_validate_email');
        Route::get('/sellers/ajax/email_seller', [SellerController::class, 'validate_email_seller'])
            ->name('sellers_validate_email_seller');
        Route::get('/sellers/ajax/name_seller', [SellerController::class, 'exist_name_seller'])
            ->name('sellers_validate_name');
        Route::post('/sellers/ajax/ajax_seller', [SellerController::class, 'store_seller_ajax'])
            ->name('sellers_store_ajax');

        // Contracts
        Route::get('/contracts/installation', [ContractController::class, 'installation'])
            ->name('contracts_installation');
        Route::get('/contracts/maintenance', [ContractController::class, 'maintenance'])
            ->name('contracts_maintenance');
        Route::get('/contracts/{type}/create/', [ContractController::class, 'create'])->name('contracts_create');
        Route::post('/contracts/store', [ContractController::class, 'store'])->name('contracts_store');
        Route::get('/contracts/{type}/edit/{id}', [ContractController::class, 'edit'])->name('contracts_edit');
        Route::post('/contracts/show/file/{type}/{id}', [ContractController::class, 'fileView'])
            ->name('contracts_file_view');
        Route::post('/contracts/update/{id}', [ContractController::class, 'update'])->name('contracts_update');
        Route::post('/contracts/destroy/{id}', [ContractController::class, 'destroy'])->name('contracts_destroy');
        Route::post('/contracts/update-status/', [ContractController::class, 'updateContractStatus'])
            ->name('contracts_update_status_fetch');
        Route::post('/contracts/print/report', [ContractController::class, 'printReport'])
            ->name('contracts_print_report');
        Route::post('/contracts/print/adhesion/{id}', [ContractController::class, 'printAdhesion'])
            ->name('contracts_print_adhesion');
        Route::post('/contracts/print/contract/{id}', [ContractController::class, 'printContract'])
            ->name('contracts_print_contract');
        Route::post('/contracts/print/power_of_attorney/{id}', [ContractController::class, 'printPowerOfAttorney']) 
            ->name('contracts_print_power_of_attorney');
        Route::post('/contracts/print/receipt_of_payment/{id}', [ContractController::class, 'printReceiptOfPayment'])
            ->name('contracts_print_receipt_of_payment');
        Route::post('/contracts/print/technical_certificate/{id}', [ContractController::class, 'printTechnicalCertificate'])->name('contracts_print_technical_certificate');

        // Contract Products
        Route::get('/products/ajax/products', [EquipmentController::class, 'get_products_by_name'])
            ->name('get_products_by_name');

        // Tickets
        Route::post('/tickets/store', [TicketsController::class, 'store'])->name('tickets_store');
        Route::post('/tickets/update', [TicketsController::class, 'update'])->name('tickets_update_fetch');
        Route::post('/tickets/destroy/{id}', [TicketsController::class, 'destroy'])->name('tickets_destroy');

        // Engineering
        Route::get('/engineering/create/{id}', [EngineeringController::class, 'create'])
            ->name('engineering_project_create');
        Route::post('/engineering/store/{id}', [EngineeringController::class, 'store'])
            ->name('engineering_project_store');

        // Project Costs
        Route::get('/costs', [ProjectCostsController::class, 'index'])->name('costs_index');
        Route::get('/costs/create/{id}', [ProjectCostsController::class, 'create'])->name('costs_create');
        Route::post('/costs/store/{id}', [ProjectCostsController::class, 'store'])->name('costs_store');

        // Equipments
        Route::get('/equipments', [EquipmentController::class, 'index'])->name('equipments_index');
        Route::post('/equipments/store', [EquipmentController::class, 'store'])->name('equipments_store');
        Route::post('/equipments/update/{id}', [EquipmentController::class, 'update'])->name('equipments_update');
        Route::post('/equipments/destroy/{id}', [EquipmentController::class, 'destroy'])->name('equipments_destroy');
        Route::post('/equipments/store_ajax', [EquipmentController::class, 'store_product_ajax'])
            ->name('store_product_ajax');

        // Banks
        Route::get('/banks/', [BankController::class, 'index'])->name('banks_index');
        Route::post('/banks/store', [BankController::class, 'store'])->name('banks_store');
        Route::post('/banks/update/{id}', [BankController::class, 'update'])->name('banks_update');
        Route::post('/banks/destroy/{id}', [BankController::class, 'destroy'])->name('banks_destroy');

        // Sellers Teams
        Route::post('/sellersTeam/store', [SellerTeamController::class, 'store'])->name('seller_team_store');
        Route::post('/sellersTeam/update/{id}', [SellerTeamController::class, 'update'])->name('seller_team_update');
        Route::post('/sellersTeam/destroy/{id}', [SellerTeamController::class, 'destroy'])->name('seller_team_destroy');
        Route::post('/teams/validate/ajax_team', [SellerTeamController::class, 'store_team_ajax'])
            ->name('teams_store_ajax');

        // Log
        Route::get('/log', [LogController::class, 'index'])->name('logs_index');

        // Sunny Park - Dashboard
        Route::get('/sunnypark/dashboard/', [SunnyDashController::class, 'index'])->name('sunnypark_dash_index');

        // Sunny Park - Contratos
        Route::get('/sunnypark/contratos/', [ContratosController::class, 'index'])->name('sunnypark_contratos_index');
        Route::get('/sunnypark/contratos/create', [ContratosController::class, 'create'])->name('sunnypark_contratos_create');
        Route::get('/sunnypark/contratos/edit/{id}', [ContratosController::class, 'edit'])->name('sunnypark_contratos_edit');
        Route::post('/sunnypark/contratos/store', [ContratosController::class, 'store'])->name('sunnypark_contratos_store');
        Route::post('/sunnypark/contratos/update/{id}', [ContratosController::class, 'update'])->name('sunnypark_contratos_update');
        Route::post('/sunnypark/contratos/destroy/{id}', [ContratosController::class, 'destroy'])->name('sunnypark_contratos_destroy');
        Route::post('/sunnypark/contratos/print/{id}', [ContratosController::class, 'print'])->name('sunnypark_contratos_print');

        // Sunny Park - Contas Contratos
        Route::get('/sunnypark/usinas/beneficiarias', [ContasContratosController::class, 'index'])->name('sunnypark_contascontratos_index');
        Route::get('/sunnypark/usinas/beneficiarias/cc/create', [ContasContratosController::class, 'create'])->name('sunnypark_contascontratos_create');
        Route::get('/sunnypark/usinas/beneficiarias/cc/{id}', [ContasContratosController::class, 'list'])->name('sunnypark_contascontratos_list');
        Route::get('/sunnypark/usinas/beneficiarias/download/{id}', [ContasContratosController::class, 'download'])->name('sunnypark_contascontratos_download');
        Route::get('/sunnypark/usinas/beneficiarias/cc/edit/{id}', [ContasContratosController::class, 'edit'])->name('sunnypark_contascontratos_edit');
        Route::get('/sunnypark/usinas/beneficiarias/cc/faturas/{id}', [ContasContratosController::class, 'list_faturas'])->name('sunnypark_contascontratos_list_faturas');
        Route::get('/sunnypark/usinas/beneficiarias/cc/fatura/create/{id}', [ContasContratosController::class, 'create_fatura'])->name('sunnypark_contascontratos_create_fatura');
        Route::post('/sunnypark/usinas/beneficiarias/destroy/{id}', [ContasContratosController::class, 'destroy'])->name('sunnypark_contascontratos_destroy');
        Route::post('/sunnypark/usinas/beneficiarias/cc/store', [ContasContratosController::class, 'store'])->name('sunnypark_contascontratos_store');
        Route::post('/sunnypark/usinas/beneficiarias/cc/destroy/{id}', [ContasContratosController::class, 'destroy_cc'])->name('sunnypark_contascontratos_destroy_cc');
        Route::post('/sunnypark/usinas/beneficiarias/cc/update/{id}', [ContasContratosController::class, 'update'])->name('sunnypark_contascontratos_update');
        Route::post('/sunnypark/usinas/beneficiarias/cc/fatura/store/{id}', [ContasContratosController::class, 'store_fatura'])->name('sunnypark_contascontratos_store_fatura');
        
        // Sunny Park - Usinas
        Route::get('/sunnypark/usinas/', [UsinasController::class, 'index'])->name('sunnypark_usinas_index');
        Route::get('/sunnypark/usinas/create', [UsinasController::class, 'create'])->name('sunnypark_usinas_create');
        Route::get('/sunnypark/usinas/edit/{id}', [UsinasController::class, 'edit'])->name('sunnypark_usinas_edit');
        Route::get('/sunnypark/usinas/ajax/login', [UsinasController::class, 'exist_login'])->name('sunnypark_usinas_validate_login');
        Route::get('/sunnypark/usinas/list/{id}', [UsinasController::class, 'list'])->name('sunnypark_usinas_list');
        Route::post('/sunnypark/usinas/store', [UsinasController::class, 'store'])->name('sunnypark_usinas_store');
        Route::post('/sunnypark/usinas/update/{id}', [UsinasController::class, 'update'])->name('sunnypark_usinas_update');
        Route::post('/sunnypark/usinas/destroy/{id}', [UsinasController::class, 'destroy'])->name('sunnypark_usinas_destroy');

        // Sunny Park - Usinas (rateio)
        Route::get('/sunnypark/usinas/{id}/rateio/create', [usinasRateioController::class, 'create'])->name('sunnypark_usinas_create_rateio');
        Route::post('/sunnypark/usinas/{id}/rateio/store', [usinasRateioController::class, 'store'])->name('sunnypark_usinas_store_rateio');

        // Sunny Park - Usinas (apuracao)
        Route::get('/sunnypark/usinas/{id}/apuracao/create', [usinasApuracaoController::class, 'create'])->name('sunnypark_usinas_create_apuracao');
        Route::post('/sunnypark/usinas/{id}/apuracao/store', [usinasApuracaoController::class, 'store'])->name('sunnypark_usinas_store_apuracao');
    });
});

Route::get('/', function () {
    return redirect('/login');
})->name('auth.login');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');