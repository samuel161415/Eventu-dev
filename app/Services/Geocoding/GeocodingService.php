<?php

namespace App\ServicesGeocoding;

use GuzzleHttp\Client;

class GeocodingService {
    protected $client;
    protected $apiKey;

    public function __construct() {
        $this->client = new Client();
        $this->apiKey = env('GOOGLE_MAPS_API_KEY');
    }

    public function geocodeAddress($address) {
        $response = $this->client->get('https://maps.googleapis.com/maps/api/geocode/json', [
            'query' => [
                'address' => $address,
                'key' => $this->apiKey
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        if ($data['status'] === 'OK') {
            return $data['results'][0]['geometry']['location'];
        }

        return null;
    }
}
