<x-site-layout text="Reported reviews">

    <div class="mx-6">
        {{$reviews->links()}}
    </div>

    <div class="mx-6">
        @foreach ($reviews as $review)
        <x-review-reported-card :review="$review" />
        @endforeach
    </div>

    <div class="mx-6">
        {{$reviews->links()}}
    </div>

</x-site-layout>
