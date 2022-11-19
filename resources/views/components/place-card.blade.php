<div class="mx-20 mb-12 bg-gray-50 rounded-lg flex flex-row shadow-lg shadow-gray-200 max-h-60">
    <div class="basis-1/4 rounded-lg pb-10 overflow-hidden">
        <img src="https://www.idsplus.net/wp-content/uploads/default-placeholder.png">
    </div>

    <div class="basis-3/4 rounded-lg my-6 mx-8 bg-white p-6 shadow-md overflow-hidden">
        <div class="flex flex-row">
            <div class="basis-[50%]">
                <span class="font-bold">Place Name: </span> {{$place['name']}}
            </div>
            <div class="basis-[20%]">
                <svg class="h-5 w-5 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                    <path strokeLinecap="round" strokeLinejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                </svg>
                {{$place->review_count}}
            </div>

            <div class="basis-[30%] flex flex-row">
                <x-star-score :score="$place['score']" />
                <div class="ml-2">
                    <span class="font-bold"> {{$place['score']}} </span> out of
                    <span class="font-bold"> 5 </span>
                </div>
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

                <a href="{{route('reviews.create', $place->id)}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Review
                </a>
            </div>
        </div>
    </div>
</div>
