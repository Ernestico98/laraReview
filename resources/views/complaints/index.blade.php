<x-site-layout text="Reported reviews">
    <div class="mx-6">
        @foreach ($reviews as $review)
        <x-review-reported-card :review="$review" />
        @endforeach
    </div>
</x-site-layout>
