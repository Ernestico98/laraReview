<x-site-layout text="Places">
    @foreach ($places as $place)
        <div class="mx-20 my-12 bg-gray-50 rounded-lg flex flex-row shadow-lg shadow-gray-200 max-h-60">
            <div class="basis-1/4 rounded-lg pb-10 overflow-hidden">
                <img src="https://www.idsplus.net/wp-content/uploads/default-placeholder.png">
            </div>

            <div class="basis-3/4 rounded-lg my-6 mx-8 bg-white p-6 shadow-md overflow-hidden">
                <div class="flex flex-row">
                    <div class="basis-[70%]">
                        <span class="font-bold">Place Name: </span> {{$place['name']}}
                    </div>
                    <div class="basis-[30%]">
                        <span class="font-bold">Score: </span> {{$place['score']}}
                    </div>
                </div>

                <div class="py-2 max-h-[90px] overflow-auto">
                    <span class="italic"> {{$place['description']}} </span>
                </div>

                <div>
                    <span class="font-bold">City: </span> {{$place['city']}}
                </div>

                <div class="text-sm pt-1">
                    <span class="font-bold">Added by </span> {{$place['author']['name']}} <span class="font-bold"> on </span> {{$place['created_at']}}
                </div>
            </div>
        </div>
    @endforeach

</x-site-layout>
