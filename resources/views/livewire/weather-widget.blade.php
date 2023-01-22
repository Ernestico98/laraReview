<div class="h-72 bg-blue-400 absolute top-12 left-12 w-64 rounded-md shadow-md shadow-gray-500 p-3">
    @push('header') @livewireStyles @endpush
    @push('footer') @livewireScripts @endpush

    <input  type="text" placeholder="Find a Location" wire:model="city" class="px-1 mx-auto w-40 rounded"> 
    <button class="bg-slate-300 rounded-md px-1 ml-1" wire:click="search"> Search </button>

    <ul class="block w-56 mx-auto bg-gray-50 max-h-36 overflow-y-auto absolute" wire:model="placeList">
        @if (isset($placeList) && !isset($placeList["cod"]))
            @foreach ($placeList as $index => $cur_place)
                <li"> 
                    <button class="p-1 hover:bg-blue-200 min-w-full text-left" wire:click="selectPlace({{$index}})">
                        {{$cur_place->name}}, {{$cur_place->country}}
                    </button>
                </li>
            @endforeach
        @endif
    </ul>

    <div class=" mt-2 p-2" wire:model="weather">
        @ray($weather)
        @if (isset($weather))
            <p class="text-center text-xl"> {{$weather["name"]}} </p>

            <p class="text-center text-lg"> {{$weather["main"]}} </p>
            
            <img src="//openweathermap.org/img/wn/{{$weather["icon"]}}@2x.png" class="mx-auto h-16">

            <p class="text-center"> {{$weather["description"]}} </p>
            
            <p class="text-center"> Temperature </p>
            <div class="flex flex-row justify-around">
                <div> Min: {{$weather["temp_min"]}} ºC </div>
                <div> Max: {{$weather["temp_max"]}} ºC </div>
            </div>
            
            <p class="text-center"> Feels like: {{$weather["feels_like"]}} ºC </p>

        @else
            <p class="place-content-center text-xl"> Please, select a Location for showing it's weather! </p>            
        @endif
    </div>

</div>
