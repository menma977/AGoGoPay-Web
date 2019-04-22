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

Route::get('/', function () {
    if (Route::has('login')) {
        if (Auth::check()) {
            return redirect('home');
        } else {
            return view('auth.login');
        }
    }
});

Route::post('/validates', 'LinkRefController@validates')->name('validates');
Route::get('/send/view', 'LinkRefController@sendView')->name('send.view');
Route::post('/send/pass', 'LinkRefController@sendPass')->name('sendPass');

Route::get('/link/ref/{code}', 'LinkRefController@create')->name('register.link.ref');
Route::post('/link/reg', 'LinkRefController@store')->name('register.link.reg');

Route::group(['prefix' => 'adminDump', 'as' => 'admin.'], function () {
    Route::get('/login', 'AdminController@login')->name('dump.login');
    Route::post('/login/validates', 'AdminController@validates')->name('dump.login.validates');
    Route::get('/', 'AdminController@index')->name('index');
    Route::post('/find', 'AdminController@find')->name('find');

    Route::group(['prefix' => 'redeem', 'as' => 'redeem.'], function () {
        Route::get('/', 'admin\RedeemController@index')->name('index');
        Route::get('/create', 'admin\RedeemController@create')->name('create');
        Route::post('/store', 'admin\RedeemController@store')->name('store');
        Route::get('/show/{id}', 'admin\RedeemController@show')->name('show');
        Route::get('/edit/{id}', 'admin\RedeemController@edit')->name('edit');
        Route::post('/update/{id}', 'admin\RedeemController@update')->name('update');
        Route::post('/updateRedeem', 'admin\RedeemController@updateRedeem')->name('updateRedeem');
        Route::get('/destroy/{id}', 'admin\RedeemController@destroy')->name('destroy');
        Route::get('/find/{username}', 'admin\RedeemController@findUser')->name('findUser');
    });

    Route::group(['prefix' => 'rate', 'as' => 'rate.'], function () {
        Route::get('/', 'admin\InputRateController@index')->name('index');
        Route::get('/create', 'admin\InputRateController@create')->name('create');
        Route::post('/store', 'admin\InputRateController@store')->name('store');
        Route::get('/show/{id}', 'admin\InputRateController@show')->name('show');
        Route::get('/edit/{id}', 'admin\InputRateController@edit')->name('edit');
        Route::post('/update/{id}/{id1}', 'admin\InputRateController@update')->name('update');
        Route::get('/destroy/{id}', 'admin\InputRateController@destroy')->name('destroy');
    });

    Route::group(['prefix' => 'profit', 'as' => 'profit.'], function () {
        Route::get('/', 'admin\InputProfitController@index')->name('index');
        Route::get('/create', 'admin\InputProfitController@create')->name('create');
        Route::post('/store', 'admin\InputProfitController@store')->name('store');
        Route::get('/show/{id}', 'admin\InputProfitController@show')->name('show');
        Route::get('/edit/{id}', 'admin\InputProfitController@edit')->name('edit');
        Route::post('/update/{id}', 'admin\InputProfitController@update')->name('update');
        Route::get('/destroy/{id}', 'admin\InputProfitController@destroy')->name('destroy');
    });

    Route::group(['prefix' => 'wallet', 'as' => 'wallet.'], function () {
        Route::get('/', 'admin\InputWalletController@index')->name('index');
        Route::get('/create', 'admin\InputWalletController@create')->name('create');
        Route::post('/store', 'admin\InputWalletController@store')->name('store');
        Route::get('/show/{id}', 'admin\InputWalletController@show')->name('show');
        Route::get('/edit/{id}', 'admin\InputWalletController@edit')->name('edit');
        Route::post('/update/{id}', 'admin\InputWalletController@update')->name('update');
        Route::get('/destroy/{id}', 'admin\InputWalletController@destroy')->name('destroy');
    });

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/', 'admin\ProfileMemberController@index')->name('index');
        Route::get('/create', 'admin\ProfileMemberController@create')->name('create');
        Route::post('/store', 'admin\ProfileMemberController@store')->name('store');
        Route::get('/show/{id}', 'admin\ProfileMemberController@show')->name('show');
        Route::get('/edit/{id}', 'admin\ProfileMemberController@edit')->name('edit');
        Route::post('/update/{id}', 'admin\ProfileMemberController@update')->name('update');
        Route::get('/destroy/{id}', 'admin\ProfileMemberController@destroy')->name('destroy');
    });

    Route::group(['prefix' => 'valid', 'as' => 'valid.'], function () {
        Route::get('/', 'admin\ValidateArtifactController@index')->name('index');
        Route::get('/create', 'admin\ValidateArtifactController@create')->name('create');
        Route::post('/store', 'admin\ValidateArtifactController@store')->name('store');
        Route::get('/show/{id}', 'admin\ValidateArtifactController@show')->name('show');
        Route::get('/edit/{id}', 'admin\ValidateArtifactController@edit')->name('edit');
        Route::get('/update/{id}', 'admin\ValidateArtifactController@update')->name('update');
        Route::get('/free/{id}', 'admin\ValidateArtifactController@free')->name('free');
        Route::get('/destroy/{id}', 'admin\ValidateArtifactController@destroy')->name('destroy');
    });

    Route::group(['prefix' => 'wd', 'as' => 'wd.'], function () {
        Route::get('/bonus', 'admin\WithdrawController@indexBonus')->name('index.bonus');
        Route::get('/create', 'admin\WithdrawController@create')->name('create');
        Route::post('/store', 'admin\WithdrawController@store')->name('store');
        Route::get('/show/{id}', 'admin\WithdrawController@show')->name('show');
        Route::get('/edit/{id}', 'admin\WithdrawController@edit')->name('edit');
        Route::get('/update/{id}/bonus', 'admin\WithdrawController@updateBonus')->name('update.bonus');
        Route::get('/destroy/{id}', 'admin\WithdrawController@destroy')->name('destroy');
    });

    Route::group(['prefix' => 'history', 'as' => 'history.'], function () {
        Route::get('/reg', 'admin\HistoryController@reg')->name('reg');
        Route::get('/wd', 'admin\HistoryController@wd')->name('wd');
    });

    Route::group(['prefix' => 'laporan', 'as' => 'laporan.'], function () {
        Route::get('/', 'admin\LaporanController@index')->name('index');
        Route::get('/create', 'admin\LaporanController@create')->name('create');
        Route::post('/store', 'admin\LaporanController@store')->name('store');
        Route::get('/show/{id}', 'admin\LaporanController@show')->name('show');
        Route::get('/edit/{id}', 'admin\LaporanController@edit')->name('edit');
        Route::get('/update/{id}', 'admin\LaporanController@update')->name('update');
        Route::get('/destroy/{id}', 'admin\LaporanController@destroy')->name('destroy');
    });

    Route::group(['prefix' => 'pin', 'as' => 'pin.'], function () {
        Route::get('/', 'admin\PinController@index')->name('index');
        Route::get('/activate/{id}/{status}', 'admin\PinController@activate')->name('activate');
        Route::get('/delete', 'admin\PinController@deleteReOrder')->name('deleteReOrder');
        Route::post('/changeOwnerPin', 'admin\PinController@changeOwnerPin')->name('changeOwnerPin');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/getProfit', 'HomeController@getProfit')->name('getProfit');
Route::get('/doge', 'HomeController@doge')->name('doge');
Route::get('/deposit/doge', 'HomeController@depositDOGE')->name('depositDOGE');
Route::post('/doge/rq', 'HomeController@wdDOGE')->name('wdDOGE');
Route::post('/doge/final', 'HomeController@finalDOGE')->name('finalDOGE');

Route::group(['prefix' => 'network', 'as' => 'network.'], function () {
    Route::group(['prefix' => 'genealogi', 'as' => 'genealogi.'], function () {
        Route::get('find/{username}', 'GenealogiController@find')->name('find');
        Route::get('/{username}', 'GenealogiController@index')->name('index');
        Route::get('/create/{username}/{posisi}', 'GenealogiController@create')->name('create');
        Route::post('/store/{username}', 'GenealogiController@store')->name('store');
        Route::get('/show/{id}', 'GenealogiController@show')->name('show');
        Route::get('/edit/{id}', 'GenealogiController@edit')->name('edit');
        Route::post('/update/{id}', 'GenealogiController@update')->name('update');
        Route::get('/destroy/{id}', 'GenealogiController@destroy')->name('destroy');
    });

    Route::group(['prefix' => 'sponsor', 'as' => 'sponsor.'], function () {
        Route::get('/', 'SponsorController@index')->name('index');
        Route::get('/{user}/get', 'SponsorController@get')->name('get');
        Route::get('/create', 'SponsorController@create')->name('create');
        Route::post('/store', 'SponsorController@store')->name('store');
        Route::get('/show/{id}', 'SponsorController@show')->name('show');
        Route::get('/edit/{id}', 'SponsorController@edit')->name('edit');
        Route::post('/update/{id}', 'SponsorController@update')->name('update');
        Route::get('/destroy/{id}', 'SponsorController@destroy')->name('destroy');
    });
});

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/', 'UserController@index')->name('index');
    Route::get('/create', 'UserController@create')->name('create');
    Route::post('/store', 'UserController@store')->name('store');
    Route::get('/show/{id}', 'UserController@show')->name('show');
    Route::get('/edit/{id}', 'UserController@edit')->name('edit');
    Route::get('/edit/{id}/validate/email', 'UserController@email')->name('email');
    Route::get('/edit/{id}/validate/email/send', 'UserController@sendEmail')->name('send.email');
    Route::get('/edit/password/{id}/{code}', 'UserController@editPassword')->name('edit.password');
    Route::post('/update/{id}', 'UserController@update')->name('update');
    Route::post('/update/password/{id}', 'UserController@updatePassword')->name('update.password');
    Route::get('/destroy/{id}', 'UserController@destroy')->name('destroy');
});

Route::group(['prefix' => 'financial', 'as' => 'financial.'], function () {
    Route::get('/all/financial', 'FinancialController@allFinancial')->name('all.financial');
    Route::get('/profit', 'FinancialController@profit')->name('profit');
    Route::get('/statement', 'FinancialController@statement')->name('statement');
    Route::get('/redeem', 'FinancialController@redeem')->name('redeem');
    Route::get('/create', 'FinancialController@create')->name('create');
    Route::post('/store', 'FinancialController@store')->name('store');
    Route::get('/show/{id}', 'FinancialController@show')->name('show');
    Route::get('/edit/{id}', 'FinancialController@edit')->name('edit');
    Route::post('/update/{id}', 'FinancialController@update')->name('update');
    Route::get('/destroy/{id}', 'FinancialController@destroy')->name('destroy');
});

Route::group(['prefix' => 'wd', 'as' => 'wallet.'], function () {
    Route::get('/', 'WalletController@index')->name('index');
    Route::get('/create', 'WalletController@create')->name('create');
    Route::post('/store', 'WalletController@store')->name('store');
    Route::get('/show/{id}', 'WalletController@show')->name('s how');
    Route::get('/edit/{id}', 'WalletController@edit')->name('edit');
    Route::post('/update/{id}', 'WalletController@update')->name('update');
    Route::get('/destroy/{id}', 'WalletController@destroy')->name('destroy');
    Route::get('/send/email/{id}', 'WalletController@email')->name('sendEmail');
});

Route::group(['prefix' => 'reinvest', 'as' => 'reinvest.'], function () {
    Route::get('/', 'ReInvestController@index')->name('index');
    Route::get('/create', 'ReInvestController@create')->name('create');
    Route::post('/store', 'ReInvestController@store')->name('store');
    Route::get('/show/{id}', 'ReInvestController@show')->name('show');
    Route::get('/edit/{id}', 'ReInvestController@edit')->name('edit');
    Route::post('/update/{id}', 'ReInvestController@update')->name('update');
    Route::get('/destroy/{id}', 'ReInvestController@destroy')->name('destroy');
});

Route::group(['prefix' => 'pin', 'as' => 'pin.'], function () {
    Route::get('/', 'PinController@index')->name('index');
    Route::post('/validate/{type}', 'PinController@validates')->name('validate');
    Route::get('/transfer/{pin}', 'PinController@edit')->name('edit');
    Route::post('/update', 'PinController@update')->name('update');
});
