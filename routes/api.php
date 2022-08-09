<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1'], function (){

    Route::post('/test','GeneralController@test');
    Route::get('/test','GeneralController@test');
    Route::get('/callback','AdvertisingController@paymentResult')->name('api.callback');


    Route::get('/settings','GeneralController@getSettings');
    Route::get('/cities','GeneralController@getCities');
    Route::get('/areas','GeneralController@getAreas');
    Route::get('/packages','GeneralController@getPackages');
    Route::get('/static-packages','GeneralController@getStaticPackages');
    Route::get('/get-search-property','GeneralController@getSearchProperty');


    Route::post('/register','UserController@register');
    Route::post('/login','UserController@login');


    Route::get('/getListAdvertising','AdvertisingController@getListAdvertising');
    Route::post('/search-advertising','AdvertisingController@search');
    Route::post('/likeOrUnLike','AdvertisingController@likeOrUnLike');
    Route::get('/advertising/{id}','AdvertisingController@getAdvertising');
    Route::get('/similarAdvertising/{id}','AdvertisingController@similarAdvertising');
    Route::get('/listComments/{id}','AdvertisingController@getListComments');


    Route::group(["prefix"=>"user"],function (){
        Route::get('/login','UserController@unAuthorize')->name('unAuthorize');
        Route::get("/notifications",'UserController@notifications');
        Route::post("/verifyUserBySmsCode",'UserController@verifyUserBySmsCode');
        Route::post("/resetPassword",'UserController@resetPassword');
        Route::post('/sendResetPasswordCode','UserController@sendRequestSmsCode');
        Route::post("/sendSmsCode",'UserController@sendSmsCode');
        Route::post("/logVisitAdvertising",'AdvertisingController@logVisitAdvertising');

        Route::group(['middleware' => 'auth:api'], function (){
            Route::get("/getCountBooking",'UserController@getCountBooking');
            Route::get("/getBalance",'UserController@getBalance');
            Route::get("/payments",'UserController@payments');

            Route::post("/isValidRegisterAdvertising",'UserController@isValidRegisterAdvertising');
            Route::post("/updateLanguage",'UserController@updateLanguage');
            Route::post("/saveLicense",'UserController@saveLicense');


            Route::get("/getSavedAdvertising",'AdvertisingController@getUserSaved');
            Route::get("/advertising",'AdvertisingController@getUserAdvertising');
            Route::get("/relatedComments",'AdvertisingController@getRelatedComments');
            Route::post("/buyPackageOrCredit",'AdvertisingController@buyPackageOrCredit');
            Route::post("/advertising/create",'AdvertisingController@createAdvertising');
            Route::post("/advertising/attachFileToAdvertising",'AdvertisingController@attachFileToAdvertising');
            Route::post("/advertising/update",'AdvertisingController@updateAdvertising');
            Route::post("/advertising/delete",'AdvertisingController@deleteAdvertising');
            Route::post("/advertising/archive",'AdvertisingController@archiveAdvertising');
            Route::post("/advertising/detachArchive",'AdvertisingController@detachArchive');
            Route::post("/comment",'AdvertisingController@setComment');






            Route::post("/updateProfile",'UserController@updateProfile');
            Route::post("/updateDeviceToken",'UserController@updateDeviceToken');
            Route::post("/changePassword",'UserController@changePassword');




            Route::post("/setBooking",'AdvertisingController@setBooking');
            Route::post("/updateBooking",'AdvertisingController@updateBooking');
            Route::post("/acceptOrRejectBooking",'AdvertisingController@acceptOrRejectBooking');
            Route::post("/deleteBooking",'AdvertisingController@deleteBooking');
            Route::get("/myBooking",'AdvertisingController@myBooking');
            Route::get("/myBooker",'AdvertisingController@myBooker');


        });
    });

    Route::post('/set-ticket','ContactUsController@store');


});
