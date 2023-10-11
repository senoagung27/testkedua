<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;

class DollarScrapeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $url = 'https://kursdollar.org';
        $response = Http::get($url);

        if ($response->successful()) {
            $content = $response->body();
            // Scraping code here to extract currency rates and other data

            $data = [
                'meta' => [
                    'date' => now()->format('d-m-Y'),
                    'day' => now()->format('l'),
                    'indonesia' => 'Bank Indonesia - ' . now()->format('d M, H:i', 7 * 3600), // UTC+7
                    'word' => 'Spot Dunia ' . now()->format('d M, H:i', 8 * 3600), // UTC+8
                ],
                'rates' => [
                    // Add your scraped rates data here
                ],
            ];

            $jsonContent = json_encode($data, JSON_PRETTY_PRINT);

            $filename = 'rate-' . now()->format('d-m-Y--H-i-s') . '.json';
            Storage::put($filename, $jsonContent);
        }
    }
}
