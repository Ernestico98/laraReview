<x-site-layout text="Add new place">

    <div class="mx-8 my-6">
        <form method="post" action="{{route('places.store')}}">
            @csrf

            <div class="flex place-items-center">
                <label for="name" class="w-24 text-sm text-gray-500 ">Place Name</label>
                <input type="text" name="name" placeholder="Name of the place" class="w-64 border border-gray-400 rounded-sm p-1">
            </div>
            {{-- <div class="text-orange-600 bg-orange-50 rounded-sm p-1">
                @foreach ($errors->get('name') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div> --}}

            <div class="flex place-items-center mt-6">
                <label for="city" class="w-24 text-sm text-gray-500 ">City</label>
                <input type="text" name="city" placeholder="Place's city" class="w-64 border border-gray-400 rounded-sm p-1">
            </div>

            <div class="flex place-items-center mt-6">
                <label for="description" class="w-24 text-sm text-gray-500">Description</label>
                <textarea name="description" placeholder="Write a short description of the place" class="w-[500px] h-20 border border-gray-400 rounded-sm p-1"></textarea>
            </div>

            <div class="flex place-items-center mt-6">
                <label for="tags" class="w-24 text-sm text-gray-500">Tags</label>
                <textarea name="tags" placeholder="Write tags separated by comma and no extra spaces" class="w-[250px] h-16 border border-gray-400 rounded-sm p-1"></textarea>
            </div>

            <div class="flex place-items-center mt-6">
                <label class="w-24 text-sm text-gray-500">TODO: Add upload photo</label>
            </div>

            <button type="submit" class="mt-6 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Create
            </button>
        </form>
    </div>


</x-site-layout>
