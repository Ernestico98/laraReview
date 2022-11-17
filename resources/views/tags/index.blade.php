<x-site-layout text="Tags">
    <div class="px-[25%]">

        <div class="bg-slate-100 my-4 p-3 rounded-xl shadow-gray-200 shadow-md flex flex-wrap">
                @foreach ($tags as $tag)
                <a href="{{route('tags.show', $tag->id)}}" class="mx-1 my-2">
                    <span class="rounded-full bg-white text-center px-2 py-1 hover:bg-gray-300">
                        {{$tag->name}}
                    </span>
                </a>
                @endforeach
        </div>

    </div>
</x-site-layout>
