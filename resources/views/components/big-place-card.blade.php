<div class="mt-3 mb-5 max-h-80 flex felx-row rounded-xl border border-gray-100 shadow-md">
    <img class="basis-1/3 rounded-xl" src="{{asset('img/photo-placeholder.png')}}">
    <div class="basis-2/3 p-6">
        <div class="flex flex-row">
            <div class="basis-[70%]">
                <span class="font-bold">Place Name: </span> {{$place['name']}}
            </div>
            <div class="basis-[30%]">
                <span class="font-bold">Score: </span> {{$place['score']}}
            </div>
        </div>

        <div class="my-4 h-[130px] overflow-auto">
            <span class="italic"> {{$place['description']}} </span>
        </div>

        <div class="pt-10 flex flex-row">
            <div class="text-sm basis-2/3">
                <div>
                    <span class="font-bold">City: </span> {{$place['city']}}
                </div>

                <div>
                    <span class="font-bold">Added by </span> {{$place['author']['name']}} <span class="font-bold"> on </span> {{$place['created_at']}}
                </div>
            </div>

            <div class="basis-1/3 text-end w-max">
                <a href="#" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Review
                </a>
            </div>
        </div>
    </div>
</div>
