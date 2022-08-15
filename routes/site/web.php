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
/*/


////////////// index page
Route::get('/','MainController@index')->name('Main.index');
Route::get('/aboutus','MainController@aboutus')->name('Main.aboutus');
Route::get('/contact','MessageController@create')->name('Message.create');
Route::post('/contact', 'MessageController@store')->name('message.store');

////////////// companies
Route::group(['prefix' => 'companies'] , function (){
    Route::get('/', 'CompanyController@index')->name('companies');
    Route::get('/new', 'CompanyController@new')->middleware(['auth', 'become_company'])->name('companies.new');
    Route::post('/store', 'CompanyController@store')->middleware(['auth', 'become_company'])->name('companies.store');
    Route::put('/', 'CompanyController@update')->middleware(['auth'])->name('companies.update');
});

///////////// auth
Route::prefix('')->group(function (){
    $controller2='UserController@';
    Route::post("/sendSmsCode",$controller2.'sendSmsCode');
    Route::post("/verifyUserBySmsCode",$controller2.'verifyUserBySmsCode');
    Route::get("/get-credit-user",$controller2.'isValidRegisterAdvertising')->middleware('auth');
    Route::post("/user/profile",$controller2.'userProfile')->name('site.show.user');
    Route::post("/user/advertises",$controller2.'getAdvertises');
});


///////////// profile
Route::group(['middleware'=>['auth']],function (){
    Route::get('/profile','MainController@profile')->name('Main.profile');
    Route::post('/edituser', 'UserController@editUser')->name('User.editUser');
    Route::get('/changepassword', 'MainController@changePassword')->name('Main.changePassword');
    Route::post('/changepassword', 'UserController@changePassword')->name('User.changePassword');
    Route::get('/wishlist', 'MainController@wishList')->name('Main.wishList');
    Route::get('/paymenthistory', 'MainController@paymentHistory')->name('Main.paymentHistory');
	Route::get('/paymentdetails/{paymentid}', 'MainController@paymentDetails')->name('Main.paymentDetails');
    Route::get('/myads', 'MainController@myAds')->name('Main.myAds');
    Route::delete('/ad/delete/{advertising}', 'AdvertisingController@delete')->name('Advertising.delete');
    Route::get('/bookings', 'MainController@bookings')->name('Main.bookings');
    Route::get('/myadsbookings', 'MainController@myAdsBookings')->name('Main.myAdsBookings');
    Route::post('/acceptorrejectbooking', 'MainController@acceptOrRejectBooking')->name('Main.acceptOrRejectBooking');
    Route::get('/buypackage', 'MainController@buyPackage')->name('Main.buyPackage');
    Route::post('/buypackageorcredit', 'MainController@buyPackageOrCredit')->name('Main.buyPackageOrCredit');
});


/////////////payment result
Route::get("/payment-result",'MainController@paymentResult')->name('callback');

/////////////services
Route::get('/services/show/{service}','MainController@showService')->name('services.show');

////////////// residential ads
Route::group(['prefix' => 'cat/residentials'] , function (){
    Route::get('/', 'AdvertisingController@residentials')->name('Advertising.residentials');
    Route::get('/latest', 'AdvertisingController@latestResidentials')->name('Advertising.latestResidentials');
    Route::get('/highestprice', 'AdvertisingController@highestPriceResidentials')->name('Advertising.highestPriceResidentials');
    Route::get('/lowestprice', 'AdvertisingController@lowestPriceResidentials')->name('Advertising.lowestPriceResidentials');
    Route::get('/mostvisited', 'AdvertisingController@mostVisitedResidentials')->name('Advertising.mostVisitedResidentials');
    Route::get('/mostliked', 'AdvertisingController@mostLikedResidentials')->name('Advertising.mostLikedResidentials');
});


/////////////// industrial ads
Route::group(['prefix' => 'cat/industrials'] , function (){
    Route::get('/', 'AdvertisingController@industrials')->name('Advertising.industrials');
    Route::get('/latest', 'AdvertisingController@latestIndustrials')->name('Advertising.latestIndustrials');
    Route::get('/highestprice', 'AdvertisingController@highestPriceIndustrials')->name('Advertising.highestPriceIndustrials');
    Route::get('/lowestprice', 'AdvertisingController@lowestPriceIndustrials')->name('Advertising.lowestPriceIndustrials');
    Route::get('/mostvisited', 'AdvertisingController@mostVisitedIndustrials')->name('Advertising.mostVisitedIndustrials');
    Route::get('/mostliked', 'AdvertisingController@mostLikedIndustrials')->name('Advertising.mostLikedIndustrials');
});


//////////////// commercial ads
Route::group(['prefix' => 'cat/commercials'] , function (){
    Route::get('/', 'AdvertisingController@commercials')->name('Advertising.commercials');
    Route::get('/latest', 'AdvertisingController@latestCommercials')->name('Advertising.latestCommercials');
    Route::get('/highestprice', 'AdvertisingController@highestPriceCommercials')->name('Advertising.highestPriceCommercials');
    Route::get('/lowestprice', 'AdvertisingController@lowestPriceCommercials')->name('Advertising.lowestPriceCommercials');
    Route::get('/mostvisited', 'AdvertisingController@mostVisitedCommercials')->name('Advertising.mostVisitedCommercials');
    Route::get('/mostliked', 'AdvertisingController@mostLikedCommercials')->name('Advertising.mostLikedCommercials');
});


///////////////// premium ads
Route::group(['prefix' => 'cat/premiums'] , function (){
    Route::get('/', 'AdvertisingController@premiums')->name('Advertising.premiums');
    Route::get('/latest', 'AdvertisingController@latestPremiums')->name('Advertising.latestPremiums');
    Route::get('/highestprice', 'AdvertisingController@highestPricePremiums')->name('Advertising.highestPricePremiums');
    Route::get('/lowestprice', 'AdvertisingController@lowestPricePremiums')->name('Advertising.lowestPricePremiums');
    Route::get('/mostvisited', 'AdvertisingController@mostVisitedPremiums')->name('Advertising.mostVisitedPremiums');
    Route::get('/mostliked', 'AdvertisingController@mostLikedPremiums')->name('Advertising.mostLikedPremiums');
});


//////////////// show and search ads
Route::get('/ad/{advertising}', 'AdvertisingController@show')->name('Main.showAd');
Route::get('/search', 'AdvertisingController@search')->name('site.search');
Route::get('/ad/create', 'AdvertisingController@create')->name('Advertising.create');


//////////// archive advertising
Route::prefix('archive-advertising')->group(function (){
    $controller='ArchiveAdvertisingController@';
    Route::post('/add', $controller.'store');
    Route::post('/remove', $controller.'destroy');
});


/////////////user archive
Route::prefix('advertising')->group(function (){
    $controller='AdvertisingController@';
    Route::get('{hashNumber}/details', $controller.'details')->name('site.ad.detail');
    Route::post('/{adId}/booking', 'AdvertisingBookController@booking')->middleware('auth');

    Route::get('/create', $controller.'create')->middleware('auth')->name('site.advertising.create');
    Route::post('/store', $controller.'store')->middleware('auth')->name('site.advertising.store');;
    Route::get('{hashNumber}/edit', $controller.'edit')->name('site.advertising.edit')->middleware('auth');
    Route::post('/update', $controller.'updateAdvertising')->middleware('auth');
    Route::post('/destroy', $controller.'destroyAdvertising')->name('site.advertising.destroy')->middleware('auth');
    Route::get('/{hashNumber}/location', $controller.'advertisingLocation')->name('site.advertising.location');
    Route::get('/{hashNumber}/direction', $controller.'advertisingDirection')->name('site.advertising.direction');

});


Route::post("/like-advertising",'AdvertisingLikeController@store');
Route::post("/unlike-advertising",'AdvertisingLikeController@destroy');
Route::post("/add-comment",'CommentController@store');
Route::post("/get-comment",'CommentController@get');


Route::get("/amenities",'AdvertisingController@getAmenities');
Route::get("/cities",'AdvertisingController@getCities');
Route::post("/areas",'AdvertisingController@getAreas');
Route::post("/venuetypes",'AdvertisingController@getVenueTypes');
Route::get("/get-all-areas",'MainController@getAreas');
Route::post("/upload-video",'AdvertisingController@simpleSaveVideo');
Route::get("/venuetypestest",'AdvertisingController@getVenueTypes');

//reset forgot password

Route::get('passwords/reset', 'UserController@showLinkRequestForm')->name('password.reset');
Route::post('passwords/email', 'UserController@sendResetLinkEmail')->name('password.email');
Route::get('passwords/reset/{token}', 'UserController@showResetForm')->name('password.reset');
Route::post('passwords/reset/{token}', 'UserController@resets')->name('password.token');

// In routes/web.php
Route::feeds();


Route::get("/test",function (){
    echo bcrypt(12345678);
})->name("test");

