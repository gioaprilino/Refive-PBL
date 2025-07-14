<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MapService
{
    public function getCoordinatesFromAddress(string $address): ?array
    {
        $response = Http::withHeaders([
            'X-RapidAPI-Host' => 'maps-data.p.rapidapi.com',
            'X-RapidAPI-Key' => env('RAPIDAPI_KEY'),
        ])->get('https://maps-data.p.rapidapi.com/search-address', [
            'query' => $address,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if (! empty($data['data'][0]['latitude']) && ! empty($data['data'][0]['longitude'])) {
                return [
                    'lat' => $data['data'][0]['latitude'],
                    'lng' => $data['data'][0]['longitude'],
                ];
            }
        }

        return null;
    }
}
