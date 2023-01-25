<?php

namespace App\Http\Livewire;

use App\Facades\Weather;
use Illuminate\Contracts\Session\Session;
use Livewire\Component;

class WeatherWidget extends Component
{
    public $weather, $placeList = null, $place;
 
    public $city = "";

    public function __construct() {    
        // request()->session()->remove('place');
        $this->placeList = null;
        $this->place = request()->session()->get('place', null);

        if ($this->place) {
            $weather_request = Weather::getWeather($this->place["lon"], $this->place["lat"]);
            $this->constructWeatherObject($weather_request);
        }
    }

    private function constructWeatherObject($weather_request) {
        $this->weather = [
            "name" => $this->place["name"],
            "main" => $weather_request["weather"][0]->main,
            "icon" => $weather_request["weather"][0]->icon,
            "description" => $weather_request["weather"][0]->description,
            "temp_min" => $weather_request["main"]->temp_min,
            "temp_max" => $weather_request["main"]->temp_max,
            "feels_like" => $weather_request["main"]->feels_like,
        ];
    }

    public function search() {
        $this->placeList = Weather::findLocations($this->city)->map(fn($item) => collect($item)->toArray())->toArray();
    }

    public function selectPlace($place_index) {
        $this->place = $this->placeList[$place_index];
           
        $weather_request = Weather::getWeather($this->place["lon"], $this->place["lat"]);
        $this->constructWeatherObject($weather_request);        

        request()->session()->put('place', $this->place);

        $this->placeList = null;
    }

    public function render()
    {
        return view('livewire.weather-widget');
    }
}
