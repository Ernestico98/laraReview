<div class="bg-gray-50 my-8 rounded-md p-3 shadow-gray-100 shadow-md border border-gray-100 h-52">
    <div class="flex flex-row items-center">
        <div>



            <img src="@if($review->author->media->first()) {{$review->author->media->first()?->getUrl('avatar')}} @else {{asset('img/profile.jpeg')}} @endif" class="rounded-full h-16" >
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

    <div class="ml-[84px] mt-4 h-20">
        {{$review->review}}
    </div>

    <div class="flex flex-row ml-[84px] justify-between">
        <div>
            <span class="font-bold"> On place: </span>
            <a class="underline" href="{{route('places.show', $review->place_id)}}">{{$review->place->name}}</a>
        </div>

        <div>
            <span class="font-bold"> Reported by {{$review->complaints_count}} user(s)</span>
         </div>

        <div class="text-end">
            <form onclick="alert('Review has been marked as hidden')" method="post" action="{{route('complaints.hide', ['review_id' => $review->id])}}">
                @csrf
                <button type="submit" class="tetx-sm inline-flex items-center px-3 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 disabled:opacity-25 transition ease-in-out duration-150">
                    Hide review
                </button>
            </form>
        </div>

    </div>


</div>
