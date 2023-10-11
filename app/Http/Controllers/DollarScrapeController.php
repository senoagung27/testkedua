<?php

namespace App\Http\Controllers;

use Goutte\Client;
use App\Models\Scrapping;
use Illuminate\Http\Request;
use App\Jobs\DollarScrapeJob;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class DollarScrapeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.currency.index');
    }
    public function runScrapeJob()
    {
        // Add job to Redis queue
        dispatch(new DollarScrapeJob());

        // Store a message in Redis (you can use this to track the job status)
        Redis::set('scrape-job-status', 'Proses berhasil ditambahkan pada Job');

        return redirect()->route('dollar-scraper.index');
    }
    public function clearData()
    {
        // Add job to Redis queue to clear data
        // You can implement the logic to clear data here

        // Store a message in Redis (you can use this to track the job status)
        Redis::set('clear-data-job-status', 'Proses berhasil ditambahkan pada Job');

        return redirect()->route('dollar-scraper.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Scrapping $scrapping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Scrapping $scrapping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Scrapping $scrapping)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scrapping $scrapping)
    {
        //
    }
}
