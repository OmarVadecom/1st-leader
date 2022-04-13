<?php

use Illuminate\Support\Facades\Route;

Route::get('/loadUsersresresrs', 'UserController@AjaxLoad')->name('admin.user.ajax');

Route::get('/loadUsers', 'UserController@AjaxLoad')->name('admin.user.ajax');
Route::post('/users/password', 'UserController@changePass')->name('admin.changePass.ajax');

// Roles
Route::get('/loadRoles', 'RoleController@AjaxLoad')->name('admin.role.ajax');
Route::post('/role/multiDelete', 'RoleController@multiDelete')->name('admin.role.deletes');

// Contacts
Route::get('/loadContacts', 'ContactController@AjaxLoad')->name('admin.contact.ajax');
Route::post('/contact/multiDelete', 'ContactController@multiDelete')->name('admin.contact.deletes');

// Contacts
Route::get('/loadRequests', 'RequestController@AjaxLoad')->name('admin.request.ajax');
Route::post('/requests/multiDelete', 'RequestController@multiDelete')->name('admin.request.deletes');

//PriceOffers
Route::resource('/priceoffer', 'PriceOfferController');
Route::get('/priceoffer/{id}/verify', 'PriceOfferController@verify')->name('admin.offer.show_verify');
Route::get('/priceoffers', 'PriceOfferController@AjaxLoad')->name('admin.priceoffers.ajax');

//Purchases Prices Offers
Route::resource('purchases-prices-offers', 'PurchasePriceOfferController');
Route::get('purchases-prices-offers-ajax', 'PurchasePriceOfferController@AjaxLoad')->name('admin.purchases-prices-offers-ajax.ajax');

//Purchases Orders
Route::get('purchases-orders', 'PurchaseOrderController@index')->name('admin.purchases-orders.index');
Route::get('purchases-orders-ajax', 'PurchaseOrderController@AjaxLoad')->name('admin.purchases-orders-ajax.ajax');

Route::get('/verified-offers', 'PriceOfferController@index_verify')->name('admin.mooffer');
Route::get('/verified_priceoffers', 'PriceOfferController@AjaxLoadmooffer')->name('admin.verified_offers.ajax');

Route::resource('/funds', 'FundsController');
Route::get('/getfunds', 'FundsController@AjaxLoad')->name('admin.funds.ajax');

Route::get('/get-products', 'PriceOfferController@ajaxSearch')->name('admin.ajax_search');
Route::get('/add-products', 'PriceOfferController@ajaxAdd')->name('admin.ajax_add');

Route::POST('/uploadimg', 'ProductController@imgproducts')->name('admin.uploadimg');
Route::POST('/uploadpartsimg', 'PartsController@imgproducts')->name('admin.uploadpartsimg');
//visits
Route::resource('/visits', 'VisitsController');
Route::get('/mapvisits', 'VisitsController@mapvisits');

Route::get('/loadvisits', 'VisitsController@AjaxLoad')->name('admin.visits.ajax');
//Preparations
Route::resource('/preparations', 'PreparationsController');
Route::get('/preparations-ajax', 'PreparationsController@AjaxLoad')->name('admin.get-preparations.ajax');

Route::resource('/delivery', 'DeliveryController');
Route::get('/loaddelivery', 'DeliveryController@AjaxLoad')->name('admin.delivery.ajax');

Route::resource('/transport', 'ProductTransportController');
Route::get('/loadtransport', 'ProductTransportController@AjaxLoad')->name('admin.transport.ajax');

Route::resource('/expense', 'ExpenseController');
Route::get('/loadexpense', 'ExpenseController@AjaxLoad')->name('admin.expense.ajax');

Route::resource('/expensecategory', 'ExpenseCategoryController');
Route::get('/loadexpensecategory', 'ExpenseCategoryController@AjaxLoad')->name('admin.expensecategory.ajax');


Route::get('/caroc-report', 'VisitsController@caroc_report')->name('admin.caroc-report.index');
Route::get('/loadcaroc-report', 'VisitsController@AjaxLoadcaroc')->name('admin.caroc.ajax');

//messages----------------------
Route::get('/incomes', 'ContactController@getincomes')->name('admin.incomes.index');
Route::get('/loadincomes', 'ContactController@ajaxloadincomes')->name('admin.incomes.ajax');

Route::get('/sent', 'ContactController@getsent')->name('admin.sent.index');
Route::get('/loadsent', 'ContactController@ajaxloadsent')->name('admin.sent.ajax');

Route::get('/showmessage/{id}', 'ContactController@showmessage')->name('admin.showmsg.index');

Route::get('/sendmessage', 'ContactController@sendmessage')->name('admin.msg.index');
Route::post('/sendmessage', 'ContactController@postmessage')->name('admin.msg.send');
//-------------------------------

//reports
Route::get('/sold_report', 'VisitsController@sold_report')->name('admin.sold_report.index');
Route::get('/loadsold-report', 'VisitsController@AjaxLoadsold')->name('admin.sold.ajax');

Route::get('/reserved_report', 'VisitsController@mahgoz_report')->name('admin.mahgoz.index');
Route::get('/loadmahgoz-report', 'VisitsController@AjaxLoadmahgoz')->name('admin.mahgoz.ajax');

Route::get('/available_report', 'VisitsController@available_report')->name('admin.available.index');

Route::get('/sells-of-day', 'VisitsController@sells_of_day')->name('admin.sells-of-day');
Route::post('/reports-sells', 'VisitsController@reports_sells')->name('admin.reports-sells.index');

Route::get('/loadavailable_report-report', 'VisitsController@AjaxLoadavailable')->name('admin.available.ajax');
Route::get('/sells-report', 'VisitsController@AjaxLoadSells')->name('admin.sells-reports.ajax');

Route::get('/purchases_report', 'VisitsController@buy_report')->name('admin.buy_report.index');
Route::get('/loadbuy-report', 'VisitsController@AjaxLoadbuy')->name('admin.buy.ajax');

// Pages
Route::get('/loadPage', 'PageController@AjaxLoad')->name('admin.page.ajax');
Route::get('/get/module', 'PageController@getModule')->name('admin.get.module');
Route::post('/page/multiDelete', 'PageController@multiDelete')->name('admin.page.deletes');
Route::post('/page/pin', 'PageController@pinOrUnpin')->name('admin.page.pin');

// Pages Categories
Route::get('/loadPageCategory', 'PageCategoryController@AjaxLoad')->name('admin.page-categories.ajax');
Route::post('/page-categories/multiDelete', 'PageCategoryController@multiDelete')->name('admin.page-categories.deletes');

// Slider
Route::get('/loadSliders', 'SliderController@AjaxLoad')->name('admin.slider.ajax');
Route::post('/slider/multiDelete', 'SliderController@multiDelete')->name('admin.slider.deletes');

// Products Categories
Route::get('/loadProductCategory', 'ProductCategoryController@AjaxLoad')->name('admin.product-categories.ajax');
Route::post('/product-categories/multiDelete', 'ProductCategoryController@multiDelete')->name('admin.product-categories.deletes');

// Pages
Route::get('/loadProduct', 'ProductController@AjaxLoad')->name('admin.product.ajax');
Route::post('/product/multiDelete', 'ProductController@multiDelete')->name('admin.product.deletes');

// Menu
Route::get('/loadContentMenus', 'MenuController@AjaxLoadContent')->name('admin.menu.content.ajax');
Route::post('/menu/multiDelete', 'MenuController@multiDelete')->name('admin.menu.deletes');

// SEO
Route::get('/loadSeoPage', 'SeoController@showTagsData')->name('admin.seo.tags');

/** Http  **/

// Home
Route::get('/', 'HomeController@index')->name('admin.home');
Route::post('/emport', 'HomeController@importExcelDB')->name('admin.import');

// SEO
Route::get('/seo/tags', 'SeoController@showTagsForm')->name('admin.seo.tags.form');
Route::get('/seo/sitemap', 'SeoController@showSitemapForm')->name('admin.seo.sitemap.form');
Route::post('/seo/sitemap', 'SeoController@uploadSitemap')->name('admin.seo.sitemap');

// Socials
Route::get('/social', 'SocialController@index')->name('admin.social');
Route::post('/social/update', 'SocialController@update')->name('admin.social.update');

// Products
Route::resource('/product', 'ProductController');
Route::get('/productpurchase', 'ProductController@getpurchase')->name('purchases.product.get');
Route::post('/purchases/product', 'ProductController@postpurchase')->name('purchases.product');
Route::post('/import-excel', 'ProductController@importExcel')->name('admin.product.import_excel');

// Products Categories
Route::resource('/product-categories', 'ProductCategoryController');

//packages
Route::resource('/packages', 'PackageController');
Route::get('/packages/{id}/copy', 'PackageController@packagecopy')->name('packages.copy');

Route::get('/page/{id}/copy', 'PageController@Pagecopy')->name('page.copy');

Route::post('/packages/multiDelete', 'PackageController@multiDelete')->name('admin.package.deletes');

// packages Categories
Route::resource('/packages-categories', 'PackagesCategoryController');
Route::get('/loadpackages', 'PackageController@AjaxLoad')->name('admin.package.ajax');
Route::get('/loadpackagescat', 'PackagesCategoryController@AjaxLoad')->name('admin.packagecat.ajax');
Route::get('/getpackagesajax', 'PackagesCategoryController@ajaxpackages')->name('admin.packagecatajax.ajax');
Route::post('/packages-categories/multiDelete', 'PackagesCategoryController@multiDelete')->name('admin.packagecat.deletes');

//Portfolios
Route::resource('/portfolio', 'PortfolioController');

// Portfolios Categories
Route::resource('/portfolio_categories', 'PortfolioCategoryController');
Route::get('/loadportfolio', 'PortfolioController@AjaxLoad')->name('admin.portfolio.ajax');

Route::get('/updatestatus', 'PortfolioController@updatestatus')->name('admin.portfolio.statusupdate');

Route::get('/updateportfajax', 'PortfolioController@updateportfajax')->name('admin.portfolio.portoupdate');

Route::get('/loadportfoliocat', 'PortfolioCategoryController@AjaxLoad')->name('admin.portfoliocat.ajax');
Route::post('/ploadportfoliocat/multiDelete', 'PackagesCategoryController@multiDelete')->name('admin.portfoliocat.deletes');

// Slider
Route::resource('/menu', 'MenuController');
Route::get('/menu/{id}/list', 'MenuController@getParents')->name('menu.parent.list');
Route::get('/menu/{slug}/up', 'MenuController@stepUp')->name('menu.up');
Route::get('/menu/{slug}/down', 'MenuController@stepDown')->name('menu.down');

// Slider
Route::resource('/slider', 'SliderController');

// Pages Categories
Route::resource('/page-categories', 'PageCategoryController');

// Pages
Route::resource('/page', 'PageController');

// Contact
Route::resource('/contact', 'ContactController', ['except' => ['create', 'store', 'update', 'edit']]);

// Request
Route::resource('/requests', 'RequestController', ['except' => ['create', 'store', 'update', 'edit']]);

// Settings
Route::get('/icons', 'SettingController@showIcons')->name('admin.settings.icons');
Route::get('/settings/layouts', 'SettingController@layouts')->name('admin.settings.layouts');
Route::get('/settings/scripts', 'SettingController@scripts')->name('admin.settings.scripts');
Route::get('/settings', 'SettingController@index')->name('admin.settings');
Route::post('/settings/update', 'SettingController@update')->name('admin.settings.update');

// Users
Route::resource('/users', 'UserController');
Route::resource('/customers', 'CustomerController');
Route::get('/loadcustomers', 'CustomerController@AjaxLoad')->name('admin.customers.ajax');
Route::get('/users/update/me', 'UserController@formUpdate')->name('users.update.info.show');
Route::post('/users/update/me', 'UserController@dataUpdate')->name('users.update.info');

Route::resource('/customercategory', 'CustomerCatController');
Route::get('/loadcustomercategory', 'CustomerCatController@AjaxLoad')->name('admin.customercategory.ajax');

Route::resource('/moneybox', 'MoneyBoxController');
Route::get('/loadmoneybox', 'MoneyBoxController@AjaxLoad')->name('admin.moneybox.ajax');


// Roles
Route::resource('/role', 'RoleController');

//brands
Route::resource('/brands', 'BrandsController');
Route::get('/loadbrands', 'BrandsController@AjaxLoad')->name('admin.brands.ajax');

//parts
Route::resource('/parts', 'PartsController');
Route::get('/searchparts', 'PartsController@brands');
Route::get('/searchparts/{id}', 'PartsController@products');
Route::get('/showproduct/{id}', 'PartsController@showproduct');
Route::get('/loadParts', 'PartsController@AjaxLoad')->name('admin.parts.ajax');
Route::post('/parts/multiDelete', 'PartsController@multiDelete')->name('admin.parts.deletes');

//samples
Route::get('/bannar-samples', 'PageController@bannarsamples')->name('admin.bannersamples');
Route::get('/package-samples', 'PageController@packagesamples')->name('admin.packagesamples');

//sells
Route::resource('/sells', 'SellController');
Route::get('/loadsells', 'SellController@AjaxLoad')->name('admin.sells.ajax');
Route::get('/sell/intenal', 'SellController@internalsells')->name('admin.sellsint.index');
Route::get('qrcode', 'SellController@qrcode')->name('qrcode.view');

Route::get('/loadsellsin', 'SellController@AjaxLoadinternal')->name('admin.sellsint.ajax');

Route::get('/sell/maintenance', 'SellController@mntsells')->name('admin.sellsmnt.index');
Route::get('/loadsellsmnt', 'SellController@AjaxLoadmaintenance')->name('admin.sellsmnt.ajax');

Route::resource('/warehouse', 'WarehouseController');
Route::get('/loadwarehouse', 'WarehouseController@AjaxLoad')->name('adminsell/intenal.warehouse.ajax');

Route::resource('/stock', 'StockController');
Route::get('/loadstock', 'StockController@AjaxLoad')->name('admin.stock.ajax');

Route::resource('/supplies', 'SuppliesController');
Route::get('/loadsupplies', 'SuppliesController@AjaxLoad')->name('admin.supplies.ajax');
Route::post('/supplies/multiDelete', 'SuppliesController@multiDelete')->name('admin.supplies.deletes');
Route::get('/supply/get-warehouses', 'SuppliesController@getWarehouses')->name('admin.supplies.get_warehouses');

Route::resource('/country', 'CountryController');
Route::get('/loadcountry', 'CountryController@AjaxLoad')->name('admin.country.ajax');

Route::get('/storereport', 'StockController@stockreport')->name('admin.stockreport');
Route::post('/storereport', 'StockController@poststockreport')->name('admin.poststockreport');

Route::resource('/purchases', 'PurchaseController');

Route::redirect('/purchases?type=0', '/purchases');

Route::get('/loadpurchase', 'PurchaseController@AjaxLoad')->name('admin.purchases.ajax');
Route::get('/po_purchase', 'PurchaseController@po_index')->name('admin.po_purchase.index');
Route::get('/load_po_purchase', 'PurchaseController@po_AjaxLoad')->name('admin.po_purchase.ajax');

Route::resource('/gifts', 'GiftsController');
Route::get('/loadgifts', 'GiftsController@AjaxLoad')->name('admin.gifts.ajax');

Route::resource('/color', 'ColorController');
Route::get('/loadcolor', 'ColorController@AjaxLoad')->name('admin.color.ajax');

Route::resource('/letter', 'LetterController');
Route::get('/loadletters', 'LetterController@AjaxLoad')->name('admin.letters.ajax');

Route::resource('/sanadat', 'SanadatController');
Route::get('/loadsanadat', 'SanadatController@AjaxLoad')->name('admin.sanadat.ajax');


Route::resource('/tmpclients', 'TempClientsController');
Route::get('/loadtmpclients', 'TempClientsController@AjaxLoad')->name('admin.tmpclients.ajax');

Route::resource('/attachmentcat', 'AttachmentCatController');
Route::get('/ajaxattachmentcat', 'AttachmentCatController@AjaxLoad')->name('admin.attachmentcat.ajax');

Route::resource('/maintenance', 'MaintenanceController');

Route::resource('/maintenance_report', 'MaintenanceReportController');

Route::get('/loadmaintenance', 'MaintenanceController@AjaxLoad')->name('admin.maintenance.ajax');


Route::resource('/supplier', 'SupplierController');
Route::get('/loadsuppliers', 'SupplierController@AjaxLoad')->name('admin.suppliers.ajax');

Route::resource('/sections', 'SectionController');
Route::get('/loadsections', 'SectionController@AjaxLoad')->name('admin.sections.ajax');


Route::resource('/warranties', 'WarrantyController');
Route::get('/load-warranties', 'WarrantyController@AjaxLoad')->name('warranties.ajax');

################################### new routes ##########################################

Route::get('/priceoffer_verify/{id}', 'PriceOfferController@edit_verify')->name('priceoffer.edit_verify');

Route::get('/priceoffer_add_attach/{id}', 'PriceOfferController@add_attach_form')->name('priceoffer.add_attach');

Route::post('/priceoffer_multiuploads/{id}', 'PriceOfferController@upload_attach_mo')->name('priceoffer.multiuploads');
