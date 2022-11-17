<x-site-layout text="{{$user->name}}'s profile">
    <div class="mx-[25%] my-4 text-lg">
        <div class="mb-4 rounded-lg w-48 h-48">
            <img src="{{asset('img/profile.jpeg')}}" class="rounded-lg">
        </div>
        <div>
            <span class="font-semibold mr-4"> Name: </span> {{$user->name}}
        </div>
        <div class="mt-4">
            <span class="font-semibold mr-4"> Email: </span> {{$user->email}}
        </div>


        <a href="{{route('users.edit', $user->id)}}" class="mt-6 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none hover:cursor-pointer focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            Editar
        </a>

    </div>



</x-site-layout>
