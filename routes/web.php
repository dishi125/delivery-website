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
//-----------------------------------Web Routes-----------------------------------------------------

//Route::group(['middleware' => ['ssl']], function () {
Route::group(['middleware' => 'weblogin'], function () {
    Route::post('/displayplan', 'IndexpageController@displayplan');
    Route::post('/displayplan1', 'IndexpageController@displayplan1');
});

//scripts
//Route::get('/addcountries','PagesController@addcountries');
//Route::get('/addprovinces','PagesController@addprovinces');

Route::get('/getmodels', 'PagesController@getmodels');
Route::get('/getprovinces', 'PagesController@getprovinces');
Route::get('/getcities', 'PagesController@getcities');

Route::group(['middleware' => ['preventBackHistory']], function () {
    Route::get('/signup', 'PagesController@signup');
    Route::post('/sendOtp', 'PagesController@sendOtp');
    Route::post('/otpVerified', 'PagesController@otpVerified');
    Route::post('/verifyotp', 'PagesController@verifyotp');
    Route::post('/register_user', 'LoginRegisterController@register_user');
    Route::post('/login_user', 'LoginRegisterController@login_user');
    Route::group(['middleware' => ['guestcheck']], function () {
        Route::get('/signin', 'PagesController@signin');
        Route::get('/', 'PagesController@index');
    });
    Route::post('/register_driver', 'LoginRegisterController@register_driver');
    Route::post('/login_driver', 'LoginRegisterController@login_driver');
    Route::post('/set_index_session', 'PagesController@set_index_session');
    Route::get('/index_packages/{cnt_to}', 'PagesController@index_packages');
    Route::post('/store_index_data', 'PagesController@store_index_data');
    Route::get('/setaddresssuggestion/{add}', 'PagesController@setaddresssuggestion');
    Route::post('/checkaddress', 'PagesController@checkaddress');

    Route::get('/otp', 'PagesController@otp');
    Route::post('/submitotp', 'LoginRegisterController@submitotp');
    Route::post('/driverotp', 'LoginRegisterController@driverotp');
    Route::get('/resend_otp_to_driver', 'LoginRegisterController@resend_otp_to_driver');
    Route::get('/resend_otp_to_user', 'LoginRegisterController@resend_otp_to_user');


    Route::group(['middleware' => 'weblogin'], function () { //access only when session of driver or user exists
        Route::get('/home_user', 'PagesController@home_user');
        Route::get('/home_driver', 'PagesController@home_driver');
        Route::get('/new_request', 'PagesController@new_request');
        Route::get('/approval_request', 'PagesController@approval_request');
        Route::get('/request_list', 'PagesController@request_list');
        Route::get('/edit_user_profile/{id}', 'LoginRegisterController@edit_user_profile');
        Route::get('/view_plan_list', 'IndexpageController@view_plan_list');

        //saved plan


        Route::get('/display_link_plan1/{id}', 'IndexpageController@display_link_plan1');//manual_plan
        Route::get('/gmapsdata1/{id}', 'IndexpageController@gmapsdata1');


        //request list route

        Route::get('/display_request_plan/{id}', 'IndexpageController@display_request_plan');//manual_plan
        Route::get('/requestgmapsdata/{id}', 'IndexpageController@requestgmapsdata');
        Route::post('/sendrequest', 'IndexpageController@sendrequest');

        //new request routes
        Route::post('/store_data', 'PagesController@store_data');
        Route::get('/new_manual_plan/', 'PagesController@new_manual_plan');//manual_plan
        Route::get('/newgmapsdata', 'PagesController@newgmapsdata');
        Route::get('/store_plan_data', 'LoginRegisterController@store_plan_data');
        Route::post('/save_request_plan', 'PagesController@save_request_plan');
        Route::get('/editrequest/{pid}', 'PagesController@editrequest');
        Route::get('/edit_driver_profile/{id}', 'LoginRegisterController@edit_driver_profile');

        Route::patch('/update_user_profile/{id}', 'LoginRegisterController@update_user_profile');
        Route::patch('/update_driver_profile/{id}', 'LoginRegisterController@update_driver_profile');
        Route::post('/payment_approval_form', 'PagesController@payment_approval_form');

        //review
        Route::get('/review/{id}', 'PagesController@review');
        Route::post('/submitreview', 'PagesController@submitreview');
        Route::post('/driver_submit_review', 'PagesController@driver_submit_review');

        //paypal payment routes
        Route::post('/payment_delivery', 'PaymentController@payment_delivery');
        Route::get('/status', 'PaymentController@getPaymentStatus');
        Route::get('/cancel_transaction/{id}', 'PaymentController@cancel_transaction');


        Route::get('/assign_request', 'PagesController@assign_request');
        Route::get('/assign_requestdata/{id}', 'PagesController@assign_requestdata');
        Route::get('/delivery_complete_form/{id}', 'PagesController@delivery_complete_form');
        Route::post('/delivery_complete', 'PagesController@delivery_complete');

    });
    Route::post('/saveplan', 'IndexpageController@saveplan');
    Route::post('/checkuseremail', 'LoginRegisterController@checkuseremail');
    Route::post('/checkdriveremail', 'LoginRegisterController@checkdriveremail');

    Route::get('/forgot_otp', 'PagesController@forgot_otp');
    Route::post('/forget_user_password', 'LoginRegisterController@forget_user_password');
    Route::post('/forget_driver_password', 'LoginRegisterController@forget_driver_password');
    Route::post('/reset_password_data', 'LoginRegisterController@reset_password_data');
    Route::post('/check_forget_otp', 'LoginRegisterController@check_forget_otp');
    Route::get('/reset_password', 'PagesController@reset_password');
    Route::get('/forget_resend_otp', 'LoginRegisterController@forget_resend_otp');


    Route::post('/store_index_data1', 'PagesController@store_index_data1');
    Route::post('/edit_index_data1', 'IndexpageController@edit_index_data1');

    Route::get('/display_link_plan/', 'PagesController@display_link_plan');//manual_plan

    Route::get('/gmapsdata', 'PagesController@gmapsdata');
    Route::get('/edit_index_data/{pid}', 'PagesController@edit_index_data');
    Route::get('/store_main_data', 'PagesController@store_main_data');
    Route::get('/edit_index/{pid}', 'IndexpageController@edit_index');


});
Route::get('/verified-email', 'LoginRegisterController@verified_email');
Route::get('/logout', 'LoginRegisterController@logout');
//});
//------------------------------------Admin Panel----------------------------------------------------


Route::group(['middleware' => 'preventBackHistory'], function () {
    Route::get('/admin', function () {
        return redirect(url('admin/home'));
    });
    Auth::routes(['verify' => true]);

    Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('countries', 'CountryController');
        Route::resource('provinces', 'ProvinceController');
        Route::resource('cities', 'CityController');
        Route::post('/provincelist', 'CityController@provincelist');

        Route::resource('companies', 'CompanyController');
        Route::resource('webUsers', 'Web_UserController');
        Route::resource('drivers', 'DriverController');
        Route::resource('deliveryAddresses', 'Delivery_AddressesController');
        Route::get('/modaldataset/{id}', 'Delivery_AddressesController@modaldataset');
        Route::get('/packagedataset/{id}', 'Delivery_AddressesController@packagedataset');
        Route::post('/storeprice', 'Delivery_AddressesController@storeprice');
        Route::resource('assignDrivers', 'assign_driverController');
        Route::post('/assign_driver_data', 'assign_driverController@assign_driver_data');
        Route::resource('deliveryCompletions', 'delivery_completionController');
        Route::get('/deliverycompletemodaldata/{id}', 'delivery_completionController@deliverycompletemodaldata');
        Route::resource('pendingDeliveries', 'pending_deliveryController');
        Route::get('/deliverypendingmodaldata/{id}', 'pending_deliveryController@deliverypendingmodaldata');
        Route::resource('driverReviews', 'Driver_reviewController');
        Route::resource('userReviews', 'User_reviewController');

        Route::resource('transactions', 'TransactionController');
        Route::resource('tempDeliveryAddresses', 'Temp_delivery_addressesController');

        Route::resource('tempPackages', 'Temp_packagesController');
        Route::get('/driver_data/{id}', 'pending_deliveryController@driver_data');

        Route::resource('carMakes', 'CarMakeController');
        Route::resource('carModels', 'CarModelController');

        //filtering
        Route::get('/webusers/fetch_data', 'Web_UserController@fetch_data');
        Route::get('/country/fetch_data', 'CountryController@fetch_data');
        Route::get('/driver/fetch_data', 'DriverController@fetch_data');
        Route::get('/newrequest/fetch_data', 'Delivery_AddressesController@fetch_data');
        Route::get('/assigndriver/fetch_data', 'assign_driverController@fetch_data');
        Route::get('/deliverycomplete/fetch_data', 'delivery_completionController@fetch_data');
        Route::get('/deliverypending/fetch_data', 'pending_deliveryController@fetch_data');
        Route::get('/deliverreview/fetch_data', 'Driver_reviewController@fetch_data');
        Route::get('/userreview/fetch_data', 'User_reviewController@fetch_data');
        Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    });



});
        Route::get('email', function (){
            return view('emails.verificationlink');
        });




