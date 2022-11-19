<div class="mx-20 mb-12 bg-gray-50 rounded-lg flex flex-row shadow-lg shadow-gray-200 max-h-60">
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

        <div class="py-2 h-[90px] overflow-auto">
            <span class="italic"> {{$place['description']}} </span>
        </div>

        <div class="pt-1 flex flex-row">
            <div class="text-sm basis-2/3">
                <div>
                    <span class="font-bold">City: </span> {{$place['city']}}
                </div>

                <div>
                    <span class="font-bold">Added by </span> {{$place['author']['name']}} <span class="font-bold"> on </span> {{$place['created_at']}}
                </div>
            </div>

            <div class="basis-1/3 text-end w-max">

                <a href="{{route('places.show', $place['id'])}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Check Place
                </a>

                <a href="#" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Review
                </a>
            </div>
        </div>
    </div>
</div>
