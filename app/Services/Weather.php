<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class Weather
{
    private $api_base_url = "https://api.openweathermap.org/";
    private $auth, $geo_base_url, $weather_base_url;

    public function __construct() {
        $this->auth = [
           "appid" => config('weather.appid'),
        ];
        $this->geo_base_url = $this->api_base_url . "geo/1.0/direct";
        $this->weather_base_url = $this->api_base_url . "data/2.5/weather";
    }

    private function apiRequest(string $endpoint, array $data = []) {
        $data = array_merge($data, $this->auth);
        $response = Http::get($endpoint, $data);
        return collect(json_decode($response->body()));
    }

    public function findLocations(string $place_name, int $limit = 15) {
        $data = [
            "q" => $place_name,
            "limit" => $limit,
        ];
        return $this->apiRequest($this->geo_base_url, $data);
    }

    public function getWeather(float $lon, float $lat) {
        $data = [
            "lon" => $lon,
            "lat" => $lat,
            "units" => "metric",
        ];
        $response = $this->apiRequest($this->weather_base_url, $data);

        if ($response['cod'] != "200")
            throw new Exception($response["message"]);

        return $response;
    }

}
