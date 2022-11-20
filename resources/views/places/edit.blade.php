<x-site-layout text="Edit {{$place->name}}">
    <div class="mx-8 my-6">
        <x-form method="post" route="{{route('places.update', $place->id)}}" submit="Save">
            @method('put', 'delete')
            <x-form-text-input name="name" label="Place Name" placeholder="Name of the place" value="{{$place->name}}"/>

            <x-form-text-input name="city" label="City" placeholder="Place's city" value="{{$place->city}}"/>

            <x-form-textarea-input name="description" placeholder="Write a short description of the place" label="Description" width="500" height="20" value="{!!$place->description!!}"/>

            <x-form-textarea-input name="tags" placeholder="Write tags separated by comma and no extra spaces" label="Tags" width="250" height="16" value="{{$place->tags->pluck('name')->unique()->values()->implode(',')}}"/>

            <div class="flex place-items-center mt-6">
                <label class="w-24 text-sm text-gray-500">TODO: Add upload photo</label>
            </div>
        </x-form>
    </div>
</x-site-layout>
