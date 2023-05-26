<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    public function getRealEstateAgencies(Request $request)
    {
        $apiKey = 'AIzaSyC1Ql_BqODWuhzeVC1WJEWjnSwiOi2axow';
        $keyword = 'agentie imobiliara';
        $language = 'ro'; // Romanian language code

        $client = new Client();
        $response = $client->get('https://maps.googleapis.com/maps/api/place/textsearch/json', [
            'query' => [
                'key' => $apiKey,
                'query' => $keyword,
                'language' => $language,
                'region' => 'ro', // Restrict results to Romania
            ],
        ]);

        $results = json_decode($response->getBody(), true)['results'];

        $data = [];
        foreach ($results as $result) {
            $name = $result['name'] ?? 'N/A';
            $address = $result['formatted_address'] ?? 'N/A';
            $data[] = "Name: $name\nAddress: $address\n";
        }

        $outputFile = public_path('romanian_real_estate_agencies.txt');
        file_put_contents($outputFile, implode("\n", $data));

        return "Romanian real estate agencies saved to $outputFile.";
    }
}
