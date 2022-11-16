<x-site-layout text="Places">

    <div class="mx-20 mb-4 flex flex-row justify-end">
        <a href="{{route('places.create')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            Add Place
        </a>
    </div>

    @foreach ($places as $place)
        <x-place-card :place="$place" />
    @endforeach

</x-site-layout>
