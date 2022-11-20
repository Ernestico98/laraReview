<x-site-layout text='Places with tag "{{$tag->name}}"'>

    <div class="my-4"></div>

    <div class="mx-20 mb-4">
        {{ $places->links() }}
    </div>

    @foreach ($places as $place)
        <x-place-card :place="$place" />
    @endforeach

    <div class="mx-20 mb-4">
        {{ $places->links() }}
    </div>



</x-site-layout>
