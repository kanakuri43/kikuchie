<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

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
    return view('welcome');
});


/*
コントローラーで処理するほどのボリュームがない場合は、
第２引数にクロージャーを書いて、定義することが可能です。
*/
Route::get('/hello', function () {
    return view('hello', ['name' => "Hello World."]);
});

Route::resource('/book', 'App\Http\Controllers\BookController');

/*
/report/daily にアクセスされたら
ReportControllerの dailyメソッドを実行する
*/
Route::get('/journal/daily/{work_date}', 'App\Http\Controllers\JournalController@daily')->name('journal.daily');;
Route::get('/journal/monthly/{work_month}', 'App\Http\Controllers\JournalController@monthly')->name('journal.monthly');;

Route::resource('/journal', 'App\Http\Controllers\JournalController');
