<x-site-layout text="Reviews for {{$place->name}}">
    <div id="container" class="px-8">
        <div class="flex flex-row justify-end">
            <a href="{{route('reviews.create', $place->id)}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Make review
            </a>
        </div>

        <x-big-place-card  :place="$place" />

        <div class="pl-16">
            @foreach ($reviews as $review)
               <x-review-card :review="$review" />
            @endforeach
        </div>
    </div>
</x-site-layout>
