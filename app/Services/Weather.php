<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Weather
{
    private $api_base_url = "https://api.openweathermap.org/";
    private $auth, $geo_base_url, $weather_base_url;

    public function __construct() {
        $this->auth = [
           "appid" => env("WEATHER_API_KEY"),
        ];
        $this->geo_base_url = $this->api_base_url . "geo/1.0/direct";
        $this->weather_base_url = $this->api_base_url . "data/2.5/weather";
    }

    private function apiRequest(string $endpoint, array $data = []) {
        $data = array_merge($data, $this->auth);
        $response = Http::get($endpoint, $data);
        return json_decode($response->body());
    }

    public function findLocations(string $place_name) {
        $data = [
            "q" => $place_name,
            "limit" => 50,
        ];
        return $this->apiRequest($this->geo_base_url, $data);
    }

    public function getWeather(float $lon, float $lat) {
        $data = [
            "lon" => $lon,
            "lat" => $lat,
            "units" => "metric",
        ];
        return $this->apiRequest($this->weather_base_url, $data);
    }

}
