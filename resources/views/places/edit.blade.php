<x-site-layout text="Edit {{$place->name}}">
    <div class="mx-8 my-6">
        <x-form method="post" route="{{route('places.update', $place->id)}}" submit="Save">
            @method('put', 'delete')

            <div class="mb-8 rounded-lg w-60 h-60">
                <img src="@if($place->media()->exists()) {{$place->media->first()?->getUrl('place')}} @else {{asset('img/photo-placeholder.png')}} @endif" class="rounded-lg">
            </div>

            <x-form-file name="image" label="Place picture" placeholder="" value=""/>

            <x-form-text-input name="name" label="Place Name" placeholder="Name of the place" value="{{$place->name}}"/>

            <x-form-text-input name="city" label="City" placeholder="Place's city" value="{{$place->city}}"/>

            <x-form-textarea-input name="description" placeholder="Write a short description of the place" label="Description" width="500" height="20" value="{!!$place->description!!}"/>

            <x-form-textarea-input name="tags" placeholder="Write tags separated by comma and no extra spaces" label="Tags" width="250" height="16" value="{{$place->tags->pluck('name')->unique()->values()->implode(',')}}"/>


        </x-form>
    </div>
</x-site-layout>
