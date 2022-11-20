<x-site-layout text="Users">

    <div class="mx-[20%] mb-4">
        {{ $users->links() }}
    </div>
    @foreach ($users as $user)
        <div class="mx-[20%] flex flex-row my-6 rounded-xl bg-gray-100 p-2 shadow-md place-items-end">
            <div class="basis-[68%] flex flex-row place-items-center">
                <div class="basis-[30%]">
                    <img src="{{asset('img/profile.jpeg')}}" class="rounded-full h-28">
                </div>
                <div class="basis-[70%]">
                    <div> {{$user->name}} </div>
                    <div> {{$user->email}} </div>
                </div>
            </div>


            <div class="basis-[32%] place-items-end text-end h-full mb-2 mr-2">
                <a href="{{route('users.edit', $user->id)}}" class="mt-6 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Edit
                </a>
            </div>
        </div>
    @endforeach

    <div class="mx-[20%] mt-4">
        {{ $users->links() }}
    </div>
</x-site-layout>
