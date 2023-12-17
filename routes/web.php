<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/foo', function () {
//     Artisan::call('storage:link');
// });

// install Middleware
Route::group(['middleware' => ['install']], function () {

    Route::get('/', function () {
        return view('welcome');
    })->name('index');

    // Check Registration is on or off
    Auth::routes(['register' => (get_option('registration') && get_option('registration') == 0 ? false : true)]);

    
    // ::::::::::::::::::::::::::::::  Admin Route ::::::::::::::::::::::::
    Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
        // ::::::::::::::::::::::::::::::::: Contact :::::::::::::::::::::::::::::::::::::::::: 
        Route::get('/contact', function() {
            return view('admin.contact');
        })->name('contact');
        // ::::::::::::::::::::::::::::::: Admin Profile ::::::::::::::::::::::::::::::::::::::
        Route::get('/me', 'ProfileController@index')->name('me');
        Route::get('/my-activity/datatable', 'ProfileController@datatable')->name('my-activity.datatable');
        Route::post('/profile/personal-info-change', 'ProfileController@personal_info_change')->name('profile.personal-info-change');
        Route::post('change-password', 'ProfileController@changepassword')->name('change.password');
        Route::post('change-social', 'ProfileController@changesocial')->name('change.social');
        Route::post('change-other', 'ProfileController@changeother')->name('change.other');

        // :::::::::::::::::::::::::::::: Settings Part ::::::::::::::::::::::::::::::::::::::::
        Route::post('settings', 'SettingsController@store')->name('settings');
        Route::get('settings/general', 'SettingsController@general_settings')->name('general.settings');
        Route::get('settings/dashboard', 'SettingsController@dashboard_settings')->name('general.dashboard');
        Route::get('settings/login', 'SettingsController@login_settings')->name('general.login');

        // :::::::::::::::::::::::::::::  Loan Manage ::::::::::::::::::::::::::::::::::::::::: 
        Route::get('loan/summary/datatable', 'LoanController@summaryDatatable')->name('loan.summary.datatable');
        Route::get('loan/datatable', 'LoanController@datatable')->name('loan.datatable');
        Route::get('loan/summery', 'LoanController@summery')->name('loan.summery');
        Route::get('loan/pay/{id}', 'LoanController@pay')->name('loan.pay');
        Route::post('loan/pay-amount', 'LoanController@pay_amount')->name('loan.pay-amount');
        Route::resource('loan', 'LoanController');

        // ::::::::::::::::::::::::::::::  Customer Manage ::::::::::::::::::::::::::::::::::::::: 
        Route::get('customer/datatable', 'CustomerController@datatable')->name('customer.datatable');
        Route::resource('customer', 'CustomerController');

        // :::::::::::::::::::::::::::::: Supplier Manage ::::::::::::::::::::::::::::::::
        Route::get('supplier/datatable', 'SupplierController@datatable')->name('supplier.datatable');
        Route::resource('supplier', 'SupplierController');

        // :::::::::::::::::::::::::::::: Product Initialize :::::::::::::::::::::::::::::::: 
        Route::group(['as' => 'product-initiazile.', 'prefix' => 'product-initiazile', 'namespace' => 'Product'], function () {
            // :::::::::::::::::::::::::::: Product Category :::::::::::::::::::::::::::: 
            Route::get('category/datatable', 'CategoryController@datatable')->name('category.datatable');
            Route::post('category/get-category', 'CategoryController@get_category')->name('category.get_category');
            Route::resource('category', 'CategoryController');

            // ::::::::::::::::::::::::::::: Product Brand :::::::::::::::::::::::::::::::::::: 
            Route::get('brand/datatable', 'BrandController@datatable')->name('brand.datatable');
            Route::resource('brand', 'BrandController');

            // ::::::::::::::::::::::::::::: Product Unit :::::::::::::::::::::::::::::::::::: 
            Route::get('unit/datatable', 'UnitController@datatable')->name('unit.datatable');
            Route::resource('unit', 'UnitController');

            // ::::::::::::::::::::::::::::: Product Box :::::::::::::::::::::::::::::::::::: 
            Route::get('box/datatable', 'BoxController@datatable')->name('box.datatable');
            Route::resource('box', 'BoxController');

            // ::::::::::::::::::::::::::::: Taxrate :::::::::::::::::::::::::::::::::::: 
            Route::get('taxrate/datatable', 'TaxRateController@datatable')->name('taxrate.datatable');
            Route::resource('taxrate', 'TaxRateController');

            // ::::::::::::::::::::::::::::: Size :::::::::::::::::::::::::::::::::::: 
            Route::get('size/datatable', 'SizeController@datatable')->name('size.datatable');
            Route::resource('size', 'SizeController');

            // ::::::::::::::::::::::::::::: Color :::::::::::::::::::::::::::::::::::: 
            Route::get('color/datatable', 'ColorController@datatable')->name('color.datatable');
            Route::resource('color', 'ColorController');

            // ::::::::::::::::::::::::::::: Payment Method :::::::::::::::::::::::::::::::::::: 
            Route::get('payment-method/datatable', 'PaymentMethodController@datatable')->name('payment-method.datatable');
            Route::resource('payment-method', 'PaymentMethodController');
        });
        
        // :::::::::::::::::::::::::::::: Product Section :::::::::::::::::::::::::::::::: 
        Route::group(['as' => 'products.', 'prefix' => 'products', 'namespace' => 'Product'], function () {
            // ::::::::::::::::::::::::::::: Product :::::::::::::::::::::::::::::::::::: 
            Route::get('products/datatable', 'ProductsController@datatable')->name('products.datatable');
            Route::get('products/purchase/{$id}', 'ProductsController@purchase')->name('products.purchase');
            Route::get('products/print_barcode/{$id}', 'ProductsController@print_barcode')->name('products.print_barcode');
            Route::get('import-products', 'ProductsController@import_product_show')->name('products.import');
            Route::post('upload-products', 'ProductsController@import_product_upload')->name('products.upload_file');
            Route::resource('products', 'ProductsController');

            // ::::::::::::::::::::::::::::: Add Category From Product Page :::::::::::::::::::::::::
            Route::get('open-category-form', 'ProductsController@add_category')->name('products.add_category');
            Route::post('submit-category-form', 'ProductsController@save_category')->name('products.save_category');

            // ::::::::::::::::::::::::::::: Add Supplier From Product Page :::::::::::::::::::::::::
            Route::get('open-supplier-form', 'ProductsController@add_supplier')->name('products.add_supplier');
            Route::post('submit-supplier-form', 'ProductsController@save_supplier')->name('products.save_supplier');

            // ::::::::::::::::::::::::::::: Add Brand From Product Page :::::::::::::::::::::::::
            Route::get('open-brand-form', 'ProductsController@add_brand')->name('products.add_brand');
            Route::post('submit-brand-form', 'ProductsController@save_brand')->name('products.save_brand');

            // ::::::::::::::::::::::::::::: Add Box From Product Page :::::::::::::::::::::::::
            Route::get('open-box-form', 'ProductsController@add_box')->name('products.add_box');
            Route::post('submit-box-form', 'ProductsController@save_box')->name('products.save_box');

            // ::::::::::::::::::::::::::::: Add Unit From Product Page :::::::::::::::::::::::::
            Route::get('open-unit-form', 'ProductsController@add_unit')->name('products.add_unit');
            Route::post('submit-unit-form', 'ProductsController@save_unit')->name('products.save_unit');

            // ::::::::::::::::::::::::::::: Add Tax From Product Page :::::::::::::::::::::::::
            Route::get('open-tax-form', 'ProductsController@add_tax')->name('products.add_tax');
            Route::post('submit-tax-form', 'ProductsController@save_tax')->name('products.save_tax');

            // :::::::::::::::::::::::::::::: Open Add Variation ::::::::::::::::::::::::::::::: 
            Route::get('add_variations', 'ProductsController@add_variations')->name('add_variations');
            Route::get('add_one_more_row', 'ProductsController@add_one_more_row')->name('add_one_more_row');

            // :::::::::::::::::::::::::::::: Delete Multiple Item :::::::::::::::::::::::::::::::::::: 
            Route::post('delete-multiple-item', 'ProductsController@delete_multiple_item')->name('delete_multiple_item');

            // ::::::::::::::::::::::::::::::: Stock Alert ::::::::::::::::::::::::::::::::::::::::::::: 
            Route::get('stock-alert', 'ProductsController@stock_alert')->name('stock_alert');
            Route::get('stock-datatable', 'ProductsController@stock_datatable')->name('stock_datatable');
        });

        // :::::::::::::::::::::::::::::::: Add Product From Purchase ::::::::::::::::::::::::::::::::: 
        Route::get('purchase/due-purchase-invoice', 'Purchase\PurchaseController@due_invoice')->name('purchase.due_invoice');
        Route::get('purchase/due-purchase-invoice-datatable', 'Purchase\PurchaseController@due_invoice_datatable')->name('purchase.due_invoice_datatable');
        Route::get('check-payment-method', 'Product\PaymentMethodController@check_payment_method')->name('check-payment-method');
        Route::get('add-product-from-purchase', 'Purchase\PurchaseController@add_product_from_purchase')->name('add_product_from_purchase');
        Route::post('get-supplier-name-from-purchase-page', 'Purchase\PurchaseController@get_supplier_name_from_purchase_page')->name('get_supplier_name_from_purchase_page');
        Route::post('show-product-for-purchase', 'Purchase\PurchaseController@show_product_for_purchase')->name('show-product-for-purchase');
        Route::post('purchase/add-product-from-purchase', 'Purchase\PurchaseController@add_product_from_purchase_post')->name('purchasse.add_product_from_purchase_post');
        // :::::::::::::::::::::::::::::: Product Purchase ::::::::::::::::::::::::::::::: 
        Route::get('add-purchase-row', 'Purchase\PurchaseController@add_pruchase_row')->name('add_pruchase_row');
        Route::get('purchase/{id}', 'Purchase\PurchaseController@product_purchase')->name('product_purchase');
        Route::get('purchase-product-details/datatable', 'Purchase\PurchaseController@datatable')->name('purchase_product.datatable');
        Route::get('purchase-pay-bills/{id}', 'Purchase\PurchaseController@show_pay_form')->name('purchase.pay');
        Route::post('purchase.pay_due_bill', 'Purchase\PurchaseController@pay_due')->name('purchase.pay_due_bill');
        Route::resource('purchase', 'Purchase\PurchaseController');

        // ::::::::::::::::::::::::::::::  Purchase Return :::::::::::::::::::::::::::::::::::::::::: 
        Route::get('purchase-return/{id}', 'Purchase\ReturnController@show_purchse_return_form')->name('purchase.return');
        Route::post('purchse-make-return', 'Purchase\ReturnController@make_purchase_return')->name('purchse.make_return');

        // :::::::::::::::::::::::::::::  Point of Sell ::::::::::::::::::::::::::::::::::::::::::::: 
        Route::get('point-of-sell', 'Sell\PointOfSellController@index')->name('point-of-sell');
        Route::get('get-products-by-category', 'Sell\PointOfSellController@get_product_by_category')->name('get_product_by_category');
        Route::get('create-customer-form-pos', 'Sell\PointOfSellController@creaet_customer_from_pos')->name('creaet_customer_from_pos');
        Route::post('store-customer-from-pos', 'Sell\PointOfSellController@store_customer_from_pos')->name('store_customer_from_pos');
        Route::get('show_customer_list_for_pos', 'Sell\PointOfSellController@show_customer_list_for_pos');
        Route::get('set_customer_for_pos', 'Sell\PointOfSellController@set_customer_for_pos');
        Route::get('add_sell_row', 'Sell\PointOfSellController@add_sell_row')->name('add_sell_row');
        Route::get('get_product_from_pos', 'Sell\PointOfSellController@get_product_from_pos');
        Route::get('pay_now_from_pos', 'Sell\PointOfSellController@pay_now_from_pos')->name('pay_now_from_pos');
        Route::get('edit_customer_from_pos', 'Sell\PointOfSellController@edit_customer_from_pos')->name('edit_customer_from_pos');
        Route::patch('update_customer_from_pos/{id}', 'Sell\PointOfSellController@update_customer_from_pos')->name('update_customer_from_pos');
        Route::get('edit_customer_mobile_from_pos', 'Sell\PointOfSellController@edit_customer_mobile_from_pos')->name('edit_customer_mobile_from_pos');
        Route::patch('update_customer_mobile_from_pos/{id}', 'Sell\PointOfSellController@update_customer_mobile_from_pos')->name('update_customer_mobile_from_pos');
        Route::post('send-pos-item', 'Sell\PointOfSellController@send_pos_item')->name('send-pos-item');
        Route::post('full-paid-from-pos', 'Sell\PointOfSellController@full_paid_from_pos')->name('full-paid-from-pos');
        Route::post('full-due-from-pos', 'Sell\PointOfSellController@full_due_from_pos')->name('full-due-from-pos');
        Route::post('pay-now', 'Sell\PointOfSellController@pay_now')->name('pay-now');

        // expense Group
        Route::group(['as' => 'expense.', 'prefix' => 'expense', 'namespace' => 'Expense'], function() {

            //  :::::::::::::::::::::::::::::::::::: Expense Category ::::::::::::::::::::::::::::::::::::::::::::::::::::::: 
            Route::get('expense-cateogy/datatable', 'ExpenseCategoryController@datatable')->name('expense-cateogy.datatable');
            Route::resource('expense-category', 'ExpenseCategoryController');

            //  ::::::::::::::::::::::::::::::::::::: Expense ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: 
            Route::get('expense/datatable', 'ExpenseController@datatable')->name('expense.datatable');
            Route::resource('expense', 'ExpenseController');

            // :::::::::::::::::::::::::::::::::::::::: Expense Summery :::::::::::::::::::::::::::::::::::::::::::::::::::: 
            Route::get('expens-summery', 'ExpenseSummeryController@index')->name('expense_summer');
        });

        // ::::::::::::::::::::::::::::::::::::::: Accounting ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: 
        Route::group(['as' => 'account.', 'prefix' => 'account', 'namespace' => 'Account'], function() {
            // ::::::::::::::::::::::::::::: Account Diposit ::::::::::::::::::::::::::::::::::::::::::::::::
            Route::resource('diposit', 'DipositController');

            // :::::::::::::::::::::::::::::: Bank Account ::::::::::::::::::::::::::::::::::::::::::::::::::
            Route::get('bank-account/datatable', 'BankAcountController@datatable')->name('bank-account.datatable');
            Route::resource('bank-account', 'BankAcountController');
        });

        // ::::::::::::::::::::::::::::: User Role Permission :::::::::::::::::::::::::::::::::::::::  
        Route::group(['as' => 'user.', 'prefix' => 'user'], function () {
			Route::get('/role', 'RoleController@index')->name('role');
			Route::get('/role/datatable', 'RoleController@datatable')->name('role.datatable');
			Route::post('/role/store', 'RoleController@store')->name('role.store');
			Route::get('/role/edit/{id}', 'RoleController@edit')->name('role.edit');
			Route::post('/role/edit', 'RoleController@update')->name('role.update');
			Route::delete('/role/delete/{id}', 'RoleController@destroy')->name('role.delete');
			//user:::::::::::::::::::::::::::::::::
			Route::get('/', 'UserController@index')->name('index');
			Route::get('/datatable', 'UserController@datatable')->name('datatable');
			Route::any('/create', 'UserController@create')->name('create');
			Route::put('/change/{value}/{id}', 'UserController@status')->name('change');
			Route::get('/edit/{id}', 'UserController@edit')->name('edit');
			Route::put('/edit', 'UserController@update')->name('update');
			Route::delete('/delete/{id}', 'UserController@destroy')->name('delete');
		});

    });

    Route::get('/home', 'HomeController@index')->name('admin.home');

});

// :::::::::::::::::::::::::: Installation Route :::::::::::::::::::::::::::::::::::::::::::::::::
Route::get('pre-setup', 'Install\InstallController@index');
Route::get('pre-setup/database', 'Install\InstallController@database');
Route::post('pre-setup/process_install', 'Install\InstallController@process_install');
Route::post('pre-setup/store_user', 'Install\InstallController@store_user');
Route::post('pre-setup/finish', 'Install\InstallController@final_touch');

// ::::::::::::::::::::::::: Sadik LOg :::::::::::::::::::::::::::::::::::::::::::::::::::::::::: 
Route::get('add-to-log', 'HomeController@myTestAddToLog');
