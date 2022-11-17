<x-site-layout text='Places with tag "{{$tag->name}}"'>

    <div class="my-4"></div>
    @foreach ($tag->places as $place)
        <x-place-card :place="$place" />
    @endforeach



</x-site-layout>
