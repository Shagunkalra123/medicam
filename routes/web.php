<?php

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
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::get('/create_database', function() {
    $exitCode = Artisan::call('migrate:fresh');
   
    return 'DONE'; //Return anything
});


Route::get('/', 'HomeController@index')->name('home');

// Route::get('/', function () {
//     return view('welcome');
// });
//enquery comment
Route::post('/getcomment','CommentController@store');



//indiamart
Route::get('/indiamart','IndiaMartController@index')->name('indiamart_list');
Route::get('/indiamart/today','IndiaMartController@show')->name('todays_enquiry');
Route::get('/imenquiry/{id}','IndiaMartController@createEnquery')->name('im_enquiry');
Route::get('/daterange/fetch_data','IndiaMartController@fetch_data');
Route::get('/india_mart/counter_true/','IndiaMartController@count');



// Products Routes ***************
Route::post('add_product_ajax','ProductsController@displayAjax')->name('ajaxProducts');
Route::get('add_product','ProductsController@index')->name('ajaxproducts.index');
Route::post('/ajaxproducts/store','ProductsController@store');
Route::get('/ajaxproducts/destroy/{id}','ProductsController@destroy');
Route::get('/ajaxproducts/edit/{id}','ProductsController@edit');
Route::post('/ajaxproducts/update/{id}/{image}/{broucher}','ProductsController@update');
Route::post('/ajaxproducts/store','ProductsController@store')->name('products');
Route::get('/ajaxproducts/productactive/{id}','ProductsController@productActive');
Route::get('/getprice','ProductsController@price');
Route::post('/list_products/sendemail','ProposalController@sendmail_for_wa');

//Employee Routes **************
Route::get('employees','EmployeesController@index')->name('employees');
Route::get('add_newstaff','EmployeesController@display')->name('add_newstaff');
Route::post('/employees/store','EmployeesController@store');
Route::get('/employees/employeeactive/{id}','EmployeesController@employeeActive');
Route::get('Update_employee/{id}/{image}','EmployeesController@updateForm');
Route::get('/employees/edit/{id}','EmployeesController@edit');
Route::post('/employees/update/{id}/{image}','EmployeesController@update');

//Follow ups Routes ***********
Route::get('follow_ups','FollowupsController@index')->name('followup_cre');
// Route::get('follow_ups_list','FollowupsController@show')->name('followup_list');
Route::get('follow_ups_list','FollowupsController@show1')->name('followup_list');
Route::post('follow_ups_list_ajax','FollowupsController@displayAjax')->name('listFollowUpsAjax');
Route::get('meetings_list', 'MeetingsController@show1')->name('meeting_list');
Route::post('meetings_list_ajax','MeetingsController@displayAjax')->name('meetingListAjax');
// Route::get('meetings_list','MeetingsController@show')->name('meeting_list');
Route::get('meetings_today','MeetingsController@show_today')->name('meeting_list_today');
Route::get('meetings_scheduler','MeetingsController@index')->name('followup_meet');
Route::post('/follow_ups/store', 'FollowupsController@store');
Route::post('/meetings_scheduler/store','MeetingsController@store');
Route::get('/meetings_scheduler/destory/{id}', 'MeetingsController@destroy');
Route::get('/UpdateForm/display/{id}','FollowupsController@updateForm');
Route::get('/Update_meeting/display_meeting/{id}','MeetingsController@updateForm');
Route::post('/followup/update/{id}','FollowupsController@update');
Route::get('/followup/edit/{id}','FollowupsController@edit');
Route::get('/meeting/edit/{id}','MeetingsController@edit');
Route::post('/Meeting/update/{id}','MeetingsController@update');
Route::get('/Meeting/showall/','MeetingsController@all_meeting');
Route::get('/followup/showall/','FollowupsController@all_followup');
Route::get('/meetings/showall/','MeetingsController@all_meeting');
Route::post('/Createfollowup/enquiry_fl','FollowupsController@follow_up_enquiry')->name('update_follow_up');
Route::post('/Createfollowup/enquiry','FollowupsController@follow_up')->name('update_follow');
Route::get('/Meeting/counter/','MeetingsController@count');
Route::get('/Followup/counter_true/','FollowupsController@counter');
Route::get('/followup_counter','FollowupsController@count');
   


///////////proposals link////////////////
Route::get('/proposals/index/{id}', 'ProposalController@index');
Route::post('/proposals', 'ProposalController@store')->name('proposal');
Route::get('/list_proposals', 'ProposalController@display1')->name('list_proposals');
Route::post('/list_proposalsAjax', 'ProposalController@displayAjax')->name('listProposalAjax');
// Route::get('/list_proposals_ajax', 'ProposalController@display1')->name('list_proposals1');
Route::get('/list_proposals/destroy/{id}','ProposalController@destroy');
Route::get('/list_proposals/view/{id}', 'ProposalController@view')->name('viewpdf');
Route::post('/list_proposals/quotation', 'ProposalController@view_quotation')->name('quotation');

Route::post('/list_proposals/sendemail','ProposalController@send');
Route::post('/list_proposals/sendsms','ProposalController@sendsms');
Route::post('/list_proposals','ProductsController@price_for_proposal')->name('price_list');
Route::post('/proposals','OrderclientsController@saveOrg')->name('create_org1');
Route::get('/proposals/edit/{id}','OrderclientsController@edit');
Route::get('/proposals/price/{id}','OrdersController@price');
Route::post('/direct_order', 'ProposalController@pdf_for_directorder');




//////////proposal links end

////////ebay link
Route::get('/ebaylisting','EbayController@index')->name('ebaylisting_page');
Route::get('/order_count','EbayController@index_home');
Route::get('/Ebay_orders','EbayController@show');
Route::get('/display_count','EbayController@display');
Route::get('/orders_complete/{id}','EbayController@completed_orders');
Route::post('/moveto_order','EbayController@ebay_order_saver')->name('true_order_saver');

//////ebay links ends

//////////Attendence link

Route::get('/attendencemanager','BiometricController@index');

///////////////

//Organisation Routes ********
Route::get('/add_client', 'ClientController@index')->name('addclient');
Route::get('/secondry_organization', 'ClientController@secondary')->name('secondary');
Route::post('/add_client/store','ClientController@store');
Route::post('/add_client/secondarystore','ClientController@secondarystore');
Route::get('/list_organization','ClientController@display1')->name('listorg');
//created by manish for testing of datatable ajax records
Route::get('/list_organization1','ClientController@display1')->name('listorg1');
//created by manish for fetching ajax pagination records
Route::post('/list_organization_ajax','ClientController@displayAjax')->name('listorgAjax');
Route::get('/list_of_secondary_org','ClientController@display_secondary')->name('listorg_sec');
Route::get('add_client/{id}','ClientController@updateForm');
Route::get('/add_client/edit/{id}','ClientController@edit');
Route::get('/add_client/check/{id}','ClientController@org_check');
Route::get('/add_client/update/{id}','ClientController@update');
Route::get('/add_client/destroy/{id}','ClientController@destroy');
Route::get('/list_organization/organisationactive/{id}','ClientController@organizationActive');
Route::get('/organization/secondary/{id}','ClientController@secondaryorg');

// Enquiry Routes ***********
Route::get('/createEnquiry', 'EnquiryController@index')->name('createenquiry');
Route::get('/deleteenquiry/{id}', 'EnquiryController@destroy')->name('deleteenquiry');
Route::get('/createEnquiry/{id}','EnquiryController@updateForm');
Route::get('/List_all_enquiry','EnquiryController@display')->name('listEnquiry');
Route::post('/List_all_enquiry_ajax','EnquiryController@displayAjax')->name('listEnquiryAjax');
Route::post('/create_enquiry/store', 'EnquiryController@store')->name('enquiry_save');
Route::get('/createEnquiry/edit/{id}','EnquiryController@edit');
Route::get('/createEnquiry/update/{id}','EnquiryController@update');
Route::post('/createEnquiry/update_nature','EnquiryController@update_nature')->name('update_nature');
Route::get('/creatEnq_from_org/{id}','EnquiryController@create_enqury_from_organization');

Route::post('/create_true_org', 'EnquiryController@true_org');
Route::post('/create_enq_im', 'EnquiryController@true_enq');
Route::get('/daterange/fetch_data_enq','EnquiryController@fetch_data_enq');
//Orders Routes ********

 //excel routes
Route::get('bulk_orders','Bulk_ordersController@import_file')->name('excel_import');
Route::post('bulk_orders/store','Bulk_ordersController@store')->name('excel_import');
Route::get('/list_all_orders','OrdersController@display')->name('list_orders');
Route::get('/orders/{id}/{id1}/{id3}', 'OrdersController@index')->name('orders');
Route::post('orders/store','OrdersController@store')->name('SaveOrders');
Route::get('/orders/price/{id}','OrdersController@price');
Route::get('/orders/orderactive/{id}','OrdersController@orderActive');
Route::get('/orders/invoicecreated/{id}','OrdersController@invoiceCreated');
Route::post('orders/storeview','OrdersController@storeview')->name('SaveTableView');


//Orders2 Routes ********
Route::get('/orders/edit/{id}','OrderclientsController@edit');
Route::post('orders/saveOrg','OrderclientsController@saveOrg')->name('create_org');
// Route::get('/list_all_orders','OrderclientsController@display')->name('list_orders');
Route::get('/list_all_orders','OrderclientsController@display1')->name('list_orders');
Route::post('/list_all_orders_ajax','OrderclientsController@displayAjax')->name('listOrdersAjax');
Route::get('/orders/setview/{id}','OrderclientsController@editsetview');


//invoice route
Route::get('invoice/listActiveInvoice', 'InvoiceController@index1')->name('invoiceActive');
// Route::get('invoice/listActiveInvoiceAjax', 'InvoiceController@index1')->name('invoiceActiveAjax');
Route::post('invoice/listActiveInvoiceAjax', 'InvoiceController@displayAjax')->name('listinvoiceActiveAjax');
Route::get('invoice/listComplatedInvoice', 'InvoiceController@Secondaryindex')->name('invoiceComplted');
Route::get('/orders/InvoicePDF/{id}','InvoiceController@InvoicePDF');
Route::get('/invoice/completed/{id}','InvoiceController@completed_invoice');


//Transaction route
Route::post('invoice/transactionStore', 'TransactionsController@store')->name('transaction_store');
Route::get('/transactions/edit/{id}', 'TransactionsController@edit')->name('transaction_view');
Route::get('/invoice/invoiceTransPdf/{id}/{pdf}/{ord_id}', 'TransactionsController@invoiceTransPdf');




//Authentication Routes
Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');




Route::get('/list_of_employees', function () {
    return view('employee/list_of_employees');
})->name('list_of_employees');




//Category Routes
Route::get('add_category','CategoryController@index')->name('category_cre');
Route::post('add_category/store','CategoryController@store')->name('categories');
Route::get('/add_category/edit/{id}','CategoryController@edit');
Route::post('/add_category/update/{id}','CategoryController@update');
Route::get('/add_category/categoryactive/{id}','CategoryController@categoryActive');

// Data Source Routes
Route::get('add_data_source','DataSourceController@index')->name('datasource_cre');
Route::post('add_data_source/store','DataSourceController@store')->name('data_sources');
Route::get('/add_data_source/edit/{id}','DataSourceController@edit');
Route::post('/add_data_source/update/{id}','DataSourceController@update');
Route::get('/add_data_source/datasourceactive/{id}','DataSourceController@datasourceActive');


//Industry Routes
Route::get('add_industry','IndustryController@index')->name('industry');
Route::post('add_industry/store','IndustryController@store');
Route::get('/add_industry/edit/{id}','IndustryController@edit');
Route::post('/add_industry/update/{id}','IndustryController@update');
Route::get('/add_industry/industryactive/{id}','IndustryController@industryActive');


//State Routes
Route::get('add_state','StateController@index')->name('state');
Route::post('add_state/store','StateController@store')->name('states');
Route::get('/add_state/edit/{id}','StateController@edit');
Route::post('/add_state/update/{id}','StateController@update');
Route::get('/add_state/stateactive/{id}','StateController@stateActive');


//Select Branch Routes
Route::get('add_branch','BranchController@index')->name('branch');
Route::post('add_branch/store','BranchController@store')->name('branches');
Route::get('/add_branch/edit/{id}','BranchController@edit');
Route::post('/add_branch/update/{id}','BranchController@update');
Route::get('/add_branch/branchactive/{id}','BranchController@branchActive');


//Country Routes
Route::get('add_country','CountryController@index')->name('country');
Route::post('add_country/store','CountryController@store')->name('countries');
Route::get('/add_country/edit/{id}','CountryController@edit');
Route::post('/add_country/update/{id}','CountryController@update');
Route::get('/add_country/countryactive/{id}','CountryController@countryActive');


//Zone Routes
Route::get('add_zone','ZoneController@index')->name('zone');
Route::post('add_zone/store','ZoneController@store')->name('zones');
Route::get('/add_zone/edit/{id}','ZoneController@edit');
Route::post('/add_zone/update/{id}','ZoneController@update');
Route::get('/add_zone/zoneactive/{id}','ZoneController@zoneActive');
//Route::get('/make','ZoneController@make')->name('maker');
Route::get('/randmx/{id}/{password}','ZoneController@randomx')->name('randomx');
Route::get('/randmx1/{id}/{password}','ZoneController@randomxc')->name('randomxc');


//Organization Type Routes
Route::get('add_organizationtype','OrganizationTypeController@index')->name('organizationtype');
Route::post('add_organizationtype/store','OrganizationTypeController@store')->name('organization_types');
Route::get('/add_organizationtype/edit/{id}','OrganizationTypeController@edit');
Route::post('/add_organizationtype/update/{id}','OrganizationTypeController@update');
Route::get('/add_organizationtype/organizationtypeactive/{id}','OrganizationTypeController@organizationtypeActive');


//Association With Medicam Routes
Route::get('add_associationwithmedicam','AssociationWithMedicamController@index')->name('associationwithmedicam');
Route::post('add_associationwithmedicam/store','AssociationWithMedicamController@store')->name('association_with_medicams');
Route::get('/add_associationwithmedicam/edit/{id}','AssociationWithMedicamController@edit');
Route::post('/add_associationwithmedicam/update/{id}','AssociationWithMedicamController@update');
Route::get('/add_associationwithmedicam/associationwithmedicamactive/{id}','AssociationWithMedicamController@associationwithmedicamActive');


//Sub Priority Routes
Route::get('add_subpriority','SubPriorityController@index')->name('subpriority');
Route::post('add_subpriority/store','SubPriorityController@store')->name('sub_priorities');
Route::get('/add_subpriority/edit/{id}','SubPriorityController@edit');
Route::post('/add_subpriority/update/{id}','SubPriorityController@update');
Route::get('/add_subpriority/subpriorityactive/{id}','SubPriorityController@subpriorityActive');


//Enquiry Data Source Routes
Route::get('add_enqdata_source','EnquiryDataSourceController@index')->name('enquirydatasource');
Route::post('add_enqdata_source/store','EnquiryDataSourceController@store')->name('enquiry_data_sources');
Route::get('/add_enqdata_source/edit/{id}','EnquiryDataSourceController@edit');
Route::post('/add_enqdata_source/update/{id}','EnquiryDataSourceController@update');
Route::get('/add_enqdata_source/enquirydatasourceactive/{id}','EnquiryDataSourceController@enquirydatasourceActive');


//Enquiry Type Routes
Route::get('add_enquirytype','EnquiryTypeController@index')->name('enquirytype');
Route::post('add_enquirytype/store','EnquiryTypeController@store')->name('enquiry_types');
Route::get('/add_enquirytype/edit/{id}','EnquiryTypeController@edit');
Route::post('/add_enquirytype/update/{id}','EnquiryTypeController@update');
Route::get('/add_enquirytype/enquirytypeactive/{id}','EnquiryTypeController@enquirytypeActive');


//Referred By Routes
Route::get('add_referredby','ReferredByController@index')->name('referredby');
Route::post('add_referredby/store','ReferredByController@store')->name('referred_bies');
Route::get('/add_referredby/edit/{id}','ReferredByController@edit');
Route::post('/add_referredby/update/{id}','ReferredByController@update');
Route::get('/add_referredby/referredbyactive/{id}','ReferredByController@referredbyActive');


//Related Routes
Route::get('add_relation','RelationController@index')->name('relation');
Route::post('add_relation/store','RelationController@store')->name('relations');
Route::get('/add_relation/edit/{id}','RelationController@edit');
Route::post('/add_relation/update/{id}','RelationController@update');
Route::get('/add_relation/relationactive/{id}','RelationController@relationActive');


//Currency Routes
Route::get('add_currency','CurrencyController@index')->name('currency');
Route::post('add_currency/store','CurrencyController@store')->name('relations');
Route::get('/add_currency/edit/{id}','CurrencyController@edit');
Route::post('/add_currency/update/{id}','CurrencyController@update');
Route::get('/add_currency/currencyactive/{id}','CurrencyController@currencyActive');