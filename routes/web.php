<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KursController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route::get('getjson', [ ScrappingController::class, 'index']);
// Route::get('/dollar-scraper', [DollarScrapeController::class, 'index'])->name('dollar-scraper.index');
// Route::post('/dollar-scraper/run-scrape-job', 'DollarScrapeController@runScrapeJob')->name('dollar-scraper.run-scrape-job');
// Route::post('/dollar-scraper/clear-data', 'DollarScrapeController@clearData')->name('dollar-scraper.clear-data');
Route::get('/scrape-and-save', [KursController::class, 'scrapeAndSave']);
