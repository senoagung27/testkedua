<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Goutte\Client;
use App\Models\Scrapping;
use Illuminate\Http\Request;
use App\Jobs\DollarScrapeJob;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class KursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.currency.index');
    }
    public function scrapeAndSave()
    {
        $url = 'https://kursdollar.org';
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $metaData = $this->extractMetaData($crawler);
        $rates = $this->extractRates($crawler);

        $data = [
            'meta' => $metaData,
            'rates' => $rates,
        ];

        $fileName = 'rate-' . Carbon::now()->format('d-m-Y--H-i-s') . '.json';
        $filePath = storage_path('app/' . $fileName);

        file_put_contents($filePath, json_encode($data));

        return 'Proses berhasil ditambahkan pada Job.';
    }

    private function extractMetaData($crawler)
    {
        // Implement the logic to extract meta data from the crawler
        // Sample meta data for demonstration
        return [
            'date' => '29-04-2022',
            'day' => 'Friday',
            'indonesia' => 'Bank Indonesia - 29 Apr, 12:00',
            'word' => 'Spot Dunia 29 Apr, 13:00'
        ];
    }
    private function extractRates($crawler)
    {
        // Implement the logic to extract rates data from the crawler
        // Sample rates data for demonstration
        return [
            [
                'currency' => 'USD',
                'buy' => 14345.91,
                'sell' => 14490.09,
                'average' => 14418.00,
                'word_rate' => 14435.05
            ],
            [
                'currency' => 'SGD',
                'buy' => 10245.21,
                'sell' => 10440.19,
                'average' => 10418.00,
                'word_rate' => 11055.05
            ],
            // ...
        ];
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
