<div class="bg-gray-50 my-8 rounded-md p-3 shadow-gray-100 shadow-md border border-gray-100 h-52">
    <div class="flex flex-row items-center">
        <div>
            <img src="{{asset('img/profile.jpeg')}}" class="rounded-full h-16" >
        </div>

        <div class="ml-5 w-[940px]">
            <div class="grid grid-cols-2 gap-4">
                <div class="font-bold">{{$review->author->name}}</div>
                <div class="text-end"> {{$review->created_at->diffForHumans()}} </div>
            </div>
            <div class="flex flex-row">
                <x-star-score :score="$review['score']" />
                <div class="ml-2">
                    <span class="font-bold text-sm"> {{$review['score']}} </span> out of
                    <span class="font-bold text-sm"> 5 </span>
                </div>
            </div>
        </div>
    </div>

    <div class="ml-[84px] mt-4">
        {{$review->review}}
    </div>

</div>
