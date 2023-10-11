<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Goutte\Client;
use App\Models\Scrapping;
use Illuminate\Http\Request;
use App\Jobs\DollarScrapeJob;
use Illuminate\Support\Facades\File;
// use File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
// use Storage;
use Illuminate\Support\Facades\Storage;

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
    public function scrapeAndStoreData()
    {
        $url = 'https://kursdollar.org';

        // Scraping data
        $client = new Client();
        $crawler = $client->request('GET', $url);

        // Parse data and create the JSON structure
        $data = $this->parseData($crawler);

        // Save the data to a file
        $fileName = 'rate-' . Carbon::now()->format('d-m-Y--H-i-s') . '.json';
        file_put_contents(storage_path('app/' . $fileName), json_encode($data));

        return response()->json(['message' => 'Data scraped and stored successfully.', 'file_name' => $fileName]);
    }
    private function parseData($crawler)
    {
        // Parse the required data from the crawler
        // You'll need to inspect the HTML structure and extract the data accordingly

        // For demonstration purposes, I'm providing dummy data
        $data = [
            "meta" => [
                "date" => "29-04-2022",
                "day" => "Friday",
                "indonesia" => "Bank Indonesia - 29 Apr, 12:00",
                "word" => "Spot Dunia 29 Apr, 13:00"
            ],
            "rates" => [
                [
                    "currency" => "USD",
                    "buy" => 14345.91,
                    "sell" => 14490.09,
                    "average" => 14418.00,
                    "word_rate" => 14435.05
                ],
                [
                    "currency" => "SGD",
                    "buy" => 10245.21,
                    "sell" => 10440.19,
                    "average" => 10418.00,
                    "word_rate" => 11055.05
                ],
                // Add more currencies and their rates here
            ]
        ];

        return $data;
    }
    public function clearStoredData()
    {
        $files = File::files(storage_path('app/'));
        foreach ($files as $file) {
            if (strpos($file->getFilename(), 'rate-') === 0) {
                File::delete($file);
            }
        }

        return response()->json(['message' => 'Data deleted successfully.']);
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
