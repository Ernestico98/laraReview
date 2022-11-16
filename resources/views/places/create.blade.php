<x-site-layout text="Add new place">

    <div class="mx-8 my-6">
        <form method="post" action="{{route('places.store')}}">
            @csrf

            <x-form-text-input name="name" label="Place Name" placeholder="Name of the place" />

            <x-form-text-input name="city" label="City" placeholder="Place's city" />

            <x-form-textarea-input name="description" placeholder="Write a short description of the place" label="Description" width="500" height="20"/>

            <x-form-textarea-input name="tags" placeholder="Write tags separated by comma and no extra spaces" label="Tags" width="250" height="16"/>

            <div class="flex place-items-center mt-6">
                <label class="w-24 text-sm text-gray-500">TODO: Add upload photo</label>
            </div>

            <button type="submit" class="mt-6 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Create
            </button>
        </form>
    </div>


</x-site-layout>
