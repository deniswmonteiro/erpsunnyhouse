const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .setResourceRoot('../')

    .js('resources/js/app.js', 'public/js')
    .js('resources/js/sidebar.js', 'public/js')
    .js('resources/js/jquery-3.5.1.min.js', 'public/js')
    .js('vendor/livewire/livewire/dist/livewire.js', 'public/js')

    .js('resources/js/extensions/*', 'public/js/extensions')
    .js('resources/js/pages/*', 'public/js/pages')

    .js(['resources/js/functions.js', 'resources/js/sunnypark/usinas/create.js'], 'public/js/sunnypark/usinas/create.js')
    .js(['resources/js/functions.js', 'resources/js/sunnypark/usinas/create-apuracao.js'], 'public/js/sunnypark/usinas/create-apuracao.js')
    .js(['resources/js/functions.js', 'resources/js/sunnypark/usinas/create-rateio.js'], 'public/js/sunnypark/usinas/create-rateio.js')
    .js(['resources/js/functions.js', 'resources/js/sunnypark/usinas/list.js'], 'public/js/sunnypark/usinas/list.js')
    .js(['resources/js/functions.js', 'resources/js/sunnypark/usinas/list-all.js'], 'public/js/sunnypark/usinas/list-all.js')
    .js(['resources/js/functions.js', 'resources/js/sunnypark/usinas/edit.js'], 'public/js/sunnypark/usinas/edit.js')
    .js(['resources/js/functions.js', 'resources/js/sunnypark/usinas/edit-apuracao.js'], 'public/js/sunnypark/usinas/edit-apuracao.js')
    .js(['resources/js/functions.js', 'resources/js/sunnypark/usinas/edit-rateio.js'], 'public/js/sunnypark/usinas/edit-rateio.js')

    .js(['resources/js/functions.js', 'resources/js/sunnypark/contratos/create.js'], 'public/js/sunnypark/contratos/create.js')
    .js(['resources/js/functions.js', 'resources/js/sunnypark/contratos/list.js'], 'public/js/sunnypark/contratos/list.js')
    .js(['resources/js/functions.js', 'resources/js/sunnypark/contratos/edit.js'], 'public/js/sunnypark/contratos/edit.js')

    .js(['resources/js/functions.js', 'resources/js/sunnypark/contascontratos/create.js'], 'public/js/sunnypark/contascontratos/create.js')
    .js(['resources/js/functions.js', 'resources/js/sunnypark/contascontratos/create-faturas.js'], 'public/js/sunnypark/contascontratos/create-faturas.js')
    .js(['resources/js/functions.js', 'resources/js/sunnypark/contascontratos/list.js'], 'public/js/sunnypark/contascontratos/list.js')
    .js(['resources/js/functions.js', 'resources/js/sunnypark/contascontratos/list-contratos.js'], 'public/js/sunnypark/contascontratos/list-contratos.js')
    .js(['resources/js/functions.js', 'resources/js/sunnypark/contascontratos/list-faturas.js'], 'public/js/sunnypark/contascontratos/list-faturas.js')
    .js(['resources/js/functions.js', 'resources/js/sunnypark/contascontratos/edit.js'], 'public/js/sunnypark/contascontratos/edit.js')

    .js(['resources/js/functions.js', 'resources/js/users/create.js'], 'public/js/users/create.js')
    .js(['resources/js/functions.js', 'resources/js/users/edit.js'], 'public/js/users/edit.js')
    .js(['resources/js/functions.js', 'resources/js/users/list.js'], 'public/js/users/list.js')

    .js(['resources/js/functions.js', 'resources/js/clients/create.js'], 'public/js/clients/create.js')
    .js(['resources/js/functions.js', 'resources/js/clients/edit.js'], 'public/js/clients/edit.js')
    .js(['resources/js/functions.js', 'resources/js/clients/list.js'], 'public/js/clients/list.js')
    .js(['resources/js/functions.js', 'resources/js/clients/listClientContracts.js'], 'public/js/clients/listClientContracts.js')
    .js(['resources/js/functions.js', 'resources/js/clients/contractAccounts.js'], 'public/js/clients/contractAccounts.js')

    .js(['resources/js/functions.js', 'resources/js/sellers/create.js'], 'public/js/sellers/create.js')
    .js(['resources/js/functions.js', 'resources/js/sellers/edit.js'], 'public/js/sellers/edit.js')
    .js(['resources/js/functions.js', 'resources/js/sellers/list.js'], 'public/js/sellers/list.js')
    .js(['resources/js/functions.js', 'resources/js/sellers/listSellerContracts.js'], 'public/js/sellers/listSellerContracts.js')

    .js(['resources/js/functions.js', 'resources/js/sellersTeam/create.js'], 'public/js/sellersTeam/create.js')
    .js(['resources/js/functions.js', 'resources/js/sellersTeam/edit.js'], 'public/js/sellersTeam/edit.js')
    .js(['resources/js/functions.js', 'resources/js/sellersTeam/list.js'], 'public/js/sellersTeam/list.js')

    .js(['resources/js/functions.js', 'resources/js/contracts/list.js'], 'public/js/contracts/list.js')
    .js(['resources/js/functions.js', 'resources/js/contracts/list-installation.js'], 'public/js/contracts/list-installation.js')
    .js(['resources/js/functions.js', 'resources/js/contracts/list-maintenance.js'], 'public/js/contracts/list-maintenance.js')
    .js(['resources/js/functions.js', 'resources/js/contracts/create.js'], 'public/js/contracts/create.js')
    .js(['resources/js/functions.js', 'resources/js/contracts/edit.js'], 'public/js/contracts/edit.js')
    .js(['resources/js/functions.js', 'resources/js/contracts/printReport.js'], 'public/js/contracts/printReport.js')

    .js(['resources/js/functions.js', 'resources/js/tickets/create.js'], 'public/js/tickets/create.js')
    .js(['resources/js/functions.js', 'resources/js/tickets/edit.js'], 'public/js/tickets/edit.js')
    .js(['resources/js/functions.js', 'resources/js/tickets/list.js'], 'public/js/tickets/list.js')

    .js(['resources/js/functions.js', 'resources/js/engineering/addAddress.js'], 'public/js/engineering/addAddress.js')
    .js(['resources/js/functions.js', 'resources/js/engineering/addCCBeneficiary.js'], 'public/js/engineering/addCCBeneficiary.js')
    .js(['resources/js/functions.js', 'resources/js/engineering/createDocumentAddNewFile.js'], 'public/js/engineering/createDocumentAddNewFile.js')
    .js(['resources/js/functions.js', 'resources/js/engineering/editDocumentAddNewFile.js'], 'public/js/engineering/editDocumentAddNewFile.js')
    .js(['resources/js/functions.js', 'resources/js/engineering/createGeneratorAddImage.js'], 'public/js/engineering/createGeneratorAddImage.js')
    .js(['resources/js/functions.js', 'resources/js/engineering/editGeneratorAddImage.js'], 'public/js/engineering/editGeneratorAddImage.js')
    .js(['resources/js/functions.js', 'resources/js/engineering/create.js'], 'public/js/engineering/create.js')
    .js(['resources/js/functions.js', 'resources/js/engineering/edit.js'], 'public/js/engineering/edit.js')
    .js(['resources/js/functions.js', 'resources/js/engineering/editAddAddress.js'], 'public/js/engineering/editAddAddress.js')
    .js(['resources/js/functions.js', 'resources/js/engineering/addApportionmentListBeneficiary.js'], 'public/js/engineering/addApportionmentListBeneficiary.js')
    .js(['resources/js/functions.js', 'resources/js/engineering/editAddCCBeneficiary.js'], 'public/js/engineering/editAddCCBeneficiary.js')
    .js(['resources/js/functions.js', 'resources/js/engineering/list.js'], 'public/js/engineering/list.js')
    .js(['resources/js/functions.js', 'resources/js/engineering/show.js'], 'public/js/engineering/show.js')
    .js(['resources/js/functions.js', 'resources/js/engineering/documents/access_request_form/createRequestUpToTen.js'], 'public/js/engineering/documents/access_request_form/createRequestUpToTen.js')
    .js(['resources/js/functions.js', 'resources/js/engineering/documents/access_request_form/editRequestUpToTen.js'], 'public/js/engineering/documents/access_request_form/editRequestUpToTen.js')
    .js(['resources/js/functions.js', 'resources/js/engineering/documents/access_request_form/createRequestAboveTenUpToSeventyFive.js'], 'public/js/engineering/documents/access_request_form/createRequestAboveTenUpToSeventyFive.js')
    .js(['resources/js/functions.js', 'resources/js/engineering/documents/access_request_form/editRequestAboveTenUpToSeventyFive.js'], 'public/js/engineering/documents/access_request_form/editRequestAboveTenUpToSeventyFive.js')
    .js(['resources/js/functions.js', 'resources/js/engineering/documents/access_request_form/createRequestAboveSeventyFive.js'], 'public/js/engineering/documents/access_request_form/createRequestAboveSeventyFive.js')
    .js(['resources/js/functions.js', 'resources/js/engineering/documents/access_request_form/editRequestAboveSeventyFive.js'], 'public/js/engineering/documents/access_request_form/editRequestAboveSeventyFive.js')
    .js(['resources/js/functions.js', 'resources/js/engineering/documents/access_request_form/addTableItem/addRequestSolarItem.js'], 'public/js/engineering/documents/access_request_form/addTableItem/addRequestSolarItem.js')
    .js(['resources/js/functions.js', 'resources/js/engineering/documents/access_request_form/addTableItem/addRequestInverterItem.js'], 'public/js/engineering/documents/access_request_form/addTableItem/addRequestInverterItem.js')
    .js(['resources/js/functions.js', 'resources/js/engineering/documents/access_request_form/addTableItem/addRequestTransformerItem.js'], 'public/js/engineering/documents/access_request_form/addTableItem/addRequestTransformerItem.js')

    .js(['resources/js/functions.js', 'resources/js/costs/list.js'], 'public/js/costs/list.js')
    .js(['resources/js/functions.js', 'resources/js/costs/create.js'], 'public/js/costs/create.js')

    .js('resources/js/bank/list.js', 'public/js/bank/list.js')
    .js(['resources/js/functions.js', 'resources/js/bank/listBankContracts.js'], 'public/js/bank/listBankContracts.js')

    .js(['resources/js/functions.js', 'resources/js/equipments/create.js'], 'public/js/equipments/create.js')
    .js(['resources/js/functions.js', 'resources/js/equipments/edit.js'], 'public/js/equipments/edit.js')
    .js(['resources/js/functions.js', 'resources/js/equipments/list.js'], 'public/js/equipments/list.js')
    .js(['resources/js/functions.js', 'resources/js/equipments/listEquipmentContracts.js'], 'public/js/equipments/listEquipmentContracts.js')

    .js(['resources/js/functions.js', 'resources/js/logs/list.js'], 'public/js/logs/list.js')
    .js(['resources/js/functions.js', 'resources/js/dashboard/dashboard.js'], 'public/js/dashboard/dashboard.js')

    .sass('resources/sass/bootstrap.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/pages/auth.scss', 'public/css/pages')

    .css('resources/css/fonts.css', 'public/css')
    .css('resources/css/app.css', 'public/css')
    .css('resources/css/bootstrap.css', 'public/css')
    .css('resources/css/autocomplete.css', 'public/css')
    .css('resources/css/style.css', 'public/css')

    .copy('resources/js/jquery.mask.js', 'public/js')
    .copy('resources/js/bstable.js', 'public/js')
    .copy('resources/images', 'public/images')
    ;

if (mix.inProduction()) {
    mix.version();
}
