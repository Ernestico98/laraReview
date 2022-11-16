<x-site-layout text="Reviews for {{$place->name}}">
    <div id="container" class="px-8">

        <x-big-place-card  :place="$place" />

        <div class="pl-16">
            @foreach ($place->reviews as $review)
               <x-review-card :review="$review" />
            @endforeach
        </div>
    </div>
</x-site-layout>
