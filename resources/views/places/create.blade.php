<x-site-layout text="Add new place">

    <div class="mx-8 my-6">
        <x-form method="post" route="{{route('places.store')}}" submit="Create">
            <x-form-text-input name="name" label="Place Name" placeholder="Name of the place" value=""/>

            <x-form-text-input name="city" label="City" placeholder="Place's city" value=""/>

            <x-form-textarea-input name="description" placeholder="Write a short description of the place" label="Description" width="500" height="20" value=""/>

            <x-form-textarea-input name="tags" placeholder="Write tags separated by comma and no extra spaces" label="Tags" width="250" height="16" value=""/>

            <div class="mt-4"></div>
            <x-form-file name="image" label="Place picture" placeholder="" value=""/>
        </x-form>
    </div>

</x-site-layout>
