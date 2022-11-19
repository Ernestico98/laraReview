<x-site-layout text="Create review for {{$place->name}}">

    <div class="mx-8 my-6">
        <x-form method="post" route="{{route('reviews.store', $place->id)}}" submit="Create">

            <x-form-text-input name="score" label="Place score" placeholder="Your score for {{$place->name}}" value="" />

            <x-form-textarea-input name="review" label="Review" placeholder="Write a review for {{$place->name}}" width="500" height="20" value="" />

        </x-form>
    </div>

</x-site-layout>
